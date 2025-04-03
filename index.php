<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Our Museum</title>
		<link rel="icon" type="png" href="/assets/img/museum.png">

		<link rel="stylesheet" href="assets/css/carousel-banner.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/boots-cus.css" />
		<link rel="stylesheet" href="assets/css/card-slider.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/move.css" />
		<link rel="stylesheet" href="assets/css/main.css" />

		<!-- Links for Cards slider -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
			integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>

		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
			integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>

		<!-- Link jQuery for DropDown menu -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

		<link rel="stylesheet" href="./assets/css/move.css" />
	</head>
	<body>

<?php
    include "components/navbar.php";
    include "components/carousel-slide.php";
	include "components/function-quote.php";
    include "components/ongoing-exhibitions-cards.php";
    include "components/upcoming-events.php";
    include "components/latest-blog.php";
    include "components/gallery.php";
    include "components/footer.php";
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

		<script src="./assets/js/dropdown-menu.js"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"
			integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
		<script src="./assets/js/card-slider.js"></script>
		<script src="./assets/js/bootstrap.bundle.js"></script>
		<script src="./assets/js/sip.js"></script>
	</body>
</html>
