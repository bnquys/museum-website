<?php
namespace Museum\Object;
use Museum\Utils\Database;

class ContactForm {
    public const PREFIX = "CF";
    public const CODE_LENGTH = "5";

    public $id;
    public $email;
    public $name;
    public $message;
    public $createdAt;
    public $isSeen;

    public function __construct($id, $email, $name, $message, $createdAt, $isSeen = false) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
        $this->createdAt = $createdAt;
        $this->isSeen = $isSeen;
    }

    public static function getListContactForms($limit) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Email, Name, Message, CreatedAt, IsSeen FROM ContactForms WHERE IsSeen = FALSE ORDER BY CreatedAt DESC LIMIT ?");
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
            $list[] = new ContactForm(
                $row["Id"],
                $row["Email"],
                $row["Name"],
                $row["Message"],
                $row["CreatedAt"],
                $row["IsSeen"]
            );
        }

        $stmt->close();
        $conn->close();

        return $list;
    }

    public static function delete($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("UPDATE ContactForms SET IsSeen = TRUE WHERE Id = ?");
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

    public static function add($contactForm) {
        $conn = Database::Connect();
        
        $id = $contactForm->id;
        $email = $contactForm->email;
        $name = $contactForm->name;
        $message = $contactForm->message;
        $createdAt = $contactForm->createdAt;
        $isSeen = $contactForm->isSeen;
    
        $stmt = $conn->prepare(
            "INSERT INTO ContactForms (Id, Email, Name, Message, CreatedAt, IsSeen)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
    
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
    
        $stmt->bind_param('sssssi', $id, $email, $name, $message, $createdAt, $isSeen);
    
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $stmt->close();
        $conn->close();
    }
    

    public static function getNextId() {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM ContactForms");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

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

    public static function getById($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Email, Name, Message, CreatedAt, IsSeen FROM ContactForms WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $contactForm = new ContactForm(
                $row["Id"],
                $row["Email"],
                $row["Name"],
                $row["Message"],
                $row["CreatedAt"],
                $row["IsSeen"]
            );
        } else {
            $contactForm = null;
        }

        $stmt->close();
        $conn->close();

        return $contactForm;
    }
}
?>
