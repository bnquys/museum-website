<?php
    namespace Museum\Object;
    use Museum\Utils\Database;

    class Account {
        public const TABLE = "Account";
        public const PREFIX = "ACC";
        public const LENGTH = 10;

        public $username;
        public $password;
        public $email;

        private function __construct($username, $email, $password) {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public static function update(Account $account): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE " . self::TABLE . " SET Password = ?, Email = ? WHERE Username = ?");
            $stmt->bind_param("sss", $account->password, $account->email, $account->username);
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

            $stmt = $conn->prepare("SELECT Username, Email, Password FROM " . self::TABLE . " WHERE Username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            $account = null;

            if ($row = $result->fetch_assoc()) {
                $account = new self($row['Username'], $row['Email'], $row['Password']);
            }

            $stmt->close();
            $conn->close();

            return $account;
        }


        public function exists() {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM ". self::TABLE ." WHERE Username = ? AND Password = ?");
            $stmt->bind_param("ss", $this->username, $this->password);

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

        public static function isUsernameExists(string $username) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM Account WHERE Username = ?");
            $stmt->bind_param("s", $username);

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

        public static function generateRandomNumbers($length) {
            $randomNumbers = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumbers .= rand(0, 9); 
            }
            return $randomNumbers;
        }

        public function getUser() {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDate FROM " . User::TABLE . " WHERE Email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $user = new User($row['Name'], $row['BirthDate'], $row['PhoneNumber'], $row['Email']);
                
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
        
            $stmt = $conn->prepare("UPDATE " . self::TABLE . " SET Password = ? WHERE Email = ?");
            $stmt->bind_param("ss", $newPassword, $email);
        
            $success = $stmt->execute();
        
            $stmt->close();
            $conn->close();
        
            return $success;
        }
        
    }
?>