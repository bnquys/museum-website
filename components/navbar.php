<?php
	require_once realpath(__DIR__."/../vendor/autoload.php");
	use Museum\Utils\JsonDataManager;

	$dataManager = new JsonDataManager(__DIR__ . '/../assets/data/museum_data.json');
	$museum = $dataManager->read('museum_info');
?>

<div class="fixed-top header">
	<div class="container-fluid border-light border-bottom">
		<div class="topbar container d-flex justify-content-between mt-2 pb-2">
			<div class>
				<!-- <span class="text-white me-4"><i class="fas fa-clock"></i> <?= htmlspecialchars($museum["summary"])?></span> -->
				<span class="text-white me-4"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($museum["address"])?></span>
				<span class="text-white me-4"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($museum["phone"])?></span>
			</div>
			<?php if(isset($accountLogin)) { ?>
				<div> <a href="user.php" class="d-inline text-light hover-link">Hello, <?= $accountLogin->getUser()->name?></a></div>
			<?php } else { ?>
				<div> <a href="portal.php" class="d-inline text-light hover-link">Login here</a></div>
			<?php }?>
		</div>
	</div>
	<nav
		class="navbar navbar-expand-lg bg-opacity-50 ms-2 ms-sm-0"
	>
		<div id="menu" class="container">
			<!-- MENU -->
			<a
				class="navbar-brand text-light fs-3 fw-bold"
				href="index.php"
				><img
					src="./assets/img/museum.ico"
					alt="Icon"
					width="35"
					height="35"
				/><span class="ps-lg-3 ps-2 glowing-text"
					><?= htmlspecialchars($museum["name"])?></span
				></a
			>

			<div class="dropdown d-lg-none navbar-toggler border-0">
				<button
					id="btn-menu"
					class="btn btn-secondary border-0 bg-transparent"
					type="button"
					data-bs-toggle="dropdown"
					aria-expanded="false"
				>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="40"
						height="40"
						fill="white"
						class="bi bi-list"
						viewBox="0 0 16 16"
					>
						<path
							fill-rule="evenodd"
							d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
						/>
					</svg>
				</button>
				<ul
					id="dropdown-menu"
					class="dropdown-menu dropdown-menu-end border-0"
				></ul>
			</div>

			<div
				class="collapse navbar-collapse"
				id="navbarSupportedContent"
			>
				<ul
					class="navbar-nav ms-auto mb-2 mb-lg-0 text-end pe-3 pe-lg-0 border-0"
				>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="index.php">Home</a>
					</li>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="about.php">About</a>
					</li>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="gallery.php">Gallery</a>
					</li>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="event.php">Event</a>
					</li>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="blog.php">Blog</a>
					</li>
					<li class="nav-item nav-link px-3 hover-link">
						<a href="contact.php">Contact</a>
					</li>
					<li class="nav-item nav-link px-3 btn-ticket hover-link">
						<a href="ticket.php">Buy Ticket</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>