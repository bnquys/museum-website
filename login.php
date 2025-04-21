<?php

	$css = "portal";
	// include "first.php";

	if (isset($_GET["pg"])) {
		$page = $_GET["pg"];
		switch ($page) {
			case 'signup':
				include realpath(__DIR__."/components/signup.php");
				break;
			case 'activate':
				include realpath(__DIR__."/components/activate.php");
				break;
			default:
				include realpath(__DIR__."/components/login.php");
				break;
			}
	} else {
		include realpath(__DIR__."/components/login.php");
	}
		
	include "components/last.php"
?>
