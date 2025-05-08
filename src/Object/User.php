<?php
    namespace Museum\Object;

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

        public static function add(User $user) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("INSERT INTO ". self::TABLE ." (Name, Email, PhoneNumber, BirthDay) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user->name, $user->email, $user->phoneNumber, $user->birthDate);

            $stmt->execute();

            $stmt->close();
            $conn->close();
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

            $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDay FROM " . self::TABLE . " WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $user = null;

            if ($row = $result->fetch_assoc()) {
                $user = new self($row['Name'], $row['BirthDay'], $row['PhoneNumber'], $row['Email']);
            }

            $stmt->close();
            $conn->close();

            return $user;
        }

    }

?>