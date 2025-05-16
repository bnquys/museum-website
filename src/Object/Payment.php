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

}
?>
