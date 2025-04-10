<?php
class Account {
    private static $serverDB = "localhost";
    private static $usernameDB = "root";
    private static $passwordDB = "";
    private static $database = "museum";

    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function exists() {
        $conn = new mysqli(self::$serverDB, self::$usernameDB, self::$passwordDB, self::$database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


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
        $conn = new mysqli(self::$serverDB, self::$usernameDB, self::$passwordDB, self::$database);
        
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error); 
        }

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
}
?>