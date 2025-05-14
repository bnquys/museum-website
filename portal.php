<?php

	$css = "portal";
	include "components/first.php";

	if (isset($_GET["pg"])) {
		$page = $_GET["pg"];
		switch ($page) {
			case 'signup':
				include realpath(__DIR__."/components/portal/fill-out.php");
				break;
			case 'create-account':
				include realpath(__DIR__.'/components/portal/create-account.php');
			// case 'activate':
			// 	include realpath(__DIR__."/components/portal/activate.php");
			// 	break;
			// case 'forgot':
			// 	include realpath(__DIR__."/components/portal/forgot.php");
			// 	break;
			// case 'resetpass':
			// 	include realpath(__DIR__."/components/portal/resetpass.php");
			// 	break;
			default:
				include realpath(__DIR__.'/components/portal/login.php');
				break;
			}
	} else {
		include realpath(__DIR__."/components/portal/login.php");
	}
		
	include "components/last.php"
?>
