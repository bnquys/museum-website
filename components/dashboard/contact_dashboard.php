<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");

use Museum\Object\ContactForm;
use Museum\Utils\Mailer;

$action = $_GET['action'] ?? 'list';
$replyId = $_GET['replyId'] ?? null;
$unseenId = $_GET['unseenId'] ?? null;
$seenId = $_GET['seenId'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $toEmail = $_POST['email'];
    $toName = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailer = new Mailer($toEmail, $toName);
    $mailer->setSubject($subject);
    $mailer->setBody($message);

    $result = $mailer->send();

    if ($result === true) {
        header("Location: dashboard.php?page=contact&success=1");
    } else {
        echo "<div class='alert alert-danger'>Error sending mail: $result</div>";
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['success'] ?? false) {
        echo '<div class="alert alert-success">Reply sent successfully!</div>';
    }
}

$contact = null;
if ($replyId) {
    $contact = ContactForm::getById($replyId);
    ContactForm::markAsSeen($replyId);
    $action = 'reply';
}

if ($unseenId) {
    ContactForm::makeAsUnseen($unseenId);
    header("Location: dashboard.php?page=contact");
    exit;
}

if ($seenId) {
    ContactForm::markAsSeen($seenId);
    header("Location: dashboard.php?page=contact");
    exit;
}

?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Contact Manager</h2>

    <?php if ($action === 'reply' && $contact): ?>
        <h3>Reply to <?= htmlspecialchars($contact->name) ?> (<?= $contact->email ?>)</h3>
        <form method="POST">
            <input type="hidden" name="email" value="<?= htmlspecialchars($contact->email) ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($contact->name) ?>">

            <div class="mb-3">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" name="subject" required>
            </div>

            <div class="mb-3">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" rows="20" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Send Reply</button>
            <a href="dashboard.php?page=contact" class="btn btn-secondary">Cancel</a>
        </form>
        <script>
            ClassicEditor
                .create(document.querySelector('textarea[name="message"]'), {
                    toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'link']
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

    <?php else: ?>
        <?php $messages = ContactForm::getListContactForms(20); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Seen</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td><?= htmlspecialchars($msg->id) ?></td>
                        <td><?= htmlspecialchars($msg->email) ?></td>
                        <td><?= htmlspecialchars($msg->name) ?></td>
                        <td><?= htmlspecialchars($msg->message) ?></td>
                        <td><?= htmlspecialchars($msg->createdAt) ?></td>
                        <td><?= $msg->isSeen ? '✔' : '✘' ?></td>
                        <td>
                            <a href="?page=contact&replyId=<?= urlencode($msg->id) ?>" class="btn btn-sm btn-outline-primary">Rep Tin</a>
                            <?php if ($msg->isSeen): ?>
                                <a href="?page=contact&unseenId=<?= urlencode($msg->id) ?>" class="btn btn-sm btn-outline-warning">Unseen</a>
                            <?php else: ?>
                                <a href="?page=contact&seenId=<?= urlencode($msg->id) ?>" class="btn btn-sm btn-outline-success">Seen</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
