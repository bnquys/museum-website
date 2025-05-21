<?php
use Museum\Object\User;

$name = $birthDate = $phoneNumber = $email = "";
$nameError = $phoneNumberError = $emailError = "";
$valid = true;

if (isset($_SESSION['fillout']) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    $name = $_SESSION['fillout']['name'] ?? '';
    $birthDate = $_SESSION['fillout']['birthDate'] ?? '';
    $phoneNumber = $_SESSION['fillout']['phoneNumber'] ?? '';
    $email = $_SESSION['fillout']['email'] ?? '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['subscribeEmail'])) {
        $email = trim($_POST['subscribeEmail']);
        $name = $birthDate = $phoneNumber = ''; // giữ trống các field khác
    } else {
        $name = trim($_POST["name"] ?? '');
        $birthDate = trim($_POST["birthDate"] ?? '');
        $phoneNumber = trim($_POST["phoneNumber"] ?? '');
        $email = trim($_POST["email"] ?? '');
    }

    if (empty($name) || !preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError = "Invalid name. Only letters and spaces are allowed.";
        $valid = false;
    }

    if (!preg_match('/^0\d{9}$/', $phoneNumber)) {
        $phoneNumberError = "Invalid phone number. It must start with 0 and contain 10 digits.";
        $valid = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $valid = false;
    } elseif (User::emailExists($email)) {
        $emailError = "Email is already registered.";
        $valid = false;
    }    

    if ($valid) {
        $_SESSION['fillout'] = compact("name", "birthDate", "phoneNumber", "email");
        header("Location: portal.php?pg=create-account");
        exit;
    }
}
?>

<!-- HTML form -->
<div class="position-relative">
	<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
	<form
		action="portal.php?pg=signup"
		class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
		id="form"
		method="post"
	>
		<h1 class="text-center text-light fw-bold">Sign up</h1>
		<div>
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

            <label for="birthDate" class="form-label text-light">Date of Birth</label>
            <input
                type="date"
                name="birthDate"
                id="birthDate"
                class="form-control"
                value="<?= htmlspecialchars($birthDate) ?>"
                min="<?= date('Y-m-d', strtotime('-120 years')) ?>"
                max="<?= date('Y-m-d') ?>"
                required
            />

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
				class="form-control <?= !isset($emailError) ? 'is-invalid' : '' ?>"
				value="<?= $_POST['subscribeEmail'] ?? $email ?>"
				required
			/>
			<div class="invalid-feedback text-danger"><?= $emailError ?? '' ?></div>

			<div class="d-flex justify-content-center">
				<input
					id="btn-show-create-account"
					type="submit"
					class="btn btn-success my-3"
                    value="Next step"
                >
				</i>
			</div>
		</div>

		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>
<script>
    $(document).ready(function () {
        $('title').text('Sign up | Museum');
    });
</script>