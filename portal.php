<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$css = "portal";
	require_once "vendor/autoload.php";
	include "components/first.php";

	if (isset($_GET["pg"])) {
		$page = $_GET["pg"];
		switch ($page) {
			case 'fill-out':
			case 'signup':
				include realpath(__DIR__."/components/portal/fill-out.php");
				break;
			case 'create-account':
				include realpath(__DIR__.'/components/portal/create-account.php');
				break;
			case 'activate':
				include realpath(__DIR__."/components/portal/activate.php");
				break;
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
