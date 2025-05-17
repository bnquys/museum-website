<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");
use Museum\Object\Payment;

// Get the action and id from the URL
$action = $_GET['action'] ?? 'list';
$paidId = $_GET['paidId'] ?? null;
$viewId = $_GET['viewId'] ?? null;

// Handle marking payment as paid
if ($paidId) {
    $payment = Payment::paid($paidId);
    header("Location: dashboard.php?page=payment");  // Redirect after processing
    exit;
}

// Handle view payment details (you can create a detailed view page)
if ($viewId) {
    // Code to handle viewing details (e.g., show detailed payment info)
    // You can create a new page or show modal popup with details
    header("Location: detail.php?page=payment&id=" . $viewId); // Redirect to details page
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Payment Dashboard</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Payment ID</th>
                    <th>Order ID</th>
                    <th>Payment Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $payments = Payment::getAll();  // Fetch all payments
            foreach ($payments as $payment):
            ?>
                <tr>
                    <td><?= htmlspecialchars($payment->id) ?></td>
                    <td><?= htmlspecialchars($payment->ordId) ?></td>
                    <td><?= htmlspecialchars($payment->payDate ?? 'N/A') ?></td>
                    <td>$<?= number_format($payment->totalCost, 2) ?></td>
                    <td>
                        <?php if ($payment->isPaid): ?>
                            <span class="badge bg-success">Paid</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <!-- Button to confirm payment -->
                        <?php if (!$payment->isPaid): ?>
                            <a href="?page=payment&paidId=<?= urlencode($payment->id) ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Are you sure you want to mark this payment as paid?')">Mark as Paid</a>
                        <?php endif; ?>

                        <!-- Button to view payment details -->
                        <a href="?page=payment&viewId=<?= urlencode($payment->id) ?>" class="btn btn-sm btn-outline-info">View Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>