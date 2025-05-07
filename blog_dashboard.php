<?php
// require_once realpath(__DIR__."vendor/autoload.php");
require_once "vendor/autoload.php";

use Museum\Object\Blog;
use Museum\Object\FileUploader;

$action = $_GET['action'] ?? 'list';
$editId = $_GET['editId'] ?? null;
$deleteId = $_GET['deleteId'] ?? null;

// Handle blog deletion
if ($deleteId) {
    Blog::delete($deleteId);
    header("Location: blog_dashboard.php");
    exit;
}

// Handle blog submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploader = new FileUploader();
    $uploadResult = $uploader->upload($_FILES["image"]);

    if (!$uploadResult) {
        echo "Upload error: " . $uploader->error;
        exit;
    }

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $currentDate = date('Y-m-d H:i:s');
    $username = "bnquys";

    if (isset($_POST['editId'])) {
        $blog = new Blog($_POST['editId'], $username, $title, $summary, $content, $uploadResult, $currentDate);
        Blog::update($blog);
    } else {
        $blog = new Blog(Blog::getNextId(), $username, $title, $summary, $content, $uploadResult, $currentDate);
        Blog::add($blog);
    }

    header("Location: blog_dashboard.php");
    exit;
}

// Load blog data for editing
$editBlog = null;
if ($editId) {
    $editBlog = Blog::getById($editId);
    $action = 'form';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Blog Manager</h2>
    <a href="?action=form" class="btn btn-primary mb-3">Create a new blog</a>

    <?php if ($action === 'form'): ?>
        <h3><?= $editBlog ? "Edit Blog #{$editBlog->id}" : "Create New Blog" ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editBlog): ?>
                <input type="hidden" name="editId" value="<?= htmlspecialchars($editBlog->id) ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="<?= $editBlog->title ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <?php if ($editBlog): ?>
                    <img src="<?= htmlspecialchars($editBlog->imgUrl) ?>" alt="Current Image" style="max-width: 300px; max-height: 150px;" class="mt-2">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="summary">Summary:</label>
                <textarea class="form-control" name="summary" id="summary"><?= $editBlog->summary ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="content">Content:</label>
                <textarea class="form-control" name="content" id="content"><?= $editBlog->content ?? '' ?></textarea>
            </div>
            <button type="submit" class="btn btn-success"><?= $editBlog ? 'Update' : 'Post' ?></button>
            <a href="blog_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>

        <script>
            ClassicEditor.create(document.querySelector('#content')).catch(console.error);
            ClassicEditor.create(document.querySelector('#summary')).catch(console.error);
        </script>

    <?php else: ?>
        <?php $result = Blog::getListBlog(10); ?>
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
                <?php foreach ($result as $blog): ?>
                    <tr>
                        <td><?= htmlspecialchars($blog->id) ?></td>
                        <td><img src="<?= htmlspecialchars($blog->imgUrl) ?>" style="width: 160px; height: 90px; object-fit: cover;" class="img-fluid rounded"></td>
                        <td><?= htmlspecialchars($blog->username) ?></td>
                        <td><?= htmlspecialchars($blog->title) ?></td>
                        <td><?= htmlspecialchars($blog->summary) ?></td>
                        <td><?= htmlspecialchars($blog->uploadDate) ?></td>
                        <td class="text-center">
                            <a href="?editId=<?= urlencode($blog->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="?deleteId=<?= urlencode($blog->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete blog #<?= htmlspecialchars($blog->id) ?>?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
