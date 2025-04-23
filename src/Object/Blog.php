<?php
    namespace Museum\Object;

    class Blog {
        public const PREFIX = "BL";
        public const CODE_LENGTH = "5";

        public $id;
        public $username;
        public $title;
        public $summary;
        public $content;
        public $imgUrl;
        public $uploadDate;
        public $isShow;

        public function __construct($id, $username, $title, $summary, $content, $imgUrl, $uploadDate, $isShow = true) {
            $this->id = $id;
            $this->username = $username;
            $this->title = $title;
            $this->summary = $summary;
            $this->content = $content;
            $this->imgUrl = $imgUrl;
            $this->uploadDate = $uploadDate;
            $this->isShow = $isShow;
        }

        public static function getListBlog($limit) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT Id, Username, Title, Summary, Content, ImageUrl, Date, IsShow FROM Blog WHERE IsShow = TRUE ORDER BY Id DESC LIMIT ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("i", $limit);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }

            $result = $stmt->get_result();
            $list = [];

            while ($row = $result->fetch_assoc()) {
                $list[] = new Blog(
                    $row["Id"],
                    $row["Username"],
                    $row["Title"],
                    $row["Summary"],
                    $row["Content"],
                    $row["ImageUrl"],
                    $row["Date"],
                    $row["IsShow"]
                );
            }

            $stmt->close();
            $conn->close();

            return $list;
        }

        public static function delete($id) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("UPDATE Blog SET IsShow = FALSE WHERE Id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('s', $id);

            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }

            $stmt->close();
            $conn->close();
        }

        public static function add($blog) {
            $conn = Database::Connect();
            
            $id = $blog->id;
            $username = $blog->username;
            $title = $blog->title;
            $summary = $blog->summary;
            $content = $blog->content;
            $uploadDate = $blog->uploadDate; // Lấy giá trị từ đối tượng Blog
            $imgUrl = $blog->imgUrl;
            $isShow = $blog->isShow;
        
            $stmt = $conn->prepare(
                "INSERT INTO Blog (Id, Username, Title, Summary, Content, ImageUrl, Date, IsShow) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE 
                    Username = VALUES(Username), 
                    Title = VALUES(Title), 
                    Summary = VALUES(Summary), 
                    Content = VALUES(Content), 
                    ImageUrl = VALUES(ImageUrl), 
                    Date = VALUES(Date),  
                    IsShow = VALUES(IsShow)"
            );
        
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            $stmt->bind_param('sssssssi', $id, $username, $title, $summary, $content, $imgUrl, $uploadDate, $isShow);
        
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            echo "Blog added or updated successfully.";
        
            $stmt->close();
            $conn->close();
        }             
        
        public static function getNextId() {
            $conn = Database::Connect();
            
            // Truy vấn để lấy ID lớn nhất trong bảng Blog
            $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Blog");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            // Lấy ID lớn nhất và loại bỏ phần prefix
            $maxId = ($row['maxId'] == NULL) ? 0 : (int)substr($row['maxId'], strlen(self::PREFIX));
            
            // Tính ID kế tiếp
            $nextId = $maxId + 1;
        
            // Tính chiều dài phần số (số chữ số cần thêm vào)
            $numberLength = self::CODE_LENGTH - strlen(self::PREFIX);
        
            // Đảm bảo phần số có đủ chiều dài
            $nextIdFormatted = self::PREFIX . str_pad($nextId, $numberLength, "0", STR_PAD_LEFT);
        
            $stmt->close();
            $conn->close();
        
            return $nextIdFormatted;
        }
        
        public static function getById($id) {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("SELECT Id, Username, Title, Summary, Content, ImageUrl, Date, IsShow FROM Blog WHERE Id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            $stmt->bind_param("s", $id);
            
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            if ($row) {
                $blog = new Blog(
                    $row["Id"],
                    $row["Username"],
                    $row["Title"],
                    $row["Summary"],
                    $row["Content"],
                    $row["ImageUrl"],
                    $row["Date"],
                    $row["IsShow"]
                );
            } else {
                $blog = null;
            }
        
            $stmt->close();
            $conn->close();
        
            return $blog;
        }
        
    }
?>
