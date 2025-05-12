<?php
	$title = "Forgot Password";
	include realpath(__DIR__."/../first.php");

	require_once realpath(__DIR__."/../../vendor/autoload.php");
	use Museum\Object\User;
	use Museum\Object\Account;
	use Museum\Utils\Mailer;

	$email = "";
	$error = $success = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = format_input($_POST["email"]);

		if (!User::verifyEmail($email)) {
			$error = "Email does not exist in the system.";
		} else {
			$code = rand(100000, 999999);
			$_SESSION["forgot"] = [
				"email" => $email,
				"code" => $code
			];

			$user = User::getByEmail($email);

			// Giả sử bạn có hàm sendEmail($to, $subject, $message)
			Mailer::sendMail($email, $user->name,"Reset Password Code", "Your code is: $code");

			$success = "A confirmation code has been sent to your email.";
			header("Location: login.php?pg=activate");
			exit;
		}
	}
?>

<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form method="post"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
	>
		<h1 class="text-center text-light fw-bold">Forgot Password</h1>
		<label class="form-label text-light">Enter your email</label>
		<input type="email" name="email" class="form-control" required>
		<p class="text-danger"><?= $error ?></p>
		<p class="text-success"><?= $success ?></p>
		<div class="d-flex justify-content-center">
			<input type="submit" value="Send Code" class="btn btn-success my-3">
		</div>
		<p class="text-light text-center">Back to <a href="login.php">Login</a></p>
	</form>
</div>
