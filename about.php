<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>About Us</title>
		<link rel="icon" type="image/x-icon" href="assets/img/museum.ico">

		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/boots-cus.css" />
		<link rel="stylesheet" href="assets/css/header.css" />
		<link rel="stylesheet" href="assets/css/move.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <!-- Link jQuery for DropDown menu -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	</head>
	<body>
		<?php
            include "components/navbar.php";
			$name = "About Us";
            include "components/banner.php";
            include "components/function-quote.php";
        ?>

		<section class="container mt-5">
			<div class="text-center">
				<h2>Few words about our Museum</h2>
				<p>Who are in extremely love with eco friendly system.</p>
			</div>
			<div
				class="d-flex flex-column flex-xl-row justify-content-center mt-5"
			>
				<img
					src="https://picsum.photos/555/650"
					alt=""
					class="shadow-lg"
					id="banner-img"
				/>
				<div
					class="shadow-lg img-responsive mt-5 mt-xl-0"
					style="padding: 6rem"
				>
					<h3>
						We Realize that <br />there are reduced <br />Wastege
						Stand out
					</h3>
					<p class="mt-4">
						Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Suscipit eveniet fugiat quo quas placeat praesentium
						nisi adipisci perferendis enim qui omnis voluptas quam
						quisquam neque, vero magnam aliquam id laboriosam.
						Eligendi atque, voluptates dolorem praesentium molestiae
						deserunt ab, quibusdam eum, voluptatem ullam rem
						mollitia recusandae quam cum tenetur cumque sequi.
					</p>
				</div>
			</div>
		</section>

        <?php 
            include "components/latest-blog.php";
            include "components/footer.php";
        ?>
        <script src="./assets/js/dropdown-menu.js"></script>
		<script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/sip.js"></script>
	</body>
</html>
