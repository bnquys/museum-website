<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");
use Museum\Object\Event;
use Museum\Utils\FileUploader;
use Museum\Utils\UrlHelper;

$action = $_GET['action'] ?? 'list';
$editId = $_GET['editId'] ?? null;
$deleteId = $_GET['deleteId'] ?? null;

// Handle delete
if ($deleteId) {
    Event::delete($deleteId);
    header("Location: dashboard.php?page=event");
    exit;
}

// Handle order change
if (isset($_GET['move']) && isset($_GET['id'])) {
    $direction = $_GET['move'];
    $id = $_GET['id'];
    Event::moveOrder($id, $direction);
    header("Location: dashboard.php?page=event");
    exit;
}

// Handle POST submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = $_POST['old_image'] ?? '';

    if (!empty($_FILES['image']['tmp_name'])) {
        $uploader = new FileUploader("assets/uploads/event/");
        $uploadResult = $uploader->upload($_FILES["image"]);

        if (!$uploadResult) {
            exit;
        }

        $imagePath = $uploadResult;
    }

    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $timeStart = $_POST['time_start'];
    $timeEnd = $_POST['time_end'];
    $location = $_POST['location'];

    if (isset($_POST['editId'])) {
        $event = new Event($_POST['editId'], $userAdmin, $title, $summary, $description, $imagePath, $timeStart, $timeEnd, $location);
    } else {
        $event = new Event(Event::getNextId(), $userAdmin, $title, $summary, $description, $imagePath, $timeStart, $timeEnd, $location);
    }

    Event::add($event);
    header("Location: dashboard.php?page=event");
    exit;
}

$editEvent = null;
if ($editId) {
    $editEvent = Event::getById($editId);
    $action = 'form';
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Event Manager</h2>
    <a href="?page=event&action=form" class="btn btn-primary mb-3">Create New Event</a>

    <?php if ($action === 'form'): ?>
        <h3><?= $editEvent ? "Edit Event #{$editEvent->id}" : "Create New Event" ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editEvent): ?>
                <input type="hidden" name="editId" value="<?= htmlspecialchars($editEvent->id) ?>">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($editEvent->imgUrl) ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="<?= $editEvent->title ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <?php if ($editEvent): ?>
                    <img src="<?= htmlspecialchars($editEvent->imgUrl) ?>" alt="Current Image" style="max-width: 300px;" class="mt-2" id="image-preview">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="summary">Summary:</label>
                <textarea class="form-control" name="summary" id="summary"><?= $editEvent->summary ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description"><?= $editEvent->description ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="time_start">Start Time:</label>
                <input type="datetime-local" class="form-control" name="time_start" value="<?= isset($editEvent) ? date('Y-m-d\TH:i', strtotime($editEvent->timeStart)) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="time_end">End Time:</label>
                <input type="datetime-local" class="form-control" name="time_end" value="<?= isset($editEvent) ? date('Y-m-d\TH:i', strtotime($editEvent->timeEnd)) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="location">Location:</label>
                <input type="text" class="form-control" name="location" value="<?= $editEvent->location ?? '' ?>">
            </div>
            <button type="submit" class="btn btn-success"><?= $editEvent ? 'Update' : 'Create' ?></button>
            <a href="dashboard.php?page=event" class="btn btn-secondary">Cancel</a>
        </form>

        <script>
            ClassicEditor
                .create(document.querySelector('#description'), {
                    removePlugins: ['ImageUpload', 'EasyImage', 'MediaEmbed'],
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo']
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

    <?php else: ?>
        <?php $events = Event::getListEvent(10); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Time Start</th>
                        <th>Time End</th>
                        <th>Location</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event->id) ?></td>
                        <td><img src="<?= htmlspecialchars($event->imgUrl) ?>" style="width: 160px; height: 90px; object-fit: cover;" class="img-fluid rounded"></td>
                        <td><?= htmlspecialchars($event->username) ?></td>
                        <td><?= htmlspecialchars($event->title) ?></td>
                        <td><?= htmlspecialchars($event->summary) ?></td>
                        <td><?= htmlspecialchars($event->timeStart) ?></td>
                        <td><?= htmlspecialchars($event->timeEnd) ?></td>
                        <td><?= htmlspecialchars($event->location) ?></td>
                        <td class="text-center">
                            <a href="?page=event&move=up&id=<?= urlencode($event->id) ?>" class="btn btn-sm btn-outline-secondary">⬆</a>
                            <a href="?page=event&move=down&id=<?= urlencode($event->id) ?>" class="btn btn-sm btn-outline-secondary">⬇</a>
                            <a href="?page=event&editId=<?= urlencode($event->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="?page=event&deleteId=<?= urlencode($event->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete event #<?= htmlspecialchars($event->id) ?>?')">Delete</a>
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
                preview.className = 'mt-2';
                event.target.parentNode.appendChild(preview);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
