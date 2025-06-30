<?php
// view_sale.php
// Displays details for a single sale, including items and totals.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sale_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($sale_id <= 0) {
    echo "Invalid sale ID.";
    exit();
}

// Fetch sale info
$stmt = $conn->prepare("SELECT s.*, u.username FROM sales s LEFT JOIN users u ON s.user_id = u.id WHERE s.id=?");
$stmt->bind_param("i", $sale_id);
$stmt->execute();
$sale = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$sale) {
    echo "Sale not found.";
    exit();
}

// Fetch sale items
$stmt = $conn->prepare("SELECT si.*, p.name FROM sale_items si LEFT JOIN products p ON si.product_id = p.id WHERE si.sale_id=?");
$stmt->bind_param("i", $sale_id);
$stmt->execute();
$items = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head><title>View Sale</title></head>
<body>
<h2>Sale Details (ID: <?php echo $sale['id']; ?>)</h2>
<p>Date: <?php echo $sale['sale_date']; ?></p>
<p>User: <?php echo htmlspecialchars($sale['username']); ?></p>
<p>Total: <?php echo number_format($sale['total'], 2); ?></p>
<p>Payment: <?php echo number_format($sale['payment'], 2); ?></p>
<p>Change Due: <?php echo number_format($sale['change_due'], 2); ?></p>
<h3>Items</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>
    <?php while ($item = $items->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($item['name']); ?></td>
        <td><?php echo number_format($item['price'], 2); ?></td>
        <td><?php echo $item['quantity']; ?></td>
        <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<p><a href="sales.php">Back to Sales</a></p>
</body>
</html>