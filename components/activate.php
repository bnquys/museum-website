<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
    $title = "Activate";
	include "first.php";

	if (!isset($_SESSION['register'])) {
		header("Location: login.php?pg=signup");
		exit;
	}

	require_once realpath(__DIR__."/../vendor/autoload.php");
	use Museum\Object\Account;
	use Museum\Object\User;
	
	$accountData = $_SESSION['register']['account'];
	$userData = $_SESSION['register']['user'];
	$activateError = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$activateCode = format_input($_POST["activateCode"]);

		if ($activateCode == $_SESSION['register']['account']['activateCode']) {
			$account = Account::forSignup(
				$accountData['username'],
				$userData['email'],
				$accountData['password']
			);

			$user = new User(
				$userData['name'],
				$userData['birthYear'],
				$userData['phoneNumber'],
				$userData['email']
			);

			echo "entered register!!";
			User::add($user);
			Account::add($account);
			$user->setForeignKey($account);

			$_SESSION['login'] = $account->username;

			header("Location: index.php");
			exit;
		} else {
			$activateError = "Wrong activation code!";
		}
	}

?>

<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="login.php?pg=activate"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
		method="post"
	>
		<h1 class="text-center text-light fw-bold">Activate</h1>
		<div id="first-step" class="">
			<label for="email" class="form-label text-light"
				>Email</label
			>
			<input 
				id="email"
				class="form-control" 
				type="text" 
				value="<?= $userData['email']?>" 
				aria-label="Disabled input example" 
				disabled readonly
			>
			<label for="activateCode" class="form-label text-light"
				>Enter your code from email</label
			>
			<input
				id="activateCode"
				type="text"
				name="activateCode"
				class="form-control <?= !isset($nameError) ? 'is-invalid' : ''?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $activateError ?></div>

			<div class="d-flex justify-content-around">
				<a href="login.php?pg=signup" class="btn btn-success my-3">Back</a>
				<input type="submit" class="btn btn-success my-3" value="Submit"></input>
			</div>

		</div>
		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>
