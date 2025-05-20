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
    
    /**
     * Create an Order object (and linked Payment object) from a given Order ID.
     *
     * @param string $orderId
     * @return Order|null
     */
    public static function fromId(string $orderId): ?Order {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            SELECT Id, VouId, PayId, Username, VisitDate, CreatedDate
            FROM Orders
            WHERE Id = ?
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

        if (!$row) return null;

        // Khởi tạo đối tượng Order
        $order = new self($row['Username'], [], explode(' ', $row['VisitDate'])[0], explode(' ', $row['VisitDate'])[1] ?? "00:00:00");
        $order->id = $row['Id'];
        $order->vouId = $row['VouId'];
        $order->payId = $row['PayId'];
        $order->createdDate = $row['CreatedDate'];
        $order->visitDate = $row['VisitDate'];
        return $order;
    }

    /**
     * Get list of Ticket objects for this Order.
     *
     * @param string $orderId
     * @return Ticket[]
     */
    public function getTickets(): array {
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            SELECT t.Id, t.Name, t.Price, t.Description, t.IsShow, t.DisplayOrder
            FROM Contain c
            JOIN Ticket t ON c.TicId = t.Id
            WHERE c.Id = ?
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        $tickets = [];
        while ($row = $result->fetch_assoc()) {
            $tickets[] = new Ticket(
                $row["Id"],
                $row["Name"],
                $row["Price"],
                $row["Description"],
                $row["IsShow"],
                $row["DisplayOrder"]
            );
        }

        $stmt->close();
        $conn->close();

        return $tickets;
    }

    /**
     * Get the Guide object assigned to this Order.
     *
     * @param string $orderId
     * @return Guide|null
     */
    public static function getGuide(string $orderId): ?Guide {
        $conn = Database::Connect();
        $stmt = $conn->prepare("
            SELECT DISTINCT Email
            FROM Contain
            WHERE Id = ? AND Email IS NOT NULL
            LIMIT 1
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        if (!$row || !$row['Email']) return null;

        return Guide::fromEmail($row['Email']);
    }

    /**
     * Get quantity of a specific ticket in this order.
     *
     * @param string $ticketId The ID of the ticket to look up.
     * @return int The quantity of that ticket in this order (0 if not found).
     */
    public function getTicketQuantity(string $ticketId): int {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Quantity FROM Contain WHERE Id = ? AND TicId = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $this->id, $ticketId);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $row ? (int)$row['Quantity'] : 0;
    }
}
?>
