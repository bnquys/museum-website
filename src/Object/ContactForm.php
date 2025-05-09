<?php
namespace Museum\Object;
use Museum\Utils\Database;

class ContactForm {
    public $username;
    public $message;
    public $createdAt;
    public $isSeen;

    public function __construct($username, $message, $createdAt = null, $isSeen = false) {
        $this->username = $username;
        $this->message = $message;
        $this->createdAt = $createdAt ?? date("Y-m-d H:i:s");
        $this->isSeen = $isSeen;
    }

    public static function add($contactForm) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            INSERT INTO ContactForms (Username, Message, CreatedAt, IsSeen)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
                Message = VALUES(Message),
                CreatedAt = VALUES(CreatedAt),
                IsSeen = VALUES(IsSeen)
        ");

        $stmt->bind_param(
            "sssi",
            $contactForm->username,
            $contactForm->message,
            $contactForm->createdAt,
            $contactForm->isSeen
        );

        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
?>
