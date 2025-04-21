<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);

	$title = "Login";
	include realpath(__DIR__."/first.php");

	require_once realpath(__DIR__."/../vendor/autoload.php");
	use Museum\Object\Account;

	$username = $password = "";
	$usernameIncorrect = false;
	$passwordIncorrect = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = format_input($_POST["username"]);
		$password = format_input($_POST["password"]);
	
		$account = Account::forLogin($username, $password);

		if (!Account::isUsernameExists($username)) {
			$usernameIncorrect = true;
		} else {
			if ($account->exists()) {
				$_SESSION['login'] = $username;
				header('Location: dashboard.php');
				exit;
			} else {
				$passwordIncorrect = true;
			}
		}
	}

?>

<!-- HTML Form -->
<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="background" />
	<form
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		method = "post"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
	>
		<h1 class="text-center text-light fw-bold">Login</h1>

		<div>
			<!-- Username  -->
			<div>
				<label for="username" class="form-label text-light">Username</label>
				<input 
					type="text" 
					class="form-control <?= $usernameIncorrect ? 'is-invalid' : ($username !== '' ? 'is-valid' : '') ?>" 
					id="username" 
					name="username" 
					value="<?= htmlspecialchars($username) ?>" 
					required
				>
				<div class="invalid-feedback text-danger">
					Username Incorrect.
				</div>
			</div>

			<!-- Password -->
			<div>
				<label for="password" class="form-label text-light">Password</label>
				<input 
					type="password" 
					class="form-control <?= (!$usernameIncorrect && $passwordIncorrect) ? 'is-invalid' : '' ?>" 
					id="password" 
					name="password" 
					required>
				<div class="invalid-feedback text-danger">
					Password Incorrect.
				</div>
			</div>
			

			<div class="d-flex justify-content-center">
				<input type="submit" class="btn btn-success my-3" value="Submit"></input>
			</div>
			<p class="text-light text-center mb-0 mt-2">Forgot your account? <a href="#">Click here</a></p>

		</div>
		<p class="text-light text-center mt-1 border-top pt-2">
			Create an account? <a href="login.php?pg=signup" id="btn-sign-in">Sign Up</a> <br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>