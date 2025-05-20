<?php
    namespace Museum\Object;
    use Museum\Utils\Database;
    
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
        public $displayOrder;

        public function __construct($id, $username, $title, $summary, $content, $imgUrl, $uploadDate, $isShow = true, $displayOrder = 0) {
            $this->id = $id;
            $this->username = $username;
            $this->title = $title;
            $this->summary = $summary;
            $this->content = $content;
            $this->imgUrl = $imgUrl;
            $this->uploadDate = $uploadDate;
            $this->isShow = $isShow;
            $this->displayOrder = $displayOrder;
        }

        public static function getLatestBlog() {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("
                SELECT Id, Username, Title, Summary, Content, ImageUrl, UploadDate, IsShow, DisplayOrder
                FROM Blog
                WHERE IsShow = TRUE
                ORDER BY UploadDate DESC
                LIMIT 1
            ");
        
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            $stmt->close();
            $conn->close();
        
            if ($row) {
                return new Blog(
                    $row["Id"],
                    $row["Username"],
                    $row["Title"],
                    $row["Summary"],
                    $row["Content"],
                    $row["ImageUrl"],
                    $row["UploadDate"],
                    $row["IsShow"],
                    $row["DisplayOrder"]
                );
            }
        
            return null;
        }
        
        public static function getBlogsThisWeek() {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("
                SELECT Id, Username, Title, Summary, Content, ImageUrl, UploadDate, IsShow, DisplayOrder
                FROM Blog
                WHERE IsShow = TRUE
                AND UploadDate >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                AND UploadDate <= DATE_ADD(CURDATE(), INTERVAL (6 - WEEKDAY(CURDATE())) DAY)
                ORDER BY UploadDate DESC
            ");
        
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
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
                    $row["UploadDate"],
                    $row["IsShow"],
                    $row["DisplayOrder"]
                );
            }
        
            $stmt->close();
            $conn->close();
        
            return $list;
        }
        
        public static function getListBlog($limit=100000) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT Id, Username, Title, Summary, Content, ImageUrl, UploadDate, IsShow, DisplayOrder FROM Blog WHERE IsShow = TRUE ORDER BY DisplayOrder DESC LIMIT ?");
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
                    $row["UploadDate"],
                    $row["IsShow"],
                    $row["DisplayOrder"]
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

            $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM Blog WHERE Id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            $stmt->bind_param("s", $blog->id);
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $isInsert = ($row['count'] == 0);
            $stmt->close();
        
            if ($isInsert && $blog->displayOrder == 0) {
                $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM Blog");
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }
        
                $stmt->execute();
                $row = $stmt->get_result()->fetch_assoc();
                $blog->displayOrder = $row['total'];
                $stmt->close();
            }           
            
            $id = $blog->id;
            $username = $blog->username;
            $title = $blog->title;
            $summary = $blog->summary;
            $content = $blog->content;
            $uploadDate = $blog->uploadDate; // Lấy giá trị từ đối tượng Blog
            $imgUrl = $blog->imgUrl;
            $isShow = $blog->isShow;
        
            $stmt = $conn->prepare(
                "INSERT INTO Blog (Id, Username, Title, Summary, Content, ImageUrl, UploadDate, IsShow, DisplayOrder) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE 
                    Username = VALUES(Username), 
                    Title = VALUES(Title), 
                    Summary = VALUES(Summary), 
                    Content = VALUES(Content), 
                    ImageUrl = VALUES(ImageUrl), 
                    UploadDate = VALUES(UploadDate),  
                    IsShow = VALUES(IsShow),
                    DisplayOrder = VALUES(DisplayOrder)"
            );
        
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            $stmt->bind_param('sssssssii', $id, $username, $title, $summary, $content, $imgUrl, $uploadDate, $isShow, $blog->displayOrder);        
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
                
            $stmt->close();
            $conn->close();
        }             
        
        public static function getNextId() {
            $conn = Database::Connect();
            
            $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Blog");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
        
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            $maxId = ($row['maxId'] == NULL) ? 0 : (int)substr($row['maxId'], strlen(self::PREFIX));
            
            $nextId = $maxId + 1;
        
            $numberLength = self::CODE_LENGTH - strlen(self::PREFIX);
        
            $nextIdFormatted = self::PREFIX . str_pad($nextId, $numberLength, "0", STR_PAD_LEFT);
        
            $stmt->close();
            $conn->close();
        
            return $nextIdFormatted;
        }
        
        public static function getById($id) {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("SELECT Id, Username, Title, Summary, Content, ImageUrl, UploadDate, IsShow, DisplayOrder FROM Blog WHERE Id = ?");
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
                    $row["UploadDate"],
                    $row["IsShow"],
                    $row["DisplayOrder"]
                );
            } else {
                $blog = null;
            }
        
            $stmt->close();
            $conn->close();
        
            return $blog;
        }

        public static function moveOrder($id, $direction) {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("SELECT Id, DisplayOrder FROM Blog WHERE Id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $current = $stmt->get_result()->fetch_assoc();
            $stmt->close();
        
            if (!$current) return;
        
            $op = ($direction === 'up') ? '>' : '<';
            $orderBy = ($direction === 'up') ? 'ASC' : 'DESC';
        
            $stmt = $conn->prepare("
                SELECT Id, DisplayOrder FROM Blog
                WHERE DisplayOrder $op ?
                ORDER BY DisplayOrder $orderBy
                LIMIT 1
            ");
            $stmt->bind_param("i", $current['DisplayOrder']);
            $stmt->execute();
            $neighbor = $stmt->get_result()->fetch_assoc();
            $stmt->close();
        
            if (!$neighbor) return;
        
            $stmt = $conn->prepare("UPDATE Blog SET DisplayOrder = ? WHERE Id = ?");
            $stmt->bind_param("is", $neighbor['DisplayOrder'], $current['Id']);
            $stmt->execute();
        
            $stmt->bind_param("is", $current['DisplayOrder'], $neighbor['Id']);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }  
        
    }
?>
