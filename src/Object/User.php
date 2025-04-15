<?php
    namespace Museum\Object;
    // use Museum\Object\Database;

    class User {
        public const TABLE = "Client";
        public const PREFIX = "U";
        public const LENGTH = 10;

        public $id;
        public $name;
        public $birthYear;
        public $phoneNumber;
        public $email;
        public $username;

        public function __construct($name, $birthYear, $phoneNumber, $email, $username) {
            $this->name = $name;
            $this->birthYear = $birthYear;
            $this->phoneNumber = $phoneNumber;
            $this->email = $email;
            $this->username = $username;
        }

        public static function add(User $user) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("INSERT INTO Client(Name, Email, PhoneNumber, Username) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user->name, $user->phoneNumber, $user->email, $user->username);

            $stmt->execute();
            $conn->close();
        }

        public static function verifyEmail(string $email) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM Client WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt->close();
                $conn->close();

                return false;
            }

            $stmt->close();
            $conn->close();
            return true;
        }
    }

?>