<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Role {
    private static function generateId($name): string {
        return 'ROLE_' . strtoupper(preg_replace('/\s+/', '_', trim($name)));
    }

    public static function add(string $name, string $description): bool {
        $conn = Database::Connect();
        $id = self::generateId($name);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM Role WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($exists);
        $stmt->fetch();
        $stmt->close();

        if ($exists) {
            // Update
            $stmt = $conn->prepare("UPDATE Role SET Name = ?, Description = ?, IsShow = TRUE WHERE Id = ?");
            $stmt->bind_param("sss", $name, $description, $id);
        } else {
            // Insert
            $stmt = $conn->prepare("INSERT INTO Role (Id, Name, Description, IsShow) VALUES (?, ?, ?, TRUE)");
            $stmt->bind_param("sss", $id, $name, $description);
        }

        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public static function delete(string $name): bool {
        $conn = Database::Connect();
        $id = self::generateId($name);

        $stmt = $conn->prepare("UPDATE Role SET IsShow = FALSE WHERE Id = ?");
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $result;
    }
}
