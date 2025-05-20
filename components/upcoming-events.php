<?php
	use Museum\Object\Event;
	$upcomings = Event::getUpcomingEvents();
?>

<section class="container-fluid py-6 pb-0">
	<div class="container">
		<h2 name="title" class="text-center mv-bt">Checkout our Upcoming Events</h2>
		<p class="text-center text-gray fw-light mv-bt">
			Who are in extremely love with eco friendly system.
		</p>
	</div>
</section>



<section class="events mv-bt">
	<div class="container-event">
		<?php foreach ($upcomings as $index => $event): 
			// Sinh background-position dựa trên index (0-based)
			$horizontal = 45 + (10 * ($index % 4)); // ví dụ: 45%, 55%, 65%, 75%
			$vertical = [8, 25, 35, 2][$index % 4]; // lặp lại 4 vị trí dọc phổ biến
		?>
			<div 
				class="item" 
				style="
					background-image: url('<?= $event->imgUrl ?>');
					background-size: cover;
					background-position: <?= $horizontal ?>% <?= $vertical ?>%
				"
			>
				<a href="more.php?type=event&id=<?= $event->id ?>" class="quote text-decoration-none text-white">
					<p class="fw-bold"><?= htmlspecialchars($event->title) ?><br>
					<span class="fw-light"><?= date('F j, Y', strtotime($event->timeStart)) ?></span></p>
				</a>
			</div>
		<?php endforeach; ?>

	</div>
</section>