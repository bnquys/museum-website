<?php
    namespace Museum\Object;
    use mysqli;
    
    class Database {
        public const SERVER = "localhost";
        public const USERNAME = "root";
        public const PASSWORD = "";
        public const DATABASE = "museum";

        public static function Connect() {
            $conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }

        public static function generatePrimaryKey(string $tableName, string $prefix, int $length) {
            // $conn = self::Connect();

            // $sql = "SELECT MAX(Id) FROM ". $tableName;
            // $result = $conn->query($sql);

            // if ($result->num_rows > 0) {
            //     $row = $result->fetch_assoc();
            //     $currentCode =  $row['Id'];
            //     $currentNumber = substr($currentCode, strlen($prefix));
                
            //     $newNumber = str_pad((int)$currentNumber + 1, $length - strlen($prefix), '0', STR_PAD_LEFT);
                
            //     return $prefix . $newNumber;
            // } else {
            //     return $prefix . str_pad('1', $length - strlen($prefix), '0', STR_PAD_LEFT);
            // }
            // $conn->close();
        }
    }
?>