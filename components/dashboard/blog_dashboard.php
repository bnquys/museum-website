<?php
    function browser_path(string $filename): string {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $path = rtrim(dirname($_SERVER['REQUEST_URI']), '/');
    
        return $protocol . '://' . $host . $path . '/' . ltrim($filename, '/');
    }
    

	require_once realpath(__DIR__."/../../vendor/autoload.php");
	use Museum\Object\Blog;
    use Museum\Utils\FileUploader;
    use Museum\Utils\UrlHelper;
        
    $action = $_GET['action'] ?? 'list';
    $editId = $_GET['editId'] ?? null;
    $deleteId = $_GET['deleteId'] ?? null;

    // Handle blog deletion
    if ($deleteId) {
        Blog::delete($deleteId);
        header("Location: dashboard.php?page=blog");
        exit;
    }

    // Handle blog submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imagePath = $_POST['old_image'] ?? '';

        if (!empty($_FILES['image']['tmp_name'])) {
            $uploader = new FileUploader("assets/uploads/blog/");
            $uploadResult = $uploader->upload($_FILES["image"]);

            if (!$uploadResult) {
                // echo "Upload error: " . $uploader->error;
                exit;
            }

            $imagePath = $uploadResult; 
        }


        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $currentDate = date('Y-m-d H:i:s');

        if (isset($_POST['editId'])) {
            $blog = new Blog($_POST['editId'], $userAdmin, $title, $summary, $content, $imagePath, $currentDate);
            Blog::add($blog);
        } else {
            $blog = new Blog(Blog::getNextId(), $userAdmin, $title, $summary, $content, $uploadResult, $currentDate);
            Blog::add($blog);
        }

        header("Location: dashboard.php?page=blog");
        exit;
    }

    // Load blog data for editing
    $editBlog = null;
    if ($editId) {
        $editBlog = Blog::getById($editId);
        $action = 'form';
    }
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Blog Manager</h2>
    <a href="?page=blog&action=form" class="btn btn-primary mb-3">Create a new blog</a>

    <?php if ($action === 'form'): ?>
        <h3><?= $editBlog ? "Edit Blog #{$editBlog->id}" : "Create New Blog" ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editBlog): ?>
                <input type="hidden" name="editId" value="<?= htmlspecialchars($editBlog->id) ?>">
                <?php if ($editBlog): ?>
                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($editBlog->imgUrl) ?>">
                <?php endif; ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="<?= $editBlog->title ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <?php if ($editBlog): ?>
                    <img src="<?= htmlspecialchars($editBlog->imgUrl) ?>" alt="Current Image" style="max-width: 300px; max-height: 150px;" class="mt-2" id="image-preview">
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
            <a href="dashboard.php?page=blog" class="btn btn-secondary">Cancel</a>
        </form>

        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    ckfinder: {
                        uploadUrl: '<?= UrlHelper::browserpath('components/dashboard/blog_fileupload.php')?>'
                    }
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#summary'), {
                    removePlugins: ['ImageUpload', 'EasyImage', 'MediaEmbed'],
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
                })
                .catch(error => {
                    console.error(error);
                });
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
                        <td><?= $blog->summary?></td>
                        <td><?= htmlspecialchars($blog->uploadDate) ?></td>
                        <td class="text-center">
                            <a href="?page=blog&editId=<?= urlencode($blog->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="?page=blog&deleteId=<?= urlencode($blog->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete blog #<?= htmlspecialchars($blog->id) ?>?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>
document.querySelector('input[name="image"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('image-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'image-preview';
                preview.style.maxWidth = '300px';
                preview.style.maxHeight = '150px';
                preview.className = 'mt-2';
                event.target.parentNode.appendChild(preview);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>