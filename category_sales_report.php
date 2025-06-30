<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT c.name as category, SUM(si.quantity) as qty_sold, SUM(si.quantity * si.price) as total_sales
        FROM sale_items si
        LEFT JOIN products p ON si.product_id = p.id
        LEFT JOIN categories c ON p.category_id = c.id
        GROUP BY p.category_id
        ORDER BY total_sales DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><title>Category Sales Report</title></head>
<body>
<h2>Category Sales Report</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Category</th>
        <th>Quantity Sold</th>
        <th>Total Sales</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
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