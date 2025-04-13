<?php
	$css = "portal";
	include "first.php";

	if (isset($_GET["pg"])) {
		$page = $_GET["pg"];
		switch ($page) {
			case 'signup':
				include "components/signup.php";
				break;
				
			default:
				include "components/login.php";
				break;
			}
	} else {
		include "components/login.php";
	}
		
	include "components/last.php"
?>
