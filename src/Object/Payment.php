<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Payment {
    public const PREFIX = "PAY";
    public const CODE_LENGTH = 5;

    public $id;
    public $ordId;
    public $payDate;
    public $totalCost;
    public $isPaid;

    public function __construct($ordId) {
        $this->id = $this->generateNextId();
        $this->ordId = $ordId;
        $this->payDate = null;
        $this->totalCost = self::calculateFinalAmount($ordId);
        $this->isPaid = false;
    }

    /**
     * Load a Payment object by Payment ID
     *
     * @param string $paymentId
     * @return Payment|null
     */
    public static function fromId(string $paymentId): ?self {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT * FROM Payment WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $paymentId);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();

        if (!$row) return null;

        $payment = new self($row['OrdId']);
        $payment->id = $row['Id'];
        $payment->payDate = $row['PayDate'];
        $payment->totalCost = (float)$row['TotalCost'];
        $payment->isPaid = (bool)$row['IsPaid'];

        return $payment;
    }

    /**
     * Retrieves all payment records from the database.
     *
     * This method queries the Payment table and returns an array of Payment objects.
     * The records are ordered by PayDate in descending order (most recent first).
     *
     * @return Payment[] An array of Payment objects.
     */
    public static function getAll(): array {
        $conn = Database::Connect();

        // SQL query to get all payments ordered by PayDate in descending order
        $sql = "SELECT * FROM Payment ORDER BY IsPaid, PayDate DESC";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        $payments = [];

        // Fetch each record and create Payment object for each row
        while ($row = $result->fetch_assoc()) {
            $payment = new self($row['OrdId']);
            $payment->id = $row['Id'];
            $payment->payDate = $row['PayDate'];
            $payment->totalCost = (float)$row['TotalCost'];
            $payment->isPaid = (bool)$row['IsPaid'];
            $payments[] = $payment;
        }

        $conn->close();
        return $payments;
    }

    /**
     * Insert this payment into the database.
     *
     * @return void
     */
    public function create(): void {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            INSERT INTO Payment (Id, OrdId, PayDate, TotalCost, IsPaid)
            VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $isPaid = $this->isPaid ? 1 : 0;
        $stmt->bind_param("ssdi", $this->id, $this->ordId, $this->totalCost, $isPaid);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }

    private function generateNextId() {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Payment");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $maxId = ($row['maxId'] === null) ? 0 : (int)substr($row['maxId'], strlen(self::PREFIX));
        $nextId = $maxId + 1;
        $newId = self::PREFIX . str_pad($nextId, self::CODE_LENGTH - strlen(self::PREFIX), "0", STR_PAD_LEFT);

        $stmt->close();
        $conn->close();

        return $newId;
    }

    /**
     * Calculate the final amount for an order after applying a valid voucher.
     *
     * @param string $orderId The ID of the order
     * @return float The total amount to be paid (after discount, min 0)
     */
    public static function calculateFinalAmount(string $orderId): float {
        // Step 1: Get total before discount
        $total = Order::calculateTotal($orderId);

        // Step 2: Get voucher ID from Orders table
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT VouId FROM Orders WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();

        $voucherId = $row['VouId'] ?? null;

        // Step 3: Apply discount if voucher is valid
        if ($voucherId) {
            $discount = Voucher::getDiscountValue($voucherId);

            if (Voucher::isPercentDiscount($voucherId)) {
                $total -= ($total * $discount / 100);
            } else {
                $total -= $discount;
            }

            if ($total < 0) {
                $total = 0;
            }
        }

        return round($total, 2);
    }

    /**
     * Marks the payment as "paid" by updating the IsPaid field in the database.
     *
     * This method updates the payment status to "paid" (IsPaid = TRUE) for the given payment ID.
     *
     * @param string $paymentId The ID of the payment to mark as paid.
     * @return bool True if the update was successful, False otherwise.
     */
    public static function paid(string $paymentId): bool {
        $conn = Database::Connect();

        // Prepare SQL statement to update IsPaid field
        $stmt = $conn->prepare("UPDATE Payment SET IsPaid = TRUE WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind the payment ID and execute the query
        $stmt->bind_param("s", $paymentId);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        // Check if any row was updated
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $conn->close();
            return true;  // Payment marked as paid successfully
        } else {
            $stmt->close();
            $conn->close();
            return false;  // No payment record was updated (e.g., invalid ID)
        }
    }

    /**
     * Load a Payment object by Order ID
     *
     * @param string $orderId
     * @return Payment|null
     */
    public static function fromOrderId(string $orderId): ?self {
        $conn = Database::Connect();
        $stmt = $conn->prepare("SELECT * FROM Payment WHERE OrdId = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $orderId);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();

        if (!$row) return null;

        $payment = new self($row['OrdId']);
        $payment->id = $row['Id'];
        $payment->payDate = $row['PayDate'];
        $payment->totalCost = (float)$row['TotalCost'];
        $payment->isPaid = (bool)$row['IsPaid'];

        return $payment;
    }

}
?>
