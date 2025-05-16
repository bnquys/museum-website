<?php
use Museum\Object\Account;

$username = $password = $confirmPass = "";
$usernameError = $passwordError = "";
$valid = true;

$isChangePassword = false;
$email = "";

// Kiểm tra nếu đang đổi mật khẩu từ user.php
if (isset($_SESSION['change_pass'])) {
    $isChangePassword = true;
    $changeData = $_SESSION['change_pass'];
    $username = $changeData['username'];
    $email = $changeData['email'];
}

// Nếu không phải đổi mật khẩu và không có dữ liệu điền từ form -> chuyển về fill-out
if (!isset($_SESSION['fillout']) && !$isChangePassword) {
    header("Location: portal.php?pg=fill-out");
    exit;
}

// Nếu là GET và đã có dữ liệu cũ trong session (chế độ đăng ký)
if (
    $_SERVER["REQUEST_METHOD"] !== "POST" &&
    !$isChangePassword &&
    isset($_SESSION['register']['account']['username'])
) {
    $username = $_SESSION['register']['account']['username'];
}

// Xử lý form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirmPass = trim($_POST["confirmPass"]);

    // Nếu là tạo tài khoản mới thì kiểm tra username có tồn tại
    if (!$isChangePassword && Account::isUsernameExists($username)) {
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
                'email' => $email ?: $_SESSION['fillout']['email'],
                'activateCode' => Account::generateRandomNumbers(6)
            ],
            'user' => $isChangePassword ? $_SESSION['change_pass'] : $_SESSION['fillout']
        ];
        $_SESSION['is_change_password'] = $isChangePassword;
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
        <h1 class="text-center text-light fw-bold">
            <?= $isChangePassword ? 'Change Password' : 'Sign Up' ?>
        </h1>

        <!-- Username -->
        <label for="username" class="form-label text-light">Username</label>
        <?php if ($isChangePassword): ?>
            <input
                type="text"
                class="form-control"
                id="username"
                value="<?= htmlspecialchars($username) ?>"
                readonly disabled
            />
            <!-- Hidden input để đảm bảo form gửi dữ liệu -->
            <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>" />
        <?php else: ?>
            <input
                type="text"
                class="form-control <?= $usernameError ? 'is-invalid' : '' ?>"
                id="username"
                name="username"
                value="<?= htmlspecialchars($username) ?>"
                required
            />
        <?php endif; ?>

        <div class="invalid-feedback"><?= $usernameError ?? '' ?></div>

        <!-- Password -->
        <label for="password" class="form-label text-light">Password</label>
        <input
            type="password"
            id="password"
            class="form-control <?= $passwordError ? 'is-invalid' : '' ?>"
            name="password"
            required
        />
        <div class="invalid-feedback text-danger"><?= $passwordError ?? '' ?></div>

        <!-- Confirm Password -->
        <label for="confirm-pass" class="form-label text-light">Confirm Password</label>
        <input
            type="password"
            id="confirm-pass"
            class="form-control <?= $passwordError ? 'is-invalid' : '' ?>"
            name="confirmPass"
            required
        />
        <div class="invalid-feedback text-danger"><?= $passwordError ?? '' ?></div>

        <!-- Buttons -->
        <div class="d-flex justify-content-around">
            <?php if (!$isChangePassword): ?>
                <a href="portal.php?pg=fill-out" class="btn btn-success my-3">Back</a>
            <?php else: ?>
                <a href="user.php" class="btn btn-success my-3">Cancel</a>
            <?php endif; ?>
            <input id="btn-activate" class="btn btn-success my-3" type="submit" value="Submit">
        </div>
        </div>
    </form>
</div>
