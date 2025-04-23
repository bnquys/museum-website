<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");
use Museum\Object\Blog;
use Museum\Object\FileUploader;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['image'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $currentDate = date('Y-m-d H:i:s');
    $username = "bnquys";

    if (isset($_POST['editId'])) {
        // Chỉnh sửa bài viết
        $id = $_POST['editId'];
        updateBlog($id, $file, $title, $summary, $content, $currentDate, $username);
    } else {
        // Thêm mới bài viết
        $id = Blog::getNextId();
        addBlog($file, $id, $title, $summary, $content, $currentDate, $username);
    }
}

function addBlog($file, $id, $title, $summary, $content, $currentDate, $username) {
    $uploader = new FileUploader();

    $uploadResult = $uploader->upload($file);

    if ($uploadResult) {
        echo "File has been uploaded successfully. File path: " . $uploadResult;
    } else {
        echo "Error: " . $uploader->error;
        exit;
    }

    $blog = new Blog($id, $username, $title, $summary, $content, $uploadResult, $currentDate);
    Blog::add($blog);
    header("Location: dashboard.php");
    exit;
}

function updateBlog($id, $file, $title, $summary, $content, $currentDate, $username) {
    $blog = Blog::getById($id);
    
    // Nếu người dùng upload ảnh mới
    if ($file['size'] > 0) {
        $uploader = new FileUploader();
        $uploadResult = $uploader->upload($file);
        
        if ($uploadResult) {
            $blog->imgUrl = $uploadResult;
        } else {
            echo "Error: " . $uploader->error;
            exit;
        }
    }
    
    // Cập nhật các trường khác
    $blog->title = $title;
    $blog->summary = $summary;
    $blog->content = $content;
    $blog->uploadDate = $currentDate;
    $blog->username = $username;

    Blog::add($blog); // Hàm này sẽ cập nhật bài viết nếu ID đã tồn tại
    header("Location: dashboard.php");
    exit;
}

if (isset($_GET['editId'])) {
    $id = $_GET['editId'];

    $blog = Blog::getById($id);

    if ($blog) {
        // Load data vào form
        $title = $blog->title;
        $summary = $blog->summary;
        $content = $blog->content;
        $currentDate = date('Y-m-d H:i:s'); // Dùng ngày hiện tại cho update
        $username = $blog->username;
        $imgUrl = $blog->imgUrl;
    } else {
        // Nếu không tìm thấy blog
        echo "Blog not found.";
        exit;
    }
}
?>

<header class="bg-dark text-white text-center py-4">
    <h1><?= isset($blog) ? "Edit Article" : "Post New Article" ?></h1>
</header>

<div class="container mt-5">
    <form id="blogForm" action="" method="POST" enctype="multipart/form-data">
        <!-- Thêm ID bài viết vào form -->
        <?php if (isset($blog)): ?>
            <input type="hidden" name="editId" value="<?= $blog->id ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter the article title" value="<?= htmlspecialchars($title ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="summary">Summary:</label>
            <textarea class="form-control" id="summary" name="summary" required placeholder="Enter the article summary"><?= htmlspecialchars($summary ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required placeholder="Enter the article content"><?= htmlspecialchars($content ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Attach Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            <div id="imagePreview" class="mt-3" style="display: <?= isset($imgUrl) && $imgUrl ? 'block' : 'none' ?>;">
                <label>Image Preview:</label><br>
                <img id="previewImg" src="<?= htmlspecialchars($imgUrl ?? '') ?>" alt="Image Preview" style="max-width: 100%; max-height: 300px;">
                <?php if (isset($imgUrl) && $imgUrl): ?>
                    <button type="button" id="deleteImage" class="btn btn-danger mt-2">Delete Image</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="isShow" name="isShow" <?= isset($blog) && $blog->isShow ? 'checked' : '' ?>>
            <label class="form-check-label" for="isShow">Make this post public</label>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($blog) ? "Update Post" : "Submit Post" ?></button>
    </form>
</div>

<script>
    $('#image').change(function(event) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#previewImg').attr('src', e.target.result);
            $('#imagePreview').show();  
        };

        reader.readAsDataURL(this.files[0]);  
    });

    $('#deleteImage').click(function() {
    var confirmation = confirm("Are you sure you want to delete this image?");
    if (confirmation) {
        // Gửi yêu cầu AJAX để xóa ảnh
        $.ajax({
    type: 'POST',
    url: 'components/dashboard/delete_image.php',
    data: { id: '<?= $blog->id ?>' },
    success: function(response) {
        console.log(response);  // Kiểm tra phản hồi từ server
        try {
            var res = JSON.parse(response);  // Phân tích JSON
            if (res.success) {
                $('#previewImg').attr('src', '');
                $('#imagePreview').hide();
                alert("Image deleted successfully.");
            } else {
                console.log("Error: " + res.message);
                alert("Failed to delete the image: " + res.message);
            }
        } catch (e) {
            console.log("Error parsing JSON:", e);
            alert("Unexpected error occurred while processing the response.");
        }
    },
    error: function(xhr, status, error) {
        console.log("AJAX Error: " + error);
        alert("Error while deleting the image.");
    }
});


    }
});


</script>