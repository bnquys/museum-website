<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Artifact {
    public const PREFIX = "AF";
    public const CODE_LENGTH = 5;

    public $id;
    public $title;
    public $description;
    public $history;
    public $imageUrl;
    public $isShow;
    public $displayOrder;

    public function __construct($id, $title, $description, $history = '', $imageUrl = '', $isShow = true, $displayOrder = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->history = $history;
        $this->imageUrl = $imageUrl;
        $this->isShow = $isShow;
        $this->displayOrder = $displayOrder;
    }

    public static function getList($limit = 100000) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Id, Title, Description, History, ImageUrl, IsShow, DisplayOrder FROM Artifact ORDER BY IsShow DESC, DisplayOrder DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Artifact($row["Id"], $row["Title"], $row["Description"] ?? '', $row["History"] ?? '', $row["ImageUrl"], $row["IsShow"], $row["DisplayOrder"]);
        }
        $stmt->close(); $conn->close();
        return $list;
    }

    public static function getById($id) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Id, Title, Description, History, ImageUrl, IsShow, DisplayOrder FROM Artifact WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close(); $conn->close();
        return $row ? new Artifact($row["Id"], $row["Title"], $row["Description"], $row["History"], $row["ImageUrl"], $row["IsShow"], $row["DisplayOrder"]) : null;
    }

    public static function delete($id) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Artifact SET IsShow = FALSE WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close(); $conn->close();
    }

    public static function add($item) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM Artifact WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        $stmt->bind_param("s", $item->id);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $isInsert = ($row['count'] == 0);
        $stmt->close();
    
        if ($isInsert && $item->displayOrder == 0) {
            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM Artifact");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
    
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            $item->displayOrder = $row['total'];
            $stmt->close();
        } 

        $stmt = $conn->prepare("INSERT INTO Artifact (Id, Title, Description, History, ImageUrl, IsShow, DisplayOrder)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Title = VALUES(Title),
                Description = VALUES(Description),
                History = VALUES(History),
                ImageUrl = VALUES(ImageUrl),
                IsShow = VALUES(IsShow),
                DisplayOrder = VALUES(DisplayOrder)
        ");
        $stmt->bind_param("ssssssi", $item->id, $item->title, $item->description, $item->history, $item->imageUrl, $item->isShow, $item->displayOrder);
        $stmt->execute();
        $stmt->close(); $conn->close();
    }

    public static function getNextId() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Artifact");
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $maxId = $row['maxId'] ? (int)substr($row['maxId'], strlen(self::PREFIX)) : 0;
        $nextId = $maxId + 1;
        $formatted = self::PREFIX . str_pad($nextId, self::CODE_LENGTH - strlen(self::PREFIX), "0", STR_PAD_LEFT);
        $stmt->close(); $conn->close();
        return $formatted;
    }

    public static function moveOrder($id, $direction) {
        $conn = Database::Connect();
    
        // Lấy artifact hiện tại
        $stmt = $conn->prepare("SELECT Id, DisplayOrder FROM Artifact WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $current = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    
        if (!$current) {
            $conn->close();
            return;
        }
    
        $op = $direction === 'up' ? '>' : '<';
        $order = $direction === 'up' ? 'ASC' : 'DESC';
    
        $stmt = $conn->prepare("SELECT Id, DisplayOrder FROM Artifact WHERE DisplayOrder $op ? ORDER BY DisplayOrder $order LIMIT 1");
        $stmt->bind_param("i", $current['DisplayOrder']);
        $stmt->execute();
        $neighbor = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    
        if (!$neighbor) {
            $conn->close();
            return;
        }
    
        $stmt1 = $conn->prepare("UPDATE Artifact SET DisplayOrder = ? WHERE Id = ?");
        $stmt1->bind_param("is", $neighbor['DisplayOrder'], $current['Id']);
        $stmt1->execute();
        $stmt1->close();
    
        $stmt2 = $conn->prepare("UPDATE Artifact SET DisplayOrder = ? WHERE Id = ?");
        $stmt2->bind_param("is", $current['DisplayOrder'], $neighbor['Id']);
        $stmt2->execute();
        $stmt2->close();
    
        $conn->close();
    }
    
}
?>
