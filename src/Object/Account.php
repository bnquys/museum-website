<?php
    namespace Museum\Object;
    use Museum\Utils\Database;

    /**
     * Enumeration representing the different roles available for an account.
     *
     * Roles include:
     * - ROOT: The highest-level user with full system access.
     * - ADMIN: A user with administrative privileges, but lower than root.
     * - USER: A regular user with standard permissions.
     */
    enum AccountRole: string {
        case ROOT = 'root';
        case ADMIN = 'admin';
        case USER = 'user';
    }

    class Account {
        public $username;
        public $password;
        public $email;
        public $roleId;

        private function __construct($username, $email, $password, $roleId = null) {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->roleId = $roleId ?? AccountRole::USER->value;
        }

        public static function update(Account $account): bool {
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE Account SET Password = ?, Email = ? WHERE Username = ?");
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
        
            $stmt = $conn->prepare("SELECT Username, Email, Password, Id AS RoleId FROM Account WHERE Username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
        
            $result = $stmt->get_result();
            $account = null;
        
            if ($row = $result->fetch_assoc()) {
                $account = new self(
                    $row['Username'],
                    $row['Email'],
                    $row['Password'],
                    $row['RoleId']
                );
            }
        
            $stmt->close();
            $conn->close();
        
            return $account;
        }        

        /**
         * Checks whether the account has a specific role.
         *
         * @param AccountRole $role The role to check against (e.g., ROOT, ADMIN, USER).
         * @return bool Returns true if the account's role matches the given role; otherwise, false.
         */
        public function hasRole(AccountRole $role): bool {
            return $this->roleId === $role->value;
        }

        /**
         * Sets the role of the account.
         *
         * @param AccountRole $role The new role to assign to the account.
         * @return void
         */
        public function setRole(AccountRole $role): bool {
            $this->roleId = $role->value;
        
            $conn = Database::Connect();
            $stmt = $conn->prepare("UPDATE Account SET Id = ? WHERE Username = ?");
            $stmt->bind_param("ss", $this->roleId, $this->username);
            $success = $stmt->execute();
        
            $stmt->close();
            $conn->close();
        
            return $success;
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

            $stmt = $conn->prepare("SELECT Name, Email, PhoneNumber, BirthDate, Avatar FROM Client WHERE Email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $user = new User($row['Name'], $row['BirthDate'], $row['PhoneNumber'], $row['Email'], $row['Avatar']);
                
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
        
            $stmt = $conn->prepare("UPDATE Account SET Password = ? WHERE Email = ?");
            $stmt->bind_param("ss", $newPassword, $email);
        
            $success = $stmt->execute();
        
            $stmt->close();
            $conn->close();
        
            return $success;
        }
        
    }
?>