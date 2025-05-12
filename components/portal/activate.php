<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $title = "Activate";
    include realpath(__DIR__."/../first.php");

    require_once realpath(__DIR__."/../../vendor/autoload.php");

    use Museum\Object\Account;
    use Museum\Object\User;
    use Museum\Utils\UserRegistrationManager;

    $activateError = "";

    // Kiểm tra nếu không có session nào hợp lệ thì chuyển về login
    if (!isset($_SESSION['register']) && !isset($_SESSION['forgot'])) {
        header("Location: login.php");
        exit;
    }

    // Lấy email để hiển thị
    if (isset($_SESSION['register'])) {
        $emailDisplay = $_SESSION['register']['user']['email'];
    } elseif (isset($_SESSION['forgot'])) {
        $emailDisplay = $_SESSION['forgot']['email'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $activateCode = format_input($_POST["activateCode"]);

        if (isset($_SESSION['register']) && $activateCode == $_SESSION['register']['account']['activateCode']) {
            // Trường hợp xác minh đăng ký tài khoản
            $accountData = $_SESSION['register']['account'];
            $userData = $_SESSION['register']['user'];

            $account = Account::forSignup(
                $accountData['username'],
                $userData['email'],
                $accountData['password']
            );

            $user = new User(
                $userData['name'],
                $userData['birthDate'],
                $userData['phoneNumber'],
                $userData['email']
            );

            if (!UserRegistrationManager::registerUser($user, $account)) {
                $activateError = "Failed to register user.";
            } else {
                $_SESSION['login'] = $account->username;
                unset($_SESSION['register']);
                header("Location: index.php");
                // exit;
            }

        } elseif (isset($_SESSION['forgot']) && $activateCode == $_SESSION['forgot']['code']) {
            // Trường hợp xác minh quên mật khẩu
            header("Location: login.php?pg=resetpass");
            exit;
        } else {
            $activateError = "Wrong activation code!";
        }
    }
?>

<!-- HTML -->
<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="login.php?pg=activate"
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
			<a href="login.php" class="btn btn-success my-3">Back</a>
			<input type="submit" class="btn btn-success my-3" value="Submit">
		</div>

		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>
