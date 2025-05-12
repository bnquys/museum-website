<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Museum\Utils\JsonDataManager;

$dataManager = new JsonDataManager(__DIR__ . '/../../assets/data/museum_data.json');
$museum = $dataManager->read('museum_info');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    $opening_hours = [];

    foreach ($days as $day) {
        $opening_hours[$day] = [
            'opening' => $_POST["{$day}_opening"],
            'closing' => $_POST["{$day}_closing"]
        ];
    }

    $updateData = [
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'opening_hours' => $opening_hours
    ];

    $dataManager->update('museum_info', $updateData);
    header("Location: dashboard.php?page=museum");
    exit;
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
            echo "
            <div class='mb-2'>
                <label>{$label}</label>
                <div class='d-flex'>
                    <input type='time' name='{$key}_opening' class='form-control' value='{$opening}' required>
                    <span class='mx-2'>to</span>
                    <input type='time' name='{$key}_closing' class='form-control' value='{$closing}' required>
                </div>
            </div>";
        }
        ?>

        <button type="submit" class="btn btn-success mt-3">Update Info</button>
    </form>
</div>
