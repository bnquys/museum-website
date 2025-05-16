<?php
    namespace Museum\Object;
    use Museum\Utils\Database;

    class User {
        public $id;
        public $name;
        public $birthDate;
        public $phoneNumber;
        public $email;
        public $avatar;

        public function __construct($name, $birthDate, $phoneNumber, $email, $avatar = null) {
            $this->name = self::formatFullName($name);
            $this->birthDate = $birthDate;
            $this->phoneNumber = $phoneNumber;
            $this->email = $email;
            $this->avatar = $avatar;
        }

        public static function update(User $user): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE Client SET Name = ?, PhoneNumber = ?, BirthDate = ? WHERE Email = ?");
            $stmt->bind_param("ssss", $user->name, $user->phoneNumber, $user->birthDate, $user->email);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }        

        public function setForeignKey(Account $account) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("UPDATE Client SET Username = ? WHERE Email = ?");
            $stmt->bind_param("ss", $account->username, $this->email);

            $stmt->execute();

            $stmt->close();
            $conn->close();
        }

        public static function emailExists(string $email) {
            $conn = Database::Connect();

            $stmt = $conn->prepare("SELECT 1 FROM Client WHERE Email = ?");
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

            $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDate, Avatar FROM Client WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $user = null;

            if ($row = $result->fetch_assoc()) {
                $user = new self($row['Name'], $row['BirthDate'], $row['PhoneNumber'], $row['Email'], $row['Avatar']);
            }

            $stmt->close();
            $conn->close();

            return $user;
        }

        public function setAvatar(string $avatarPath): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE Client SET Avatar = ? WHERE Email = ?");
            $stmt->bind_param("ss", $avatarPath, $this->email);
        
            $success = $stmt->execute();
        
            if ($success) {
                $this->avatar = $avatarPath;
            }
        
            $stmt->close();
            $conn->close();
        
            return $success;
        }    
        
        public function isGuide(): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("SELECT 1 FROM Guides WHERE Email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $isGuide = $result->num_rows > 0;
        
            $stmt->close();
            $conn->close();
        
            return $isGuide;
        }
        
        public function saveAsGuide(string $expertise = '', string $introduction = ''): bool {
            $conn = Database::Connect();
        
            $stmt = $conn->prepare("REPLACE INTO Guides (Email, Expertise, Introduction) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $this->email, $expertise, $introduction);
        
            $success = $stmt->execute();
        
            $stmt->close();
            $conn->close();
        
            return $success;
        }

    }

?>