<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Account {
    public $username;
    public $password;
    public $email;
    public $roleId;
    public $isActive;

    private function __construct($username, $email, $password, $roleId = null, $isActive = true) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->roleId = $roleId ?? AccountRole::USER;
        $this->isActive = $isActive;
    }

    public static function update(Account $account): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Account SET Password = ?, Email = ?, Id = ? WHERE Username = ?");
        $stmt->bind_param("ssss", $account->password, $account->email, $account->roleId, $account->username);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    public static function forLogin(string $username, string $password) {
        return new self($username, null, $password);
    }

    public static function forSignup(string $username, string $email, string $password) {
        return new self($username, $email, $password);
    }

    public static function getByUsername(string $username): ?self {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Username, Email, Password, Id AS RoleId, IsActive FROM Account WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $account = null;

        if ($row = $result->fetch_assoc()) {
            $account = new self(
                $row['Username'],
                $row['Email'],
                $row['Password'],
                $row['RoleId'],
                $row['IsActive']
            );
        }

        $stmt->close();
        $conn->close();

        return $account;
    }

    public function hasRole(string $role): bool {
        return $this->roleId === $role;
    }

    public function setRole(string $role): bool {
        $this->roleId = $role;

        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Account SET Id = ? WHERE Username = ?");
        $stmt->bind_param("ss", $this->roleId, $this->username);
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public function toggleActive(): bool {
        $conn = Database::Connect();
        $newStatus = !$this->isActive;
        $stmt = $conn->prepare("UPDATE Account SET IsActive = ? WHERE Username = ?");
        $stmt->bind_param("is", $newStatus, $this->username);
        $success = $stmt->execute();
        if ($success) {
            $this->isActive = $newStatus;
        }
        $stmt->close();
        $conn->close();
        return $success;
    }

    public function exists(): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT 1 FROM Account WHERE Username = ? AND Password = ?");
        $stmt->bind_param("ss", $this->username, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        $conn->close();
        return $exists;
    }

    public static function isUsernameExists(string $username): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT 1 FROM Account WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        $conn->close();
        return $exists;
    }

    public static function generateRandomNumbers($length): string {
        $randomNumbers = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumbers .= rand(0, 9); 
        }
        return $randomNumbers;
    }

    public function getUser() {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDate, Avatar FROM Client WHERE Email = ?");
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user = new User($row['Name'], $row['BirthDate'], $row['PhoneNumber'], $row['Email'], $row['Avatar']);
            $stmt->close();
            $conn->close();
            return $user;
        }
        $stmt->close();
        $conn->close();
        return null;
    }

    public static function updatePasswordByEmail(string $email, string $newPassword): bool {
        $conn = Database::Connect();
        $stmt = $conn->prepare("UPDATE Account SET Password = ? WHERE Email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    public static function getAll(): array {
        $conn = Database::Connect();
        $result = $conn->query("SELECT Username, Email, Password, Id AS RoleId, IsActive FROM Account");
        $accounts = [];
        while ($row = $result->fetch_assoc()) {
            $acc = new self(
                $row['Username'],
                $row['Email'],
                $row['Password'],
                $row['RoleId'],
                $row['IsActive']
            );
            $accounts[] = $acc;
        }
        $conn->close();
        return $accounts;
    }
}
