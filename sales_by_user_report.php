<?php
// sales_by_user_report.php
// Displays a report of sales by user (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Sales by User Report</title></head>
<body>
<h2>Sales by User Report</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Reports</a>
</body>
</html>