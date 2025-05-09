<?php
    namespace Museum\Object;
    use Museum\Utils\Database;

    class Artificial {
        public $id;
        public $title;
        public $description;
        public $history;
        public $imgUrl;
        public $isShow;

        public function __construct($id, $title, $description, $history, $imgUrl, $isShow = true) {
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->history = $history;
            $this->imgUrl = $imgUrl;
            $this->isShow = $isShow;
        }

        // Retrieve a list of artificial objects
        public static function getListArtifact($limit) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT Id, Title, Description, History, ImageUrl, IsShow FROM Artifact WHERE IsShow = TRUE ORDER BY Id DESC LIMIT ?");
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
                $list[] = new Artificial(
                    $row["Id"],
                    $row["Title"],
                    $row["Description"],
                    $row["History"],
                    $row["ImageUrl"],
                    $row["IsShow"]
                );
            }

            $stmt->close();
            $conn->close();

            return $list;
        }

        // Hide or delete an artificial object
        public static function delete($id) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("UPDATE Artifact SET IsShow = FALSE WHERE Id = ?");
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
