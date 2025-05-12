<?php

	$css = "portal";
	// include "first.php";

	if (isset($_GET["pg"])) {
		$page = $_GET["pg"];
		switch ($page) {
			case 'signup':
				include realpath(__DIR__."/components/portal/signup.php");
				break;
			case 'activate':
				include realpath(__DIR__."/components/portal/activate.php");
				break;
			case 'forgot':
				include realpath(__DIR__."/components/portal/forgot.php");
				break;
			case 'resetpass':
				include realpath(__DIR__."/components/portal/resetpass.php");
				break;
			default:
				header("Location: notfound404.html");
				exit;
			}
	} else {
		include realpath(__DIR__."/components/portal/login.php");
	}
		
	include "components/last.php"
?>
