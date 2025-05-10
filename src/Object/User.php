<?php
    namespace Museum\Object;
    use Museum\Utils\Database;

    class User {
        public const TABLE = "Client";
        public const LENGTH = 10;

        public $id;
        public $name;
        public $birthDate;
        public $phoneNumber;
        public $email;

        public function __construct($name, $birthDate, $phoneNumber, $email) {
            $this->name = self::formatFullName($name);
            $this->birthDate = $birthDate;
            $this->phoneNumber = $phoneNumber;
            $this->email = $email;
        }

        public static function update(User $user): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE " . self::TABLE . " SET Name = ?, PhoneNumber = ?, BirthDate = ? WHERE Email = ?");
            $stmt->bind_param("ssss", $user->name, $user->phoneNumber, $user->birthDate, $user->email);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }        

        public function setForeignKey(Account $account) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("UPDATE ". self::TABLE ." SET Username = ? WHERE Email = ?");
            $stmt->bind_param("ss", $account->username, $this->email);

            $stmt->execute();

            $stmt->close();
            $conn->close();
        }

        public static function verifyEmail(string $email) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM ". self::TABLE ." WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();
                $conn->close();

                return true;
            }

            $stmt->close();
            $conn->close();
            return false;
        }

        private static function formatFullName($fullName) {
            $fullName = trim($fullName);
            
            $fullName = preg_replace('/\s+/', ' ', $fullName);
            
            $fullName = ucwords(strtolower($fullName));
		
            return $fullName;
        }

        public static function getByEmail(string $email): ?self {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDate FROM " . self::TABLE . " WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $user = null;

            if ($row = $result->fetch_assoc()) {
                $user = new self($row['Name'], $row['BirthDate'], $row['PhoneNumber'], $row['Email']);
            }

            $stmt->close();
            $conn->close();

            return $user;
        }

    }

?>