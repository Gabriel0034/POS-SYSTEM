<?php
// yearly_sales_report.php
// Generates and displays a report of all sales for the current year.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$year = date('Y');
$stmt = $conn->prepare("SELECT s.id, s.sale_date, u.username, s.total FROM sales s LEFT JOIN users u ON s.user_id = u.id WHERE YEAR(s.sale_date)=?");
$stmt->bind_param("i", $year);
$stmt->execute();
$result = $stmt->get_result();
$total_sales = 0;
?>
<!DOCTYPE html>
<html>
<head><title>Yearly Sales Report</title></head>
<body>
<h2>Yearly Sales Report (<?php echo $year; ?>)</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Sale ID</th>
        <th>Date/Time</th>
        <th>User</th>
        <th>Total</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): $total_sales += $row['total']; ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['sale_date']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo number_format($row['total'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="3" align="right"><strong>Total Sales:</strong></td>
            <td><strong><?php echo number_format($total_sales, 2); ?></strong></td>
        </tr>
    <?php else: ?>
        <tr><td colspan="4">No sales for this year.</td></tr>
    <?php endif; ?>
</table>
<a href="reports.php">Back to Reports</a>
</body>
</html>