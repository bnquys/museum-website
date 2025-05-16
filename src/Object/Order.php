<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Order {
    public const PREFIX = "ORD";
    public const CODE_LENGTH = "5";

    public $id;
    public $vouId;
    public $payId;
    public $username;
    public $createdDate;

    public $ticketList;
    public $visitDate;
    public $guideEmail;

    public function __construct(string $username, array $ticketList, string $visitDate, string $visitTime, ?string $guideEmail = null) {
        $this->id = $this->generateNextId();
        $this->username = $username;
        $this->vouId = null;
        $this->payId = null;
        $this->createdDate = null;

        $this->ticketList = array_filter($ticketList, function ($quantity) {return $quantity > 0;});
        $this->visitDate = $visitDate . ' ' . $visitTime;
        
        $this->visitDate = $visitDate;
        $this->guideEmail = $guideEmail;
    }

    private function generateNextId() {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT MAX(Id) AS maxId FROM Orders");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $maxId = ($row['maxId'] == NULL) ? 0 : (int)substr($row['maxId'], strlen(self::PREFIX));
        $nextId = $maxId + 1;
        $idFormatted = self::PREFIX . str_pad($nextId, self::CODE_LENGTH - strlen(self::PREFIX), "0", STR_PAD_LEFT);

        $stmt->close();
        $conn->close();

        return $idFormatted;
    }

    /**
     * Calculate the total cost of a given order (excluding voucher).
     *
     * @param string $orderId The ID of the order to calculate
     * @return float Total amount of the order.
     */
    public static function calculateTotal(string $orderId): float {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            SELECT SUM(t.Price * c.Quantity) AS Total
            FROM Contain c
            JOIN Ticket t ON c.TicId = t.Id
            WHERE c.Id = ?
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $orderId);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return isset($row['Total']) ? (float)$row['Total'] : 0.0;
    }

    /**
     * Assign a voucher to the order by ID.
     *
     * @param string $voucherId The ID of the voucher to apply.
     * @return void
     */
    public function setVoucher($voucherId) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("UPDATE Orders SET VouId = ? WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $voucherId, $this->id);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        $this->vouId = $voucherId;
    }

    /**
     * Link a payment to this order.
     *
     * @param string $paymentId The ID of the associated payment.
     * @return void
     */
    public function setPayment($paymentId) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("UPDATE Orders SET PayId = ? WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $paymentId, $this->id);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        $this->payId = $paymentId;
    }

    public function create(): void {
        // Step 1: Insert the order into the Orders table (bao gồm VisitDate)
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            INSERT INTO Orders (Id, VouId, PayId, Username, CreatedDate, VisitDate)
            VALUES (?, ?, NULL, ?, CURRENT_TIMESTAMP, ?)
        ");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssss", $this->id, $this->vouId, $this->username, $this->visitDate);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();
    
        // Step 2: Insert ticket info into Contain table (không có VisitDate nữa)
        foreach ($this->ticketList as $ticId => $quantity) {
            $stmt = $conn->prepare("
                INSERT INTO Contain (TicId, Id, Email, Quantity)
                VALUES (?, ?, NULL, ?)
            ");
            if (!$stmt) {
                die("Prepare failed (Contain insert): " . $conn->error);
            }
            $stmt->bind_param("ssi", $ticId, $this->id, $quantity);
            if (!$stmt->execute()) {
                die("Execute failed (Contain insert): " . $stmt->error);
            }
            $stmt->close();
        }
    
        // Step 3: If guideEmail is provided, update Contain rows
        if ($this->guideEmail !== null) {
            foreach (array_keys($this->ticketList) as $ticId) {
                $stmt = $conn->prepare("
                    UPDATE Contain SET Email = ? WHERE TicId = ? AND Id = ?
                ");
                if (!$stmt) {
                    die("Prepare failed (Contain update): " . $conn->error);
                }
                $stmt->bind_param("sss", $this->guideEmail, $ticId, $this->id);
                if (!$stmt->execute()) {
                    die("Execute failed (Contain update): " . $stmt->error);
                }
                $stmt->close();
            }
        }
    
        // Step 4: Create and insert payment
        $payment = new Payment($this->id);
        $payment->create();
    
        // Step 5: Link the payment to this order
        $this->setPayment($payment->id);
    
        $conn->close();
    }
    
}
?>
