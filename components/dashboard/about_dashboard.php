<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Museum\Utils\FileUploader;
use Museum\Utils\JsonDataManager;

$dataManager = new JsonDataManager(__DIR__ . '/../../assets/data/museum_data.json');
$museum = $dataManager->read('museum_info');
$about = $dataManager->read('museum_about');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update_museum_info'])) {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $opening_hours = [];

        foreach ($days as $day) {
            $opening_hours[$day] = [
                'opening' => $_POST["{$day}_opening"],
                'closing' => $_POST["{$day}_closing"],
                'closed' => isset($_POST["{$day}_closed"])
            ];        
        }

        $updateData = [
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'summary' => $_POST['summary'] ?? '',
            'opening_hours' => $opening_hours
        ];
        

        $dataManager->update('museum_info', $updateData);
        header("Location: dashboard.php?page=museum");
        exit;
    }

    if (isset($_POST['update_about'])) {
        $imagePath = $about['image'] ?? '';
    
        if (!empty($_FILES['about_image']['name'])) {
            $uploader = new FileUploader('assets/img/');
            $imagePath = $uploader->upload($_FILES['about_image']);
        }
    
        $aboutUpdate = [
            'id' => 'museum_about',
            'image' => $imagePath,
            'introduction' => [
                'title' => $_POST['about_title'],
                'content' => $_POST['about_content']
            ]
        ];
    
        if ($about) {
            $dataManager->update('museum_about', $aboutUpdate);
        } else {
            $dataManager->create($aboutUpdate);
        }
    
        header("Location: dashboard.php?page=museum");
        exit;
    }
    
}
?>

<div class="container mt-4">
    <h2 class="text-center">Museum Info Manager</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="name">Museum Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($museum['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($museum['address']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($museum['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($museum['phone']) ?>" required>
        </div>

        <h4>Opening Hours</h4>
        <?php
        $days = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday'
        ];

        foreach ($days as $key => $label) {
            $opening = $museum['opening_hours'][$key]['opening'] ?? '';
            $closing = $museum['opening_hours'][$key]['closing'] ?? '';
            $closed = $museum['opening_hours'][$key]['closed'] ?? false;
            $checked = $closed ? 'checked' : '';
            
            echo "
            <div class='mb-3'>
                <label>{$label}</label>
                <div class='d-flex align-items-center'>
                    <input type='time' name='{$key}_opening' class='form-control' value='{$opening}'>
                    <span class='mx-2'>to</span>
                    <input type='time' name='{$key}_closing' class='form-control' value='{$closing}'>
                    <div class='form-check ms-3'>
                        <input class='form-check-input' type='checkbox' name='{$key}_closed' value='1' {$checked}>
                        <label class='form-check-label'>Closed</label>
                    </div>
                </div>
            </div>";
        }
        ?>
        
        <div class="mb-3">
            <label for="summary">Opening Hours Summary</label>
            <textarea name="summary" class="form-control" rows="3"><?= htmlspecialchars($museum['summary'] ?? '') ?></textarea>
        </div>

        <button type="submit" name="update_museum_info" class="btn btn-success mt-3">Update Info</button>
    </form>

    <h2 class="mt-5">About Introduction Editor</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Cột trái: Upload ảnh -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="about_image">Introduction Image</label>
                    <input type="file" class="form-control" name="about_image">
                    <?php if (!empty($about['image'])): ?>
                        <div class="mt-2">
                            <img src="<?= htmlspecialchars($about['image']) ?>" alt="Intro Image" class="img-fluid" style="max-height: 200px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cột phải: Title và Content -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="about_title">Introduction Title</label>
                    <input type="text" class="form-control" name="about_title" value="<?= htmlspecialchars($about['introduction']['title'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="about_content">Introduction Content</label>
                    <textarea class="form-control" name="about_content" rows="6"><?= htmlspecialchars($about['introduction']['content'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <button type="submit" name="update_about" class="btn btn-primary mt-3">Update About Info</button>
    </form>

</div>
