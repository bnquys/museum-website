<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");
use Museum\Object\Account;
use Museum\Object\AccountRole;

$action = $_GET['action'] ?? 'list';
$username = $_GET['username'] ?? null;

// Xử lý cập nhật phân quyền
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['updateRole'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $account = Account::getByUsername($username);
    if ($account) {
        $account->setRole($role); // Truyền role dạng string
    }

    header("Location: dashboard.php?page=account");
    exit;
}

// Xử lý khoá/mở tài khoản
if (isset($_GET['toggleActive']) && $_GET['toggleActive']) {
    $username = $_GET['toggleActive'];
    $account = Account::getByUsername($username);
    if ($account) {
        $account->toggleActive();
    }
    header("Location: dashboard.php?page=account");
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Account Manager</h2>

    <?php
    $accounts = Account::getAll();
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $acc): ?>
                    <tr>
                        <td><?= htmlspecialchars($acc->username) ?></td>
                        <td><?= htmlspecialchars($acc->email) ?></td>
                        <td>
                            <form method="POST" class="d-flex gap-2">
                                <input type="hidden" name="username" value="<?= htmlspecialchars($acc->username) ?>">
                                <select name="role" class="form-select form-select-sm" required>
                                    <?php foreach (AccountRole::all() as $role): ?>
                                        <option value="<?= $role ?>" <?= ($acc->roleId === $role) ? 'selected' : '' ?>>
                                            <?= ucfirst($role) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" name="updateRole" class="btn btn-sm btn-success">Save</button>
                            </form>
                        </td>
                        <td>
                            <?= $acc->isActive ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' ?>
                        </td>
                        <td class="text-center">
                            <a href="?page=account&toggleActive=<?= urlencode($acc->username) ?>" class="btn btn-sm btn-outline-<?= $acc->isActive ? 'danger' : 'success' ?>">
                                <?= $acc->isActive ? 'Lock' : 'Unlock' ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
