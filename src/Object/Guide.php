<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Guide extends User {
    private $expertise;
    private $introduction;

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
}
?>
