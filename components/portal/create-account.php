<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");

use Museum\Object\Account;

if (!isset($_SESSION['fillout'])) {
    header("Location: fill-out.php");
    exit;
}

$username = $password = $confirmPass = "";
$usernameError = $passwordError = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPass = trim($_POST["confirmPass"]);

    // Kiểm tra tên tài khoản
    if (Account::isUsernameExists($username)) {
        $usernameError = "Tên tài khoản đã được sử dụng.";
        $valid = false;
    }

    if (strlen($username) < 4 || strlen($username) > 20) {
        $usernameError = "Tên tài khoản phải dài từ 4-20 ký tự.";
        $valid = false;
    }

    // Kiểm tra mật khẩu
    if (strlen($password) < 8 || strlen($password) > 20) {
        $passwordError = "Mật khẩu phải dài từ 8-20 ký tự.";
        $valid = false;
    }

    if ($password !== $confirmPass) {
        $passwordError = "Mật khẩu không khớp.";
        $valid = false;
    }

    if ($valid) {
        $_SESSION['register'] = [
            'account' => [
                'username' => $username,
                'password' => $password,
                'activateCode' => Account::generateRandomNumbers(6) // chuẩn bị trước
            ],
            'user' => $_SESSION['fillout']
        ];
        unset($_SESSION['fillout']);
        header("Location: activate.php");
        exit;
    }
}
?>

<!-- HTML form -->
<form method="post" action="portal.php?pg=create-account">
    <div>
        <label for="username" class="form-label text-light"
            >Username</label
        >
        <input
            type="text"
            class="form-control <?= !isset($usernameError) ? 'is-invalid' : '' ?>"
            id="username"
            name="username"
            value="<?= $username?>"
            required
        />
        <div class="invalid-feedback"><?= $usernameError ?? '' ?></div>

        <label for="password" class="form-label text-light"
            >Password</label
        >
        <input
            type="password"
            id="password"
            class="form-control <?= !isset($passwordError) ? 'is-invalid' : '' ?>"
            aria-describedby="passwordHelpBlock"
            name="password"
            required
        />
        <div class="invalid-feedback text-danger"><?= $passwordError ?? '' ?></div>

        <label for="confirm-pass" class="form-label text-light"
            >Confirm Password</label
        >
        <input
            type="password"
            id="confirm-pass"
            class="form-control <?= !isset($passwordError) ? 'is-invalid' : '' ?>"
            name="confirmPass"
            aria-describedby="passwordHelpBlock"
            required
        />
        <div class="invalid-feedback text-danger"><?= $passwordError ?? '' ?></div>

        <div class="d-flex justify-content-around">
            <button id ="btn-back-to-fill-out" class="btn btn-success my-3">Back</button>
            <input id ="btn-activate" class="btn btn-success my-3" type="submit" value="Submit">
        </div>

    </div>
</form>
