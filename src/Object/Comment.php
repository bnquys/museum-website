<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Comment
{
    private $username;
    private $id;

    public function __construct($username, $id) {
        $this->username = $username;
        $this->id = $id;
    }

    /**
     * Detects the source table of the given ID.
     *
     * @param \mysqli $conn Database connection
     * @param string $id ID to check
     * @return string|null "blog", "artifact", or null if not found
     * @throws \Exception On SQL error
     */
    private static function detectSource($conn, $id) {
        $stmt = $conn->prepare("SELECT 1 FROM Blog WHERE Id = ? LIMIT 1");
        if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) return "blog";

        $stmt = $conn->prepare("SELECT 1 FROM Artifact WHERE Id = ? LIMIT 1");
        if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) return "artifact";

        return null;
    }

    public function save($content) {
        $conn = Database::Connect();
    
        $source = self::detectSource($conn, $this->id);
        if ($source === null) {
            $conn->close();
            return "not_found";
        }
    
        if ($source === "blog") {
            $stmt = $conn->prepare("
                INSERT INTO Comment (Username, Id, Content)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE Content = VALUES(Content), CreatedAt = CURRENT_TIMESTAMP
            ");
            if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
            $stmt->bind_param("sss", $this->username, $this->id, $content);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            return "saved";
        }
    
        if ($source === "artifact") {
            $stmt = $conn->prepare("
                INSERT INTO Review (Username, Id, Comment)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE Comment = VALUES(Comment), CreatedAt = CURRENT_TIMESTAMP
            ");
            if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
            $stmt->bind_param("sss", $this->username, $this->id, $content);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            return "saved";
        }
    
        $conn->close();
        return "not_found";
    }    

    /**
     * Retrieves all comments or reviews associated with a given ID.
     *
     * Determines whether the ID belongs to a Blog or an Artifact,
     * then returns all visible comments or reviews sorted by creation date.
     *
     * @param string $id The ID of the blog post or artifact.
     * @return array|null An array of comments/reviews or null if ID is invalid.
     * @throws \Exception If database preparation fails.
     */
    public static function getAllById($id) {
        $conn = Database::Connect();
    
        $source = self::detectSource($conn, $id);
        if ($source === null) {
            $conn->close();
            return null;
        }
    
        if ($source === "blog") {
            $stmt = $conn->prepare("
                SELECT Username, Content AS Text, CreatedAt
                FROM Comment
                WHERE Id = ? AND IsShow = TRUE
                ORDER BY CreatedAt DESC
            ");
            if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $conn->close();
            return $rows;
        }
    
        if ($source === "artifact") {
            $stmt = $conn->prepare("
                SELECT Username, Comment AS Text, CreatedAt
                FROM Review
                WHERE Id = ? AND IsShow = TRUE
                ORDER BY CreatedAt DESC
            ");
            if (!$stmt) throw new \Exception("Prepare failed: " . $conn->error);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $conn->close();
            return $rows;
        }
    
        $conn->close();
        return null;
    }    
}