<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
    
    $title = "Our Museum";
	include "components/first.php";
    include "components/navbar.php";
    include "components/carousel-slide.php";
	include "components/function-quote.php";
    include "components/ongoing-exhibitions-cards.php";
    include "components/upcoming-events.php";
    include "components/latest-blog.php";
    include "components/gallery.php";
    include "components/footer.php";
	include "components/last.php";
?>