<?php
	// session_start();
	$name = "Dashboard";
	$css = "dashboard";
	include "components/first.php";

	require_once realpath(__DIR__."/vendor/autoload.php");
	use Museum\Object\Blog;
    use Museum\Object\FileUploader;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$uploader = new FileUploader();

        $uploadResult = $uploader->upload($_FILES["image"]);

        if ($uploadResult) {
            echo "File has been uploaded successfully. File path: " . $uploadResult;
        } else {
            echo "Error: " . $uploader->error;
            exit;
        }

        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $currentDate = date('Y-m-d H:i:s');
        $username = "bnquys";

        $blog = new Blog(Blog::getNextId(), $username, $title, $summary, $content, $uploadResult, $currentDate);

        Blog::add($blog);
        header("Location: dashboard.php");
        exit;
	}

?>
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
						<li class="list-group-item">
							<a href="#" class="d-flex gap-2 text-light">
								<i class="bi bi-file-earmark-post"></i>
								<p class="m-0">An item</p>
							</a>
						</li>
						<li class="list-group-item">
							<a href="#" class="d-flex gap-2 text-light">
								<i class="bi bi-envelope"></i>
								<p class="m-0">A second item</p>
							</a>
						</li>
						<li class="list-group-item">
							<a href="#" class="d-flex gap-2 text-light">
								<i class="bi bi-android2"></i>
								<p class="m-0">A third item</p>
							</a>
						</li>
						<li class="list-group-item">
							<a href="#" class="d-flex gap-2 text-light">
								<i class="bi bi-balloon"></i>
								<p class="m-0">A fourth item</p>
							</a>
						</li>
						<li class="list-group-item">
							<a href="#" class="d-flex gap-2 text-light">
								<i class="bi bi-book"></i>
								<p class="m-0">And a fifth one</p>
							</a>
						</li>
					</ul>
				</aside>
			</div>
			<div class="col">
			<div class="container mt-4">
            <header class="bg-dark text-white text-center py-4">
    <h1>Post New Article</h1>
</header>

<div class="container mt-5">
    <form id="blogForm" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter the article title">
        </div>

        <div class="form-group">
            <label for="summary">Summary:</label>
            <textarea class="form-control" id="summary" name="summary" required placeholder="Enter the article summary"></textarea>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required placeholder="Enter the article content"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Attach Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            <div id="imagePreview" class="mt-3" style="display: none;">
                <label>Image Preview:</label><br>
                <img id="previewImg" src="" alt="Image Preview" style="max-width: 100%; max-height: 300px;">
                <button type="button" id="deleteImage" class="btn btn-danger mt-2">Delete Image</button>
            </div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="isShow" name="isShow" checked>
            <label class="form-check-label" for="isShow">Make this post public</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit Post</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Khi người dùng chọn tệp ảnh
    $('#image').change(function(event) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // Hiển thị hình ảnh xem trước
            $('#previewImg').attr('src', e.target.result);
            $('#imagePreview').show();  // Hiển thị phần xem trước
        };

        reader.readAsDataURL(this.files[0]);  // Đọc ảnh
    });

    // Khi người dùng nhấn nút xóa ảnh
    $('#deleteImage').click(function() {
        $('#image').val('');  // Xóa tệp ảnh đã chọn
        $('#imagePreview').hide();  // Ẩn phần xem trước
    });
</script>


			</div>

			</div>

			</div>
		</div>
<?php include "components/last.php";?>
