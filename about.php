<?php


	$css = "about";
	$title = $banner = "About Us";
	include "components/first.php";
	include "components/navbar.php";
	include "components/banner.php";
	include "components/function-quote.php";

use Museum\Utils\HtmlManipulator;
use Museum\Utils\JsonDataManager;
	$dataManager = new JsonDataManager('assets/data/museum_data.json');
	$about = $dataManager->read('museum_about');
?>

	<section class="container-fluid py-5 mb-5 bg-green-light">
		<div class="text-center">
			<h2 name="title" class="mv-bt">Few words about our Museum</h2>
			<p class="text-gray mv-bt">Who are in extremely love with eco friendly system.</p>
		</div>
		<div
			class="d-flex flex-column flex-xl-row justify-content-center mt-5 mb-5"
		>
			<div id="frame" class="mb-5">
				<img
					src="<?= htmlspecialchars($about['image'])?>"
					alt=""
					class="shadow-lg mv-rl"
					id="banner-img"
				/>
			</div>
			<div
				class="shadow-lg img-responsive mt-5 mt-xl-0 mv-lr"
				style="padding: 6rem"
			>
				<?= $about['introduction']['title']?>
				<?php 
					$html = new HtmlManipulator($about['introduction']['content']);
					$html->addClass('p', 'text-gray mt-4');
					echo $html->getHtml();
				?>
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
