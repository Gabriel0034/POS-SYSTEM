<?php
// sales.php
// Displays a list of sales and provides actions to view each sale.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT s.id, s.sale_date, s.total, s.payment, s.change_due, u.username
        FROM sales s
        LEFT JOIN users u ON s.user_id = u.id
        ORDER BY s.sale_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><title>Sales</title></head>
<body>
<h2>Sales</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Sale ID</th>
        <th>Date</th>
        <th>User</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Change</th>
        <th>Actions</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['sale_date']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo number_format($row['total'], 2); ?></td>
            <td><?php echo number_format($row['payment'], 2); ?></td>
            <td><?php echo number_format($row['change_due'], 2); ?></td>
            <td>
                <a href="view_sale.php?id=<?php echo $row['id']; ?>">View</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="7">No sales found.</td></tr>
    <?php endif; ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>