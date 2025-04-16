<?php
    namespace Museum\Object;
    // use Museum\Object\Database;

    class User {
        public const TABLE = "Client";
        public const PREFIX = "USER";
        public const LENGTH = 10;

        public $id;
        public $name;
        public $birthYear;
        public $phoneNumber;
        public $email;

        public function __construct($name, $birthYear, $phoneNumber, $email) {
            $this->name = $name;
            $this->birthYear = $birthYear;
            $this->phoneNumber = $phoneNumber;
            $this->email = $email;
        }

        public static function add(User $user) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("INSERT INTO ". self::TABLE ."(Name, Email, PhoneNumber) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user->name, $user->email, $user->phoneNumber);
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
    }

?>