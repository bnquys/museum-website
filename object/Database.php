<?php
    namespace Museum;
    use mysqli;
    class Database {
        private const SERVER = "localhost";
        private const USERNAME = "root";
        private const PASSWORD = "";
        private const DATABASE = "museum";

        public static function Connect() {
            $conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);
    
            if ($conn->connect_error) {
                    die("Connection failed: ". $conn->connect_error); 
            }
    
            return $conn;
        }
    }
?>