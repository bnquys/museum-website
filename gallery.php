<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

    <?php include "components/favicon.php";?>

		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/boots-cus.css" />
		<link rel="stylesheet" href="assets/css/header.css" />
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Link jQuery for DropDown menu -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php 
        include "components/navbar.php";
        $name = "Gallery";
        include "components/banner.php";
        include "components/gallery.php";
        include "components/latest-blog.php";
        include "components/footer.php";
    ?>

    <script src="./assets/js/dropdown-menu.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/sip.js"></script>
</body>
</html>