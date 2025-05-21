<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Ticket {
    public const PREFIX = "TK";
    public const CODE_LENGTH = 5;

    public $id;
    public $name;
    public $price;
    public $description;
    public $isShow;
    public $displayOrder;

    public function __construct($id, $name, $price, $description = '', $isShow = true, $displayOrder = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->isShow = $isShow;
        $this->displayOrder = $displayOrder;
    }

    public static function getListTicket($limit = 10000) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            SELECT Id, Name, Price, Description, IsShow, DisplayOrder
            FROM Ticket
            ORDER BY IsShow DESC, DisplayOrder DESC
            LIMIT ?
        ");
        $stmt->bind_param("i", $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Ticket(
                $row["Id"],
                $row["Name"],
                $row["Price"],
                $row["Description"],
                $row["IsShow"],
                $row["DisplayOrder"]
            );
        }

        $stmt->close();
        $conn->close();
        return $list;
    }

    public static function getById($id) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Id, Name, Price, Description, IsShow, DisplayOrder FROM Ticket WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();

        return $row ? new Ticket(
            $row["Id"],
            $row["Name"],
            $row["Price"],
            $row["Description"],
            $row["IsShow"],
            $row["DisplayOrder"]
        ) : null;
    }

    public static function delete($id) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Ticket SET IsShow = FALSE WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function add($ticket) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM Ticket WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        $stmt->bind_param("s", $ticket->id);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $isInsert = ($row['count'] == 0); // true nếu là insert mới
        $stmt->close();
    
        if ($isInsert && $ticket->displayOrder == 0) {
            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM Ticket");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
    
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            $ticket->displayOrder = $row['total'];
            $stmt->close();
        }
    
        $stmt = $conn->prepare("
            INSERT INTO Ticket (Id, Name, Price, Description, IsShow, DisplayOrder)
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Name = VALUES(Name),
                Price = VALUES(Price),
                Description = VALUES(Description),
                IsShow = VALUES(IsShow),
                DisplayOrder = VALUES(DisplayOrder)
        ");
        $stmt->bind_param("ssdsii", $ticket->id, $ticket->name, $ticket->price, $ticket->description, $ticket->isShow, $ticket->displayOrder);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
       

    public static function getNextId() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Ticket");
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();

        $maxId = ($row['maxId'] == NULL) ? 0 : (int)substr($row['maxId'], strlen(self::PREFIX));
        $nextId = $maxId + 1;
        $numberLength = self::CODE_LENGTH - strlen(self::PREFIX);
        $nextIdFormatted = self::PREFIX . str_pad($nextId, $numberLength, "0", STR_PAD_LEFT);

        $stmt->close();
        $conn->close();
        return $nextIdFormatted;
    }

    public static function moveOrder($id, $direction) {
        $conn = Database::Connect();
    
        // Get current ticket
        $stmt = $conn->prepare("SELECT Id, DisplayOrder FROM Ticket WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $current = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    
        if (!$current) return;
    
        $op = ($direction === 'up') ? '>' : '<';
        $orderBy = ($direction === 'up') ? 'ASC' : 'DESC';
    
        // Find neighbor to swap
        $stmt = $conn->prepare("
            SELECT Id, DisplayOrder FROM Ticket
            WHERE DisplayOrder $op ?
            ORDER BY DisplayOrder $orderBy
            LIMIT 1
        ");
        $stmt->bind_param("i", $current['DisplayOrder']);
        $stmt->execute();
        $neighbor = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    
        if (!$neighbor) return;
    
        // Swap display order
        $stmt = $conn->prepare("UPDATE Ticket SET DisplayOrder = ? WHERE Id = ?");
        $stmt->bind_param("is", $neighbor['DisplayOrder'], $current['Id']);
        $stmt->execute();
    
        $stmt->bind_param("is", $current['DisplayOrder'], $neighbor['Id']);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    
    
}
?>
