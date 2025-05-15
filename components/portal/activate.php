<?php
use Museum\Object\Account;
use Museum\Object\User;
use Museum\Utils\Mailer;
use Museum\Utils\UrlHelper;
use Museum\Utils\UserRegistrationManager;

$activateError = "";

if (!isset($_SESSION['register'])) {
    header("Location: login.php");
    exit;
}

$register = $_SESSION['register'];
$emailDisplay = $register['user']['email'];
$isChangePassword = $_SESSION['is_change_password'] ?? false;

// Gửi mã xác nhận nếu chưa gửi
// Mailer::sendMail($emailDisplay, $register['user']['name'], "Mã xác nhận của bạn", $register['account']['activateCode']);
if (!isset($_SESSION['activate_sent'])) {
    Mailer::sendMail($emailDisplay, $register['user']['name'], "Your confirmation code", $register['account']['activateCode']);
    $_SESSION['activate_sent'] = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = trim($_POST["activateCode"]);

    if ($code === $register['account']['activateCode']) {
        if ($isChangePassword) {
            if (Account::updatePasswordByEmail($register['account']['email'], $register['account']['password'])) {
                // Cập nhật xong, login lại và xóa session liên quan
                $_SESSION['login'] = $register['account']['username'];
                unset($_SESSION['register'], $_SESSION['activate_sent'], $_SESSION['change_pass'], $_SESSION['is_change_password']);
                header("Location: index.php");
                exit;
            } else {
                $activateError = "Unable to update password.";
            }

        } else {
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
                $activateError = "Registration failed.";
            }
        }

    } else {
        $activateError = "Incorrect confirmation code.";
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
		<p class="text-light mt-3">
			Didn't receive the code?
			<button id="resendBtn" class="btn btn-link p-0 text-decoration-underline">Resend Code</button>
			<span id="countdown" class="text-warning ms-2"></span>
		</p>

	</form>

	<script>
	document.addEventListener("DOMContentLoaded", function () {
		const resendBtn = document.getElementById("resendBtn");
		const countdownEl = document.getElementById("countdown");

		let timer;
		const cooldownSeconds = 30;

		function startCountdown() {
			let remaining = cooldownSeconds;
			resendBtn.disabled = true;
			countdownEl.textContent = `(${remaining}s)`;

			timer = setInterval(() => {
				remaining--;
				countdownEl.textContent = `(${remaining}s)`;

				if (remaining <= 0) {
					clearInterval(timer);
					countdownEl.textContent = "";
					resendBtn.disabled = false;
				}
			}, 1000);
		}

		resendBtn.addEventListener("click", function (e) {
			e.preventDefault();

			fetch("<?= UrlHelper::browserpath(__DIR__."/resend-code.php")?>")
				.then(res => res.json())
				.then(data => {
					alert(data.message);
					startCountdown();
				})
				.catch(err => {
					console.error(err);
					alert("Failed to resend code. Please try again later.");
				});
		});

		startCountdown();
	});
	</script>

</div>