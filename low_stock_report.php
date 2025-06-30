<?php
// low_stock_report.php
// Displays a report of products with low stock (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Low Stock Report</title></head>
<body>
<h2>Low Stock Report</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Reports</a>
</body>
</html>