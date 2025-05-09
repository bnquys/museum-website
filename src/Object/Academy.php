<?php
namespace Museum\Object;
use Museum\Utils\Database;

use mysqli;

class Academy {
    public const PREFIX = "AC";
    public const CODE_LENGTH = 5;

    public $id;
    public $price;
    public $speaker;

    public function __construct($id, $price, $speaker) {
        $this->id = $id;
        $this->price = $price;
        $this->speaker = $speaker;
    }

    public static function getListAcademy($limit) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Price, Speaker FROM Academy ORDER BY Id DESC LIMIT ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Academy(
                $row["Id"],
                $row["Price"],
                $row["Speaker"]
            );
        }

        $stmt->close();
        $conn->close();

        return $list;
    }

    public static function getById($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Price, Speaker FROM Academy WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $academy = null;
        if ($row = $result->fetch_assoc()) {
            $academy = new Academy(
                $row["Id"],
                $row["Price"],
                $row["Speaker"]
            );
        }

        $stmt->close();
        $conn->close();

        return $academy;
    }

    public static function add($academy) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            INSERT INTO Academy (Id, Price, Speaker)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Price = VALUES(Price),
                Speaker = VALUES(Speaker)
        ");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "sds",
            $academy->id,
            $academy->price,
            $academy->speaker
        );

        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function delete($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("DELETE FROM Academy WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public static function getNextId() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Academy");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->execute();
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
}
?>
