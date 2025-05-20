<?php
require_once realpath(__DIR__."/../../vendor/autoload.php");

use Museum\Object\Order;
use Museum\Object\Payment;
use Museum\Object\Ticket;
use Museum\Utils\Mailer;

// Get the action and id from the URL
$action = $_GET['action'] ?? 'list';
$paidId = $_GET['paidId'] ?? null;
$viewId = $_GET['viewId'] ?? null;

// Handle marking payment as paid
if ($paidId) {
    $payment = Payment::paid($paidId);

        $data = [
        'name' => 'John Doe',
        'id' => 'ABC123456'
    ];

    Mailer::sendRenderedMailFromFile(
        '2uy.9dragons@gmail.com',
        'John Doe',
        'Ticket Confirmation',
        __DIR__ . '/booking_email.html',
        $data
    );

    header("Location: dashboard.php?page=payment");  // Redirect after processing
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Payment Dashboard</h2>
    <?php if (!$viewId):?>
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
                        <a href="?page=payment&viewId=<?= urlencode($payment->ordId) ?>" class="btn btn-sm btn-outline-info">View Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <h2 class="mb-4">Order Details</h2>

        <?php 
        $order = Order::fromId($viewId);
        $payment = Payment::fromOrderId($viewId);
        ?>

        <!-- Order Info -->
        <div class="mb-5">
            <h4>Order Information</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Order ID:</strong> <?= $order->id?>
                </li>
                <li class="list-group-item">
                    <strong>Customer Username:</strong> <?= $order->username?>
                </li>
                <li class="list-group-item">
                    <strong>Visit Date:</strong> <?= $order->visitDate?>
                </li>
                <li class="list-group-item">
                    <strong>Order Created:</strong> <?= $order->createdDate?>
                </li>
                <li class="list-group-item">
                    <strong>Voucher Applied:</strong> <?= $order->vouId ?? 'None'?>
                </li>
            </ul>
        </div>

        <!-- Payment Info -->
        <div class="mb-5">
            <h4>Payment Information</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Payment ID:</strong> <?= $payment->id?>
                </li>
                <li class="list-group-item">
                    <strong>Payment Date:</strong> <?= $payment->payDate?>
                </li>
                <li class="list-group-item">
                    <strong>Total Cost: </strong>$<?= number_format($payment->totalCost, 2)?>
                </li>
                <li class="list-group-item">
                    <strong>Status:</strong>
                    <span class="badge bg-success"><?= ($payment->isPaid)? 'Pending' : 'Paid'?></span>
                </li>
            </ul>
        </div>

        <!-- Ticket List -->
        <div>
            <h4>Tickets</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $tickets = $order->getTickets();
                        foreach($tickets as $ticket):
                    ?>
                    <tr>
                        <td><?= $ticket->id?></td>
                        <td><?= $ticket->name?></td>
                        <td><?= $ticket->description?></td>
                        <td>$<?= number_format($ticket->price, 2) ?></td>
                        <td><?= $order->getTicketQuantity($ticket->id)?></td>
                        <td>$<?= number_format($order->getTicketQuantity($ticket->id) * $ticket->price, 2)?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <a href="dashboard.php?page=payment" class="btn btn-success">Back</a>
    <?php endif;?>
</div>