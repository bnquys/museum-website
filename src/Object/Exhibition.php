<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Exhibition extends Event {

    public function addArtifact(string $artifactId): void {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT 1 FROM Display WHERE ExhId = ? AND Id = ?");
        $stmt->bind_param("ss", $this->id, $artifactId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO Display (ExhId, Id) VALUES (?, ?)");
            $stmt->bind_param("ss", $this->id, $artifactId);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();
    }

    public function removeArtifact(string $artifactId): void {
        $conn = Database::Connect();
        $stmt = $conn->prepare("DELETE FROM Display WHERE ExhId = ? AND Id = ?");
        $stmt->bind_param("ss", $this->id, $artifactId);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function updateArtifacts(array $artifactIds): void {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Id FROM Display WHERE ExhId = ?");
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        $currentIds = [];
        while ($row = $result->fetch_assoc()) {
            $currentIds[] = $row["Id"];
        }

        $stmt->close();
        $conn->close();

        foreach ($currentIds as $artifactId) {
            if (!in_array($artifactId, $artifactIds)) {
                $this->removeArtifact($artifactId);
            }
        }

        foreach ($artifactIds as $artifactId) {
            if (!in_array($artifactId, $currentIds)) {
                $this->addArtifact($artifactId);
            }
        }
    }

    public function getArtifacts(): array {
        $artifacts = [];
        $conn = Database::Connect();
    
        $stmt = $conn->prepare("
            SELECT a.Id, a.Title, a.Description, a.History, a.ImageUrl, a.IsShow, a.DisplayOrder
            FROM Display d
            JOIN Artifact a ON d.Id = a.Id
            WHERE d.ExhId = ?
            ORDER BY a.DisplayOrder DESC
        ");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $artifacts[] = new Artifact(
                $row['Id'],
                $row['Title'],
                $row['Description'] ?? '',
                $row['History'] ?? '',
                $row['ImageUrl'] ?? '',
                $row['IsShow'],
                $row['DisplayOrder']
            );
        }
    
        $stmt->close();
        $conn->close();
    
        return $artifacts;
    }    
}
?>
