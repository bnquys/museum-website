<?php
namespace Museum\Object;

class Ticket {
    public const PREFIX = "TK";
    public const CODE_LENGTH = 5;

    public $id;
    public $email;
    public $name;
    public $visitDate;
    public $price;
    public $isShow;

    public function __construct($id, $email, $name, $visitDate, $price, $isShow = true) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->visitDate = $visitDate;
        $this->price = $price;
        $this->isShow = $isShow;
    }

    public static function getListTicket($limit) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Id, Email, Name, VisitDate, Price, IsShow FROM Ticket WHERE IsShow = TRUE ORDER BY Id DESC LIMIT ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("i", $limit);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $result = $stmt->get_result();
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $list[] = new Ticket(
                $row["Id"],
                $row["Email"],
                $row["Name"],
                $row["VisitDate"],
                $row["Price"],
                $row["IsShow"]
            );
        }

        $stmt->close();
        $conn->close();
        return $list;
    }

    public static function delete($id) {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Ticket SET IsShow = FALSE WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $stmt->close();
        $conn->close();
    }

    public static function add($ticket) {
        $conn = Database::Connect();

        $stmt = $conn->prepare(
            "INSERT INTO Ticket (Id, Email, Name, VisitDate, Price, IsShow)
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                Email = VALUES(Email),
                Name = VALUES(Name),
                VisitDate = VALUES(VisitDate),
                Price = VALUES(Price),
                IsShow = VALUES(IsShow)"
        );
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("ssssdi", $ticket->id, $ticket->email, $ticket->name, $ticket->visitDate, $ticket->price, $ticket->isShow);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $stmt->close();
        $conn->close();
    }

    public static function getById($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Email, Name, VisitDate, Price, IsShow FROM Ticket WHERE Id = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $ticket = $row ? new Ticket(
            $row["Id"],
            $row["Email"],
            $row["Name"],
            $row["VisitDate"],
            $row["Price"],
            $row["IsShow"]
        ) : null;

        $stmt->close();
        $conn->close();
        return $ticket;
    }

    public static function getNextId() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Ticket");
        if (!$stmt) die("Prepare failed: " . $conn->error);
        if (!$stmt->execute()) die("Execute failed: " . $stmt->error);

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
