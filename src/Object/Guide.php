<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Guide extends User {
    private $expertise;
    private $introduction;
    private $languages = [];

    public function getExpertise(): ?string {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Expertise FROM Guides WHERE Email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->expertise = $row['Expertise'];
        }

        $stmt->close();
        $conn->close();

        return $this->expertise;
    }

    public function setExpertise(string $expertise): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Guides SET Expertise = ? WHERE Email = ?");
        $stmt->bind_param("ss", $expertise, $this->email);
        $success = $stmt->execute();

        if ($success) {
            $this->expertise = $expertise;
        }

        $stmt->close();
        $conn->close();
        return $success;
    }

    public function getIntroduction(): ?string {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Introduction FROM Guides WHERE Email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->introduction = $row['Introduction'];
        }

        $stmt->close();
        $conn->close();

        return $this->introduction;
    }

    public function setIntroduction(string $introduction): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Guides SET Introduction = ? WHERE Email = ?");
        $stmt->bind_param("ss", $introduction, $this->email);
        $success = $stmt->execute();

        if ($success) {
            $this->introduction = $introduction;
        }

        $stmt->close();
        $conn->close();
        return $success;
    }

    public function getLanguages(): array {
        $this->languages = [];
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT l.Id, l.Name 
                                FROM Speak s 
                                JOIN Language l ON s.Id = l.Id 
                                WHERE s.Email = ? AND l.IsShow = TRUE");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $this->languages[] = new Language($row['Id'], $row['Name']);
        }

        $stmt->close();
        $conn->close();

        return $this->languages;
    }

    public function addLanguage(Language $language): bool {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT 1 FROM Speak WHERE Email = ? AND Id = ?");
        $stmt->bind_param("ss", $this->email, $language->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();

        if ($exists) {
            $conn->close();
            return false;
        }

        $stmt = $conn->prepare("INSERT INTO Speak (Email, Id) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->email, $language->id);
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public function removeLanguage(Language $language): bool {
        $conn = Database::Connect();

        $stmt = $conn->prepare("DELETE FROM Speak WHERE Email = ? AND Id = ?");
        $stmt->bind_param("ss", $this->email, $language->id);
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public function updateLanguages(array $languageIds): void {
        $currentLanguages = $this->getLanguages();
        $currentIds = array_map(fn($lang) => $lang->id, $currentLanguages);
    
        $allLanguages = \Museum\Object\Language::getAll();
    
        foreach ($currentLanguages as $lang) {
            if (!in_array($lang->id, $languageIds)) {
                $this->removeLanguage($lang);
            }
        }
    
        foreach ($languageIds as $id) {
            if (!in_array($id, $currentIds)) {
                foreach ($allLanguages as $lang) {
                    if ($lang->id === $id) {
                        $this->addLanguage($lang);
                        break;
                    }
                }
            }
        }
    }    

    public function getPrice(): ?float {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Price FROM Guides WHERE Email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $price = null;
        if ($row = $result->fetch_assoc()) {
            $price = (float) $row['Price'];
        }
    
        $stmt->close();
        $conn->close();
    
        return $price;
    }
    
    public function setPrice(float $price): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Guides SET Price = ? WHERE Email = ?");
        $stmt->bind_param("ds", $price, $this->email); // 'd' for double/float, 's' for string
        $success = $stmt->execute();
    
        $stmt->close();
        $conn->close();
    
        return $success;
    }    
}
?>
