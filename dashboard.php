<?php
	include "object/Blog.php";

	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["deleteId"])) {
			$id = $_GET["deleteId"];
			Blog::delete($id);
		}
	}

	$result = Blog::getListBlog(10);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/dashboard.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
		/>

		<!-- Link jQuery for DropDown menu -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<title>Dashboard</title>
		<link rel="icon" type="image/x-icon" href="assets/img/museum.ico" />
	</head>
	<body>
		<div class="container-fluid bg-success d-md-none sticky-top">
			<nav class="nav">
				<button
					class="btn btn-primary"
					type="button"
					data-bs-toggle="offcanvas"
					data-bs-target="#staticBackdrop"
					aria-controls="staticBackdrop"
				>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="16"
						height="16"
						fill="currentColor"
						class="bi bi-list"
						viewBox="0 0 16 16"
					>
						<path
							fill-rule="evenodd"
							d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
						/>
					</svg>
				</button>

				<div
					class="offcanvas offcanvas-start bg-success"
					data-bs-backdrop="static"
					tabindex="-1"
					id="staticBackdrop"
					aria-labelledby="staticBackdropLabel"
				>
					<div class="offcanvas-header text-light">
						<h5 class="offcanvas-title" id="staticBackdropLabel">
							Dashboard
						</h5>
						<button
							type="button"
							class="btn-close"
							data-bs-dismiss="offcanvas"
							aria-label="Close"
						></button>
					</div>
					<div class="offcanvas-body" id="offcanvas-body"></div>
				</div>
			</nav>
		</div>
		<div class="row container-fluid">
			<div class="col-auto p-0 d-none d-md-inline">
				<aside class="sticky-top bg-success">
					<button
						class="d-flex p-2 gap-1 btn btn-transparent text-light"
						id="btn-menu"
					>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="2rem"
							height="2rem"
							fill="currentColor"
							class="bi bi-grid"
							viewBox="0 0 16 16"
						>
							<path
								d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"
							/>
						</svg>
						<p class="h2">Dashboard</p>
					</button>
					<ul class="list-group" id="list-group">
						<li class="list-group-item d-flex gap-2 text-light">
							<i class="bi bi-file-earmark-post"></i>
							<p class="m-0">An item</p>
						</li>
						<li class="list-group-item d-flex gap-2 text-light">
							<i class="bi bi-envelope"></i>
							<p class="m-0">A second item</p>
						</li>
						<li class="list-group-item d-flex gap-2 text-light">
							<i class="bi bi-android2"></i>
							<p class="m-0">A third item</p>
						</li>
						<li class="list-group-item d-flex gap-2 text-light">
							<i class="bi bi-balloon"></i>
							<p class="m-0">A fourth item</p>
						</li>
						<li class="list-group-item d-flex gap-2 text-light">
							<i class="bi bi-book"></i>
							<p class="m-0">And a fifth one</p>
						</li>
					</ul>
				</aside>
			</div>
			<div class="col">
				<table>
					<caption>
						Blog Manager
					</caption>
					<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<!-- <th>Summary</th> -->
							<!-- <th>Content</th> -->
							<th>Image URL</th>
							<th>Upload Date</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($result as $blog) { ?>
							<tr>
								<td><?= $blog->id?></td>
								<td><?= $blog->title?></td>
								<td><?= $blog->imgUrl?></td>
								<td><?= $blog->uploadDate?></td>
								<td>
									<a href="dashboard.php?editId=<?= $blog->id?>">
										<i class="bi bi-pencil-square"></i>
									</a>
									<a href="dashboard.php?deleteId=<?= $blog->id?>">
										<i class="bi bi-trash3-fill"></i>
									</a>
								</td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<script src="assets/js/bootstrap.bundle.js"></script>
		<script src="assets/js/dashboard.js"></script>
	</body>
</html>
