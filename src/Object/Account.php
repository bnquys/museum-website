<?php
    namespace Museum\Object;

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

        public static function forLogin(string $username, string $password) {
            return new self($username, null, $password);
        }

        public static function forSignup(string $username, string $email, string $password) {
            return new self($username, $email, $password);
        }

        public static function add(Account $account) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("INSERT INTO ". self::TABLE ." (Username, Email, Password, CodeActivate) VALUE (?, ?, ?, ?)");
            $activateCode = self::generateRandomNumbers(6);
            $stmt->bind_param("ssss", $account->username, $account->email, $account->password, $activateCode);
            $stmt->execute();

            $stmt->close();
            $conn->close();
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
    }
?>