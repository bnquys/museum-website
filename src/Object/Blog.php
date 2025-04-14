<?php
    namespace Museum\Object;
    // use Museum\Object\Database;
    
    class Blog {
        public $id;
        public $title;
        public $imgUrl;
        public $summary;
        public $content;
        public $uploadDate;

        public function __construct($id, $title, $summary, $content, $imgUrl, $uploadDate) {
            $this->id = $id;
            $this->title = $title;
            $this->summary = $summary;
            $this->content = $content;
            $this->imgUrl = $imgUrl;
            $this->uploadDate = $uploadDate;
        }

        public static function getListBlog($limit) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT id, title, summary, content, image_url, upload_date FROM Blog LIMIT ?");
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
                    $row["id"],
                    $row["title"],
                    $row["summary"],
                    $row["content"],
                    $row["image_url"],
                    $row["upload_date"]
                );
            }

            return $list;
        }

        public static function delete($id) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("DELETE FROM Blog WHERE id = ?");
            $id = (string) $id;
            $stmt->bind_param('s', $id);

            $stmt->execute();
            
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
    }
            $stmt->close();
            $conn->close();
        }
    }
?>