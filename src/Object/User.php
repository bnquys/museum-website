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

            $stmt = $conn->prepare("INSERT INTO Client(Id, Name, Email, PhoneNumber, Username) VALUES (?, ?, ?, ?, ?)");
            $id = Database::generatePrimaryKey(self::TABLE, self::PREFIX, self::LENGTH);
            $stmt->bind_param("sssss", $id, $user->name, $user->birthYear, $user->phoneNumber, $user->email, $user->username);

            $stmt->execute();
            $conn->close();
        }

        function generateRandomNumbers($length) {
            $randomNumbers = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumbers .= rand(0, 9); 
            }
            return $randomNumbers;
        }
    }

?>