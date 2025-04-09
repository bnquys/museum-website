<div class="position-relative">
			<img class="bg-img" src="assets/img/bg.jpg" alt="" />
			<form
				action=""
				class="position-absolute top-50 start-50 translate-middle border p-5 rounded-5"
				id="form"
			>
				<h1 class="text-center text-light fw-bold">Login</h1>

				<div id="next-step">
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

					<input type="submit" class="btn btn-primary my-3"></input>

				</div>
				<p class="text-light text-center mt-3 border-top pt-2">
					Create an account? <a href="login.php?pg=signup" id="btn-sign-in">Sign Up</a>
				</p>
			</form>
		</div>