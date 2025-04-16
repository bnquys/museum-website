<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$title = "Sign Up";
	include "first.php";

	require_once realpath(__DIR__."/../vendor/autoload.php");
	use Museum\Object\Account;
	use Museum\Object\User;

	$name = $birthYear = $phoneNumber = $email = $username = $password = $confirmPass = "";
	$emailError = $usernameError = $passwordError = "";
	// $nameError = $birthYearError = $phoneNumberError = "";
	$formSubmitted = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = format_input($_POST["name"]);
		$birthYear = format_input($_POST["birthYear"]);
		$phoneNumber = format_input($_POST["phoneNumber"]);
		$email = format_input($_POST["email"]);
		$username = format_input($_POST["username"]);
		$password = format_input($_POST["password"]);
		$confirmPass = format_input($_POST["confirmPass"]);
		$formSubmitted = true;
	}

	if($formSubmitted) {
		$valid = true;

		// Validate email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailError = "Invalid email format";
			$valid = false;
		} elseif (User::verifyEmail($email)) {
			$emailError = "Email is already registered";
			$valid = false;
		}

		// Validate username
		if (Account::verifyUsername($username)) {
			$usernameError = "Username is already taken";
			$valid = false;
		}

		// Validate password length
		if (!isValidPasswordLength($password)) {
			$passwordError = "Password must be between 8 and 20 characters";
			$valid = false;
		}

		// Validate other fields
		if (!isValidFullName($name)) {
			$nameError = "Invalid name format";
			$valid = false;
		}

		if (!isValidYearAndAge($birthYear)) {
			$birthYearError = "Please enter a valid birth year";
			$valid = false;
		}

		if (!isValidPhoneNumber($phoneNumber)) {
			$phoneNumberError = "Invalid phone number format";
			$valid = false;
		}

		// Validate password confirmation
		if ($password !== $confirmPass) {
			$passwordError = "Passwords do not match";
			$valid = false;
		}

		if ($valid) {
			$user = new User($name, $birthYear, $phoneNumber, $email);
			User::add($user);
			
			$account = new Account($username, $email, $password);
			Account::add($account);
			$user->setForeignKey($account);
		}
	}

?>

<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="login.php?pg=signup"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
		method="post"
	>
		<h1 class="text-center text-light fw-bold">Sign up</h1>
		<div id="first-step" class="">
			<label for="name" class="form-label text-light"
				>Your name</label
			>
			<input
				type="text"
				name="name"
				id="name"
				class="form-control <?= isset($nameError) ? 'is-invalid' : ''?>"
				placeholder="Mc Donal"
				value="<?= $name?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $nameError ?? ''?></div>

			<label for="birth-year" class="form-label text-light"
				>Birth Year</label
			>
			<input
				type="number"
				name="birthYear"
				id="birth-year"
				class="form-control <?= isset($birthYearError) ? 'is-invalid' : '' ?>"
				min="1900"
				max=<?= date("Y")?>
				value="<?= $birthYear?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $birthYearError ?? '' ?></div>

			<label for="phone-number" class="form-label text-light"
				>Phone Number</label
			>
			<input
				type="tel"
				name="phoneNumber"
				id="phone-number"
				class="form-control <?= isset($phoneNumberError) ? 'is-invalid' : '' ?>"
				value="<?= $phoneNumber?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $phoneNumberError ?? '' ?></div>

			<label for="email" class="form-label text-light"
				>Email</label
			>
			<input
				type="email"
				name="email"
				id="email"
				class="form-control <?= isset($emailError) ? 'is-invalid' : '' ?>"
				value="<?= $email?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $emailError ?? '' ?></div>

			<div class="d-flex justify-content-center">
				<button
					id="show-next-steps"
					type="button"
					class="btn btn-success my-3"
				>
					Next steps
				</button>
			</div>
		</div>

		<div id="next-step" class="d-none">
			<label for="username" class="form-label text-light"
				>Username</label
			>
			<input
				type="text"
				class="form-control <?= isset($usernameError) ? 'is-invalid' : '' ?>"
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
				class="form-control <?= isset($passwordError) ? 'is-invalid' : '' ?>"
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
				class="form-control <?= isset($passwordError) ? 'is-invalid' : '' ?>"
				name="confirmPass"
				aria-describedby="passwordHelpBlock"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $passwordError ?? '' ?></div>

			<div class="d-flex justify-content-around">
				<button id ="btn-back" class="btn btn-success my-3">Back</button>
				<input type="submit" class="btn btn-success my-3" value="Submit"></input>
			</div>

		</div>
		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>

<?php
	function isValidYearAndAge($year) {
		if (!is_numeric($year)) {
			return false; 
		}

		$year = (int)$year;

		$currentYear = date("Y");
		if ($year <= 0 || $year > $currentYear) {
			return false; 
		}

		$age = $currentYear - $year;

		if ($age <= 0) {
			return false; 
		}

		return true; 
	}

	function isValidFullName($fullName) {
		if (empty($fullName)) {
			return false; 
		}

		$fullName = trim($fullName);

		if (!preg_match("/^[a-zA-Z\s]+$/", $fullName)) {
			return false; 
		}

		return true; 
	}

	function formatFullName($fullName) {
		$fullName = trim($fullName);
		
		$fullName = preg_replace('/\s+/', ' ', $fullName);
		
		$fullName = ucwords(strtolower($fullName));
		
		return $fullName;
	}

	function isValidPhoneNumber($phone) {
		$phone = str_replace(' ', '', $phone);

		$phonePattern = '/^0\d{9}$/'; 

		return preg_match($phonePattern, $phone);
	}

	function isValidPasswordLength($password) {
		return strlen($password) >= 8 && strlen($password) <= 20;
	}

?>