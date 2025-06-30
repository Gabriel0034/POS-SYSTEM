<?php
// inventory_value_report.php
// Displays a report of inventory value (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Inventory Value Report</title></head>
<body>
<h2>Inventory Value Report</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Reports</a>
</body>
</html>