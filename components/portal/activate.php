<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once realpath(__DIR__."/../../vendor/autoload.php");

use Museum\Object\Account;
use Museum\Object\User;
use Museum\Utils\Mailer;
use Museum\Utils\UserRegistrationManager;

$activateError = "";

if (!isset($_SESSION['register'])) {
    header("Location: login.php");
    exit;
}

$register = $_SESSION['register'];
$emailDisplay = $register['user']['email'];

// Gửi mã xác nhận nếu chưa gửi
if (!isset($_SESSION['activate_sent'])) {
    Mailer::sendMail($emailDisplay, $register['user']['name'], "Mã xác nhận của bạn", $register['account']['activateCode']);
    $_SESSION['activate_sent'] = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST["activateCode"]);

    if ($code === $register['account']['activateCode']) {
        $account = Account::forSignup(
            $register['account']['username'],
            $register['user']['email'],
            $register['account']['password']
        );

        $user = new User(
            $register['user']['name'],
            $register['user']['birthDate'],
            $register['user']['phoneNumber'],
            $register['user']['email']
        );

        if (UserRegistrationManager::registerUser($user, $account)) {
            $_SESSION['login'] = $account->username;
            unset($_SESSION['register'], $_SESSION['activate_sent']);
            header("Location: index.php");
            exit;
        } else {
            $activateError = "Đăng ký thất bại.";
        }
    } else {
        $activateError = "Mã xác nhận sai.";
    }
}
?>

<!-- HTML form -->
<form method="post" action="activate.php">
    <label>Email: <?= htmlspecialchars($emailDisplay) ?></label><br>
    <input name="activateCode" placeholder="Nhập mã xác nhận">
    <div><?= $activateError ?></div>

    <button type="submit">Xác nhận</button>
</form>
