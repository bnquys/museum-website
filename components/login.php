<?php
	use Museum\Object\Account;
	$title = "Login";
	include "first.php";

	function format_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$username = $password = "";
	$formSubmitted = false;
	$usernameIncorrect = false;
	$passwordIncorrect = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = format_input($_POST["username"]);
		$password = format_input($_POST["password"]);
		$formSubmitted = true;
	}



	if ($formSubmitted) {
		$account = new Account($username, $password);
		if(!$account->verifyUsername()) {
			$usernameIncorrect = true;
		}

		if ($account->exists()) {
			header('location:' . "dashboard.html");
		} else {
			$passwordIncorrect = true;
		}
	}

?>

<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
		method = "post"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
	>
		<h1 class="text-center text-light fw-bold">Login</h1>

		<div>
			<div>
				<label for="username" class="form-label text-light">Username</label>
				<input type="text" class="form-control <?php if($formSubmitted) {if (!$usernameIncorrect) {echo 'is-valid';} else {echo 'is-invalid';}}?>" id="username" name="username" value="<?=$username?>" required>
				<div id="validationServerUsernameFeedback" class="invalid-feedback">
					Username Incorrect.
				</div>
			</div>



			<div>
				<label for="password" class="form-label text-light">Username</label>
				<input type="password" class="form-control <?php if($formSubmitted && !$usernameIncorrect && $passwordIncorrect) echo 'is-invalid';?>" id="password" name="password" required>
				<div id="validationServerUsernameFeedback" class="invalid-feedback">
					Password Incorrect.
				</div>
			</div>
			

			<input type="submit" class="btn btn-primary my-3" value="Submit"></input>
			<p class="text-light text-center">Forgot your account? <a href="#">Click here</a></p>

		</div>
		<p class="text-light text-center mt-3 border-top pt-2">
			Create an account? <a href="login.php?pg=signup" id="btn-sign-in">Sign Up</a> <br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>