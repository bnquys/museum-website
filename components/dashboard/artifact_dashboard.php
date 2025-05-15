<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");
use Museum\Object\Artifact;
use Museum\Utils\FileUploader;
use Museum\Utils\UrlHelper;

$action = $_GET['action'] ?? 'list';
$editId = $_GET['editId'] ?? null;
$deleteId = $_GET['deleteId'] ?? null;

if ($deleteId) {
    Artifact::delete($deleteId);
    header("Location: dashboard.php?page=artifact");
    exit;
}

if (isset($_GET['move']) && isset($_GET['id'])) {
    Artifact::moveOrder($_GET['id'], $_GET['move']);
    header("Location: dashboard.php?page=artifact");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['editId'] ?? Artifact::getNextId();
    $title = $_POST['title'];
    $description = $_POST['description'];
    $history = $_POST['history'];
    $isShow = isset($_POST['isShow']) ? 1 : 0;

    $imgPath = $_POST['old_image'] ?? '';
    if (!empty($_FILES['image']['tmp_name'])) {
        $uploader = new FileUploader("assets/uploads/artifact/");
        $result = $uploader->upload($_FILES["image"]);
        if ($result) $imgPath = $result;
    }

    $item = new Artifact($id, $title, $description, $history, $imgPath, $isShow);
    Artifact::add($item);
    header("Location: dashboard.php?page=artifact");
    exit;
}

$editItem = null;
if ($editId) {
    $editItem = Artifact::getById($editId);
    $action = 'form';
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Artifact Manager</h2>
    <a href="?page=artifact&action=form" class="btn btn-primary mb-3">Create New Artifact</a>

    <?php if ($action === 'form'): ?>
        <h3><?= $editItem ? "Edit #{$editItem->id}" : "Create New Artifact" ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editItem): ?>
                <input type="hidden" name="editId" value="<?= htmlspecialchars($editItem->id) ?>">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($editItem->imageUrl) ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" required value="<?= $editItem->title ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="image">Thumbnail:</label>
                <input type="file" class="form-control" name="image" accept="image/*">
                <?php if ($editItem): ?>
                    <img src="<?= htmlspecialchars($editItem->imageUrl) ?>" style="max-width:300px;" class="mt-2">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"><?= $editItem->description ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="history">History:</label>
                <textarea class="form-control" id="history" name="history"><?= $editItem->history ?? '' ?></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="isShow" <?= (!$editItem || $editItem->isShow) ? 'checked' : '' ?>>
                <label class="form-check-label">Is Show</label>
            </div>
            <button type="submit" class="btn btn-success"><?= $editItem ? 'Update' : 'Create' ?></button>
            <a href="dashboard.php?page=artifact" class="btn btn-secondary">Cancel</a>
        </form>

        <script>
            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: '<?= UrlHelper::browserpath("components/dashboard/artifact_fileupload.php") ?>'
                    }
                })
                .catch(console.error);

            ClassicEditor
                .create(document.querySelector('#history'), {
                    ckfinder: {
                        uploadUrl: '<?= UrlHelper::browserpath("components/dashboard/artifact_fileupload.php") ?>'
                    }
                })
                .catch(console.error);
        </script>
    <?php else: ?>
        <?php $items = Artifact::getList(); ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Order</th>
                        <th>Show</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item->id) ?></td>
                            <td><?= htmlspecialchars($item->title) ?></td>
                            <td><img src="<?= htmlspecialchars($item->imageUrl) ?>" style="width:100px"></td>
                            <td class="text-center">
                                <a href="?page=artifact&move=up&id=<?= urlencode($item->id) ?>" class="btn btn-sm btn-outline-secondary">⬆</a>
                                <a href="?page=artifact&move=down&id=<?= urlencode($item->id) ?>" class="btn btn-sm btn-outline-secondary">⬇</a>
                            </td>
                            <td><?= $item->isShow ? 'Yes' : 'No' ?></td>
                            <td class="text-center">
                                <a href="?page=artifact&editId=<?= urlencode($item->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="?page=artifact&deleteId=<?= urlencode($item->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete artifact #<?= htmlspecialchars($item->id) ?>?')">Delete</a>
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
