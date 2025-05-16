<?php
	session_start();
	require realpath(__DIR__."/../vendor/autoload.php");
	use Museum\Object\Account;

    // function format_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }

	if (isset($_SESSION['login'])) {
		$accountLogin = Account::getByUsername($_SESSION['login']);
	}

	// echo '<pre>'. print_r($_SESSION) .'</pre>';
?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?=$title?></title>
		<link rel="icon" type="image/x-icon" href="assets/img/museum.ico">

		<link rel="stylesheet" href="assets/css/carousel-banner.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/boots-cus.css" />
		<link rel="stylesheet" href="assets/css/card-slider.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/move.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/<?=$css?>.css" />

		<!-- Bootstrap icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
		
		<!-- Link CKEditor -->
		<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
		

	</head>
	<body>
