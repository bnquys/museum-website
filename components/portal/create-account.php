<?php
use Museum\Object\Account;

if (!isset($_SESSION['fillout'])) {
    header("Location: portal.php?pg=fill-out");
    exit;
} 

$username = $password = $confirmPass = "";
$usernameError = $passwordError = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] !== "POST" && isset($_SESSION['register']['account']['username'])) {
    $username = $_SESSION['register']['account']['username'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPass = trim($_POST["confirmPass"]);

    // Kiểm tra tên tài khoản
    if (Account::isUsernameExists($username)) {
        $usernameError = "Username is already taken.";
        $valid = false;
    }

    if (strlen($username) < 4 || strlen($username) > 20) {
        $usernameError = "Username must be between 4 and 20 characters.";
        $valid = false;
    }

    // Kiểm tra mật khẩu
    if (strlen($password) < 8 || strlen($password) > 20) {
        $passwordError = "Password must be between 8 and 20 characters.";
        $valid = false;
    }

    if ($password !== $confirmPass) {
        $passwordError = "Passwords do not match.";
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
        // unset($_SESSION['fillout']);
        header("Location: portal.php?pg=activate");
        exit;
    }
}
?>

<!-- HTML form -->
<div class="position-relative">
    <img class="bg-img" src="assets/img/bgg.jpg" alt="" />
    <form 
        action="portal.php?pg=create-account"
        class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
        id="form"
        method="post"
    >
        <div>
            <h1 class="text-center text-light fw-bold">Sign up</h1>

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
                <a href="portal.php?pg=fill-out" class="btn btn-success my-3">Back</a>
                <input id ="btn-activate" class="btn btn-success my-3" type="submit" value="Submit">
            </div>
    
        </div>
    </form>
    
</div>