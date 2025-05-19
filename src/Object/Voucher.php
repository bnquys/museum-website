<?php
namespace Museum\Object;
use Museum\Utils\Database;

class Voucher {
    /**
     * Check if the voucher uses percent-based discount.
     *
     * @param string $id Voucher ID
     * @return bool True if percent discount > 0, otherwise false
     */
    public static function isPercentDiscount($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("SELECT Percent FROM Voucher WHERE Id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return isset($row['Percent']) && (float)$row['Percent'] > 0;
    }

    /**
     * Get the discount value of a valid voucher (within valid date range).
     *
     * @param string $id Voucher ID
     * @return float Discount value (percent or fixed amount), or 0.0 if expired or not found
     */
    public static function getDiscountValue($id) {
        $conn = Database::Connect();

        $stmt = $conn->prepare("
            SELECT Percent, Price 
            FROM Voucher 
            WHERE Id = ? 
              AND NOW() BETWEEN DateStart AND DateEnd
        ");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        if (!$row) {
            return 0.0;
        }

        return (float)($row['Percent'] > 0 ? $row['Percent'] : $row['Price']);
    }

}
?>
