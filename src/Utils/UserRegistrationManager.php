<?php
namespace Museum\Utils;

use Museum\Object\User;
use Museum\Object\Account;

class UserRegistrationManager {
    public static function registerUser(User $user, Account $account): bool {
        $conn = Database::Connect();
        $conn->begin_transaction();

        try {
            $stmt1 = $conn->prepare("INSERT INTO Client (Name, Email, PhoneNumber, BirthDate) VALUES (?, ?, ?, ?)");
            $stmt1->bind_param("ssss", $user->name, $user->email, $user->phoneNumber, $user->birthDate);
            $stmt1->execute();
            $stmt2 = $conn->prepare("INSERT INTO Account (Username, Email, Password) VALUES (?, ?, ?)");
            $stmt2->bind_param("sss", $account->username, $account->email, $account->password);
            $stmt2->execute();
            $stmt3 = $conn->prepare("UPDATE Client SET Username = ? WHERE Email = ?");
            $stmt3->bind_param("ss", $account->username, $user->email);
            $stmt3->execute();
            $conn->commit();
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
            $conn->close();

            return true;
        } catch (\Exception $e) {
            $conn->rollback();
            $conn->close();
            return false;
        }
    }
}

?>