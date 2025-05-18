<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Academy extends Event
{
    // Get Price from Academy table
    public function getPrice() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Price FROM Academy WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $row ? $row["Price"] : null;
    }

    // Set Price in Academy table
    public function setPrice($price) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            INSERT INTO Academy (Id, Price, Speaker)
            VALUES (?, ?, '')
            ON DUPLICATE KEY UPDATE Price = VALUES(Price)
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("sd", $this->id, $price);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    // Get Speaker from Academy table
    public function getSpeaker() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Speaker FROM Academy WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $row ? $row["Speaker"] : null;
    }

    // Set Speaker in Academy table
    public function setSpeaker($speaker) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            INSERT INTO Academy (Id, Price, Speaker)
            VALUES (?, 0, ?)
            ON DUPLICATE KEY UPDATE Speaker = VALUES(Speaker)
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("ss", $this->id, $speaker);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
?>
