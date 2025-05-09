<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Event {
    public const PREFIX = "EV";
    public const CODE_LENGTH = 5;

    public $id;
    public $eveId;      // EventType ID
    public $eveId2;     // EventStatus ID
    public $title;
    public $description;
    public $timeStart;
    public $timeEnd;
    public $location;

    public function __construct($id, $eveId, $eveId2, $title, $description, $timeStart, $timeEnd, $location) {
        $this->id = $id;
        $this->eveId = $eveId;
        $this->eveId2 = $eveId2;
        $this->title = $title;
        $this->description = $description;
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
        $this->location = $location;
    }

    public static function getListEvent($limit) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, EveId, EveId2, Title, Description, TimeStart, TimeEnd, Location FROM Events ORDER BY Id DESC LIMIT ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Event(
                $row["Id"],
                $row["EveId"],
                $row["EveId2"],
                $row["Title"],
                $row["Description"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"]
            );
        }

        $stmt->close();
        $conn->close();

        return $list;
    }

    public static function delete($id) {
        // Xoá mềm không được hỗ trợ trong bảng Events -> có thể thực hiện UPDATE để ẩn thông qua status nếu cần
        $conn = Database::Connect();
        $stmt = $conn->prepare("DELETE FROM Events WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public static function add($event) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            INSERT INTO Events (Id, EveId, EveId2, Title, Description, TimeStart, TimeEnd, Location)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
                EveId = VALUES(EveId),
                EveId2 = VALUES(EveId2),
                Title = VALUES(Title),
                Description = VALUES(Description),
                TimeStart = VALUES(TimeStart),
                TimeEnd = VALUES(TimeEnd),
                Location = VALUES(Location)
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssssssss",
            $event->id,
            $event->eveId,
            $event->eveId2,
            $event->title,
            $event->description,
            $event->timeStart,
            $event->timeEnd,
            $event->location
        );

        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function getById($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, EveId, EveId2, Title, Description, TimeStart, TimeEnd, Location FROM Events WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $event = null;
        if ($row = $result->fetch_assoc()) {
            $event = new Event(
                $row["Id"],
                $row["EveId"],
                $row["EveId2"],
                $row["Title"],
                $row["Description"],
                $row["TimeStart"],
                $row["TimeEnd"],
                $row["Location"]
            );
        }

        $stmt->close();
        $conn->close();

        return $event;
    }

    public static function getNextId() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Events");
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
