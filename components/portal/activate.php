<?php
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
// Mailer::sendMail($emailDisplay, $register['user']['name'], "Mã xác nhận của bạn", $register['account']['activateCode']);
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
            unset($_SESSION['register'], $_SESSION['activate_sent'], $_SESSION['fillout']);
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

<!-- HTML -->
<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="portal.php?pg=activate"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
		method="post"
	>
		<h1 class="text-center text-light fw-bold">Activate</h1>

		<label for="email" class="form-label text-light">Email</label>
		<input 
			id="email"
			class="form-control" 
			type="text" 
			value="<?= htmlspecialchars($emailDisplay) ?>" 
			aria-label="Disabled input example" 
			disabled readonly
		>

		<label for="activateCode" class="form-label text-light">Enter your code from email</label>
		<input
			id="activateCode"
			type="text"
			name="activateCode"
			class="form-control <?= $activateError !== "" ? 'is-invalid' : '' ?>"
			required
		/>
		<div class="invalid-feedback text-danger"><?= $activateError ?></div>

		<div class="d-flex justify-content-around">
			<a href="portal.php?pg=create-account" class="btn btn-success my-3">Back</a>
			<input type="submit" class="btn btn-success my-3" value="Submit">
		</div>

		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>