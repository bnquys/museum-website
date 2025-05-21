<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Museum\Utils\JsonDataManager;
use Museum\Utils\FileUploader;

$imageManager = new JsonDataManager(__DIR__ . '/../../assets/data/carousel_img.json');
$textManager = new JsonDataManager(__DIR__ . '/../../assets/data/carousel_text.json');
$introText = $textManager->read('carousel_text') ?? [
    'opening_date' => '',
    'title' => '',
    'description' => ''
];

// Handle delete request
if (isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $imageManager->delete($deleteId);

    // Ghi lại vào file JSON
    $reflection = new ReflectionClass($imageManager);
    $property = $reflection->getProperty('filePath');
    $property->setAccessible(true);
    $filePath = $property->getValue($imageManager);
    file_put_contents($filePath, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header("Location: dashboard.php?page=carousel");
    exit;
}

if (isset($_GET['move']) && isset($_GET['id'])) {
    $direction = $_GET['move'];
    $id = $_GET['id']; // vì giờ id là hash (chuỗi)

    $items = $imageManager->readAll();
    $index = array_search($id, array_column($items, 'id'));

    if ($index !== false) {
        if ($direction === 'up' && $index > 0) {
            $imageManager->swap($items[$index]['id'], $items[$index - 1]['id']);
        } elseif ($direction === 'down' && $index < count($items) - 1) {
            $imageManager->swap($items[$index]['id'], $items[$index + 1]['id']);
        }
    }

    header("Location: dashboard.php?page=carousel");
    exit;
}

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['intro_text_submit'])) {
        $textManager = new JsonDataManager(__DIR__ . '/../../assets/data/carousel_text.json');
    
        // Xóa bản ghi cũ nếu đã tồn tại
        $textManager->delete("carousel_text");
    
        // Tạo bản ghi mới với ID cố định
        $textManager->create([
            'id' => 'carousel_text',
            'opening_date' => $_POST['opening_date'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['intro_description'] ?? '',
            'interval' => isset($_POST['interval_seconds']) ? (int)$_POST['interval_seconds'] * 1000 : 3000
        ]);
    
        header("Location: dashboard.php?page=carousel");
        exit;
    }    
    
    if (isset($_POST['image_submit'])) {
        $description = $_POST['description'] ?? '';
        $imagePath = '';

        if (!empty($_FILES['image']['tmp_name'])) {
            $uploader = new FileUploader("assets/uploads/carousel/");
            $uploadResult = $uploader->upload($_FILES["image"]);
            if (!$uploadResult) {
                $error = "Upload error: " . $uploader->error;
            } else {
                $imagePath = $uploadResult;
            }
        }

        if ($imagePath) {
            // Get next ID
            $existingItems = $imageManager->readAll();
            $filename = basename($imagePath);
            $nextId = sha1($filename);

            $imageManager->create([
                'id' => $nextId,
                'image_url' => $imagePath,
                'description' => $description
            ]);
            header("Location: dashboard.php?page=carousel");
            exit;
        }
    }
}

$carouselItems = $imageManager->readAll();
?>

<div class="container mt-4">
    <section>
        <h2 class="text-center mb-4">Carousel Manager</h2>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carouselItems as $index => $item): ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['description']) ?>" style="width: 160px; height: 90px; object-fit: cover;">
                        </td>
                        <td><?= htmlspecialchars($item['description']) ?></td>
                        <td class="text-center">
                            <a href="?page=carousel&move=up&id=<?= urlencode($item['id']) ?>" class="btn btn-sm btn-outline-secondary">⬆</a>
                            <a href="?page=carousel&move=down&id=<?= urlencode($item['id']) ?>" class="btn btn-sm btn-outline-secondary">⬇</a>
                            <a href="?page=carousel&deleteId=<?= urlencode($item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="mt-5">Add New Image</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">Select Image:</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
                <img id="image-preview" class="mt-2" style="max-height: 150px; max-width: 300px; display: none;" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" name='image_submit' class="btn btn-success">Upload</button>
        </form>
    </section>

    <section>
        <h4 class="mt-5">Carousel Intro Text</h4>
        <form method="POST">
            <div class="mb-3">
                <label for="opening_date" class="form-label">Opening Date</label>
                <input type="text" name="opening_date" class="form-control" value="<?= htmlspecialchars($introText['opening_date']) ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($introText['title']) ?>">
            </div>
            <div class="mb-3">
                <label for="intro_description" class="form-label">Description</label>
                <textarea name="intro_description" class="form-control" rows="3"><?= htmlspecialchars($introText['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="interval_seconds" class="form-label">Slide Interval (seconds)</label>
                <input type="number" min="1" name="interval_seconds" class="form-control" value="<?= isset($introText['interval']) ? (int)($introText['interval'] / 1000) : 3 ?>">
            </div>
            <button type="submit" name="intro_text_submit" class="btn btn-primary">Save Text</button>
        </form>
    </section>
</div>

<script>
document.querySelector('input[name="image"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
