<?php
    require_once "Database.php";

    class Account {

        public $username;
        public $password;

        public function __construct($username, $password) {
            $this->username = $username;
            $this->password = $password;
        }

        public static function add(Account $account) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("INSERT INTO Account VALUE (?, ?, ?)");
            $activateCode = self::generateRandomNumbers(10);
            $stmt->bind_param("sss", $account->username, $account->password, $activateCode);
            $stmt->execute();

            $stmt->close();
            $conn->close();
        }

        public function exists() {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM Account WHERE Username = ? AND Password = ?");
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

        public function verifyUsername() {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM Account WHERE Username = ?");
            $stmt->bind_param("s", $this->username);

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

        private static function generateRandomNumbers($length) {
            $randomNumbers = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumbers .= rand(0, 9); 
            }
            return $randomNumbers;
        }
    }
?>