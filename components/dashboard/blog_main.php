<?php
	require_once realpath(__DIR__."/../../vendor/autoload.php");
	use Museum\Object\Blog;

	$result = Blog::getListBlog(10);
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Blog Manager</h2>
	<a href="dashboard.php" class="btn btn-primary">Create a new blog</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Upload Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $blog) { ?>
                    <tr>
                        <td><?= htmlspecialchars($blog->id) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($blog->imgUrl) ?>"
                                 alt="Thumbnail"
                                 class="img-fluid rounded"
                                 style="width: 160px; height: 90px; object-fit: cover;">
                        </td>
                        <td><?= htmlspecialchars($blog->username) ?></td>
                        <td>
                            <div class="text-truncate d-block" style="max-width: 250px;">
                                <?= htmlspecialchars($blog->title) ?>
                            </div>
                        </td>
                        <td>
                            <div class="text-truncate d-block" style="max-width: 250px;">
                                <?= htmlspecialchars($blog->summary) ?>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($blog->uploadDate) ?></td>
                        <td class="text-center">
                            <a href="dashboard.php?editId=<?= urlencode($blog->id) ?>"
                               class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="dashboard.php?deleteId=<?= urlencode($blog->id) ?>"
                               class="btn btn-sm btn-outline-danger" title="Delete">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>