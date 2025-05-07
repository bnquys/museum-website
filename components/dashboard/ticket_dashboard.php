<?php
require_once realpath(__DIR__ . "/../../vendor/autoload.php");
use Museum\Object\Ticket;

$action = $_GET['action'] ?? 'list';
$editId = $_GET['editId'] ?? null;
$deleteId = $_GET['deleteId'] ?? null;

if ($deleteId) {
    Ticket::delete($deleteId);
    header("Location: dashboard.php?page=ticket");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['editId'] ?? Ticket::getNextId();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $isShow = isset($_POST['isShow']) ? 1 : 0;

    $ticket = new Ticket($id, null, $name, null, $price, $isShow);
    Ticket::add($ticket);

    header("Location: dashboard.php?page=ticket");
    exit;
}

$editTicket = null;
if ($editId) {
    $editTicket = Ticket::getById($editId);
    $action = 'form';
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Ticket Manager</h2>
    <a href="?page=ticket&action=form" class="btn btn-primary mb-3">Create New Ticket</a>

    <?php if ($action === 'form'): ?>
        <h3><?= $editTicket ? "Edit Ticket #{$editTicket->id}" : "Create New Ticket" ?></h3>
        <form method="POST">
            <?php if ($editTicket): ?>
                <input type="hidden" name="editId" value="<?= htmlspecialchars($editTicket->id) ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="name">Ticket Name:</label>
                <input type="text" class="form-control" name="name" required value="<?= $editTicket->name ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control" name="price" required value="<?= $editTicket->price ?? '0' ?>">
            </div>
            <?php if ($editTicket): ?>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="isShow" id="isShow" <?= $editTicket->isShow ? 'checked' : '' ?>>
                <label class="form-check-label" for="isShow">Hiển thị (IsShow)</label>
            </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success"><?= $editTicket ? 'Update' : 'Create' ?></button>
            <a href="dashboard.php?page=ticket" class="btn btn-secondary">Cancel</a>
        </form>
    <?php else: ?>
        <?php $result = Ticket::getListTicket(10); ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Is Show</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket->id) ?></td>
                        <td><?= htmlspecialchars($ticket->name) ?></td>
                        <td><?= htmlspecialchars($ticket->price) ?></td>
                        <td><?= $ticket->isShow ? 'Yes' : 'No' ?></td>
                        <td class="text-center">
                            <a href="?page=ticket&editId=<?= urlencode($ticket->id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="?page=ticket&deleteId=<?= urlencode($ticket->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete ticket #<?= htmlspecialchars($ticket->id) ?>?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
