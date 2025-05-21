<?php
	use Museum\Object\Event;
	$ongoings = Event::getOngoingExhibitions(6);
?>

<section id="exhibition" class="container-fluid py-6 ">
	<div class="container mb-5">
		<h2 name="title" class="text-center mv-bt">
			Ongoing Exhibitions from the scratch
		</h2>
		<p class="text-center text-gray fw-light mv-bt mb-6">
			Who are in extremely love with eco friendly system.
		</p>
		<div class="row responsive mv-tb">
		<?php if (empty($ongoings)):?>
			<div class="col-12 text-center">
				<p class="text-muted fst-italic">There are no ongoing exhibitions at the moment. Please check back later.</p>
			</div>
		<?php 
		else: foreach ($ongoings as $ex): ?>
			<div class="col-lg-4 bg-transparent">
				<div class="card border-0 bg-transparent">
					<div class="card-body p-0 border-0 bg-transparent">
						<img
							src="<?= $ex->imgUrl ?>"
							class="card-img-top"
							alt="<?= htmlspecialchars($ex->title) ?>"
						/>
						<div class="p-3">
							<div>
								<a href="#" class="btn btn-outline-secondary rounded-0 tag">EXHIBITION</a>
							</div>
							<p class="card-text mt-3">
								<?= htmlspecialchars($ex->summary) ?>
							</p>
							<p class="text-gray"><?= date("F j, Y", strtotime($ex->timeStart)) ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; endif;?>

		</div>
	</div>
</section>