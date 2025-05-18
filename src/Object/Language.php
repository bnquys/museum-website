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

    /**
     * Converts an array of Language objects into a comma-separated string of language names.
     *
     * @param Language[] $languages An array of Language objects.
     * @return string A string listing all language names, separated by commas.
     */
    public static function toNameString(array $languages): string {
        $names = array_map(fn($lang) => $lang->name, $languages);
        return implode(', ', $names);
    }
    
    /**
     * Retrieves the name of a language based on its ID.
     *
     * @param string $id The language ID.
     * @return string|null The name of the language, or null if not found or not visible.
     */
    public static function getNameById(string $id): ?string {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Name FROM Language WHERE Id = ? AND IsShow = TRUE");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $name = null;
        if ($row = $result->fetch_assoc()) {
            $name = $row['Name'];
        }

        $stmt->close();
        $conn->close();

        return $name;
    }

    public function add(): bool {
        $conn = Database::Connect();
    
        $stmt = $conn->prepare("SELECT 1 FROM Language WHERE Id = ?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
    
        if ($exists) {
            $stmt = $conn->prepare("UPDATE Language SET Name = ?, IsShow = TRUE WHERE Id = ?");
            $stmt->bind_param("ss", $this->name, $this->id);
        } else {
            $stmt = $conn->prepare("INSERT INTO Language (Id, Name, IsShow) VALUES (?, ?, TRUE)");
            $stmt->bind_param("ss", $this->id, $this->name);
        }
    
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
