<?php
    $title = "Reset Password";
    include realpath(__DIR__."/../first.php");

	require_once realpath(__DIR__."/../../vendor/autoload.php");
	use Museum\Object\Account;

	$error = $success = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$newPassword = format_input($_POST["newPassword"]);
		$email = $_SESSION["forgot"]["email"];

		if (Account::updatePasswordByEmail($email, $newPassword)) {
            unset($_SESSION["forgot"]);
            header("Location: login.php");
            exit;
        } else {
            $error = "Có lỗi xảy ra khi cập nhật mật khẩu.";
        }

		$success = "Mật khẩu đã được đặt lại thành công.";
		unset($_SESSION["forgot"]);
		header("Location: login.php");
		exit;
	}
?>

<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form method="post"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
	>
		<h1 class="text-center text-light fw-bold">Reset Password</h1>
		<label class="form-label text-light">New Password</label>
		<input type="password" name="newPassword" class="form-control" required>
		<p class="text-success"><?= $success ?></p>
		<div class="d-flex justify-content-center">
			<input type="submit" value="Reset" class="btn btn-success my-3">
		</div>
	</form>
</div>
