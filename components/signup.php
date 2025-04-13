<?php
	$title = "Sign Up";
	include "first.php";
?>

<div class="position-relative">
			<img class="bg-img" src="assets/img/bgg.jpg" alt="" />
			<form
				action=""
				class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
				id="form"
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
						class="form-control"
						placeholder="Mc Donal"
					/>

					<label for="birth-year" class="form-label text-light"
						>Birth Year</label
					>
					<input
						type="number"
						name="birthYear"
						id="birth-year"
						class="form-control"
						min="1900"
					/>

					<label for="phone-number" class="form-label text-light"
						>Phone Number</label
					>
					<input
						type="tel"
						name="phoneNumber"
						id="phone-number"
						class="form-control"
					/>

					<label for="email" class="form-label text-light"
						>Email</label
					>
					<input
						type="email"
						name="email"
						id="email"
						class="form-control"
					/>

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
				class="form-control"
				id="username"
				name="username"
			/>

					<label for="password" class="form-label text-light"
						>Password</label
					>
					<input
						type="password"
						id="password"
						class="form-control"
						aria-describedby="passwordHelpBlock"
						name="password"
					/>
					<div id="passwordHelpBlock" class="form-text text-danger">
						Must be 8-20 characters long nha.
					</div>

			<label for="comfirm-pass" class="form-label text-light"
				>Confirm Password</label
			>
			<input
				type="password"
				id="comfirm-pass"
				class="form-control"
				name="comfirmPass"
				aria-describedby="passwordHelpBlock"
			/>

					<div class="d-flex justify-content-around">
						<a id ="btn-back" href="login.php?pg=signup" class="btn btn-success my-3">Back</a>
						<input type="submit" class="btn btn-success my-3"></input>
					</div>

		</div>
		<p class="text-light text-center mt-3 border-top pt-2">
			Have an account? <a href="login.php" id="btn-sign-in">Login</a><br>
			Or back to <a href="index.php">Home</a>
		</p>
	</form>
</div>