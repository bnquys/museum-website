<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Language {
    public $id;
    public $name;

    public function __construct(string $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function add(): bool {
        $conn = Database::Connect();

        $stmt = $conn->prepare("REPLACE INTO Language (Id, Name, IsShow) VALUES (?, ?, TRUE)");
        $stmt->bind_param("ss", $this->id, $this->name);

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public function remove(): bool {
        $conn = Database::Connect();

        $stmt = $conn->prepare("UPDATE Language SET IsShow = FALSE WHERE Id = ?");
        $stmt->bind_param("s", $this->id);

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public static function getAll(): array {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id, Name FROM Language WHERE IsShow = TRUE");
        $stmt->execute();
        $result = $stmt->get_result();

        $languages = [];

        while ($row = $result->fetch_assoc()) {
            $languages[] = new Language($row['Id'], $row['Name']);
        }

        $stmt->close();
        $conn->close();

        return $languages;
    }
}
?>
