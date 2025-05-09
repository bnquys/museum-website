<?php
namespace Museum\Object;
use Museum\Utils\Database;

require_once 'Event.php';

class Exhibition extends Event {
    public const PREFIX = "EX"; // Tùy bạn có muốn tách prefix riêng cho Exhibition hay không

    public function __construct($id, $eveId, $eveId2, $title, $description, $timeStart, $timeEnd, $location) {
        parent::__construct($id, $eveId, $eveId2, $title, $description, $timeStart, $timeEnd, $location);
    }

    public static function getListExhibition($limit) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            SELECT e.Id, e.EveId, e.EveId2, e.Title, e.Description, e.TimeStart, e.TimeEnd, e.Location
            FROM Exhibitions ex
            JOIN Events e ON ex.Id = e.Id
            ORDER BY e.Id DESC
            LIMIT ?
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Exhibition(
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

    public static function add($exhibition) {
        // Thêm vào bảng Events trước
        parent::add($exhibition);

        // Sau đó thêm vào bảng Exhibitions
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            INSERT IGNORE INTO Exhibitions (Id)
            VALUES (?)
        ");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $exhibition->id);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public static function getById($id) {
        $event = parent::getById($id);

        // Kiểm tra có tồn tại trong bảng Exhibitions không
        if ($event) {
            $conn = Database::Connect();
            $stmt = $conn->prepare("SELECT Id FROM Exhibitions WHERE Id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            $exists = $result->num_rows > 0;
            $stmt->close();
            $conn->close();

            if ($exists) {
                return new Exhibition(
                    $event->id,
                    $event->eveId,
                    $event->eveId2,
                    $event->title,
                    $event->description,
                    $event->timeStart,
                    $event->timeEnd,
                    $event->location
                );
            }
        }

        return null;
    }

    public static function delete($id) {
        // Xóa khỏi bảng Exhibitions trước
        $conn = Database::Connect();

        $stmt = $conn->prepare("DELETE FROM Exhibitions WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // Sau đó xóa khỏi bảng Events
        parent::delete($id);
    }
}
?>
