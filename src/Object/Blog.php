<?php
    namespace Museum\Object;

    class Blog {
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
    }
?>
