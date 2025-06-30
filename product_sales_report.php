<?php
// product_sales_report.php
// Generates and displays a report of sales by product.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT p.name, SUM(si.quantity) as qty_sold, SUM(si.quantity * si.price) as total_sales
        FROM sale_items si
        LEFT JOIN products p ON si.product_id = p.id
        GROUP BY si.product_id
        ORDER BY qty_sold DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><title>Product Sales Report</title></head>
<body>
<h2>Product Sales Report</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Quantity Sold</th>
        <th>Total Sales</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo $row['qty_sold']; ?></td>
            <td><?php echo number_format($row['total_sales'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">No sales data.</td></tr>
    <?php endif; ?>
</table>
<a href="reports.php">Back to Reports</a>
</body>
</html>