<?php
// profit_loss_report.php
// Displays a profit and loss report (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Profit & Loss Report</title></head>
<body>
<h2>Profit & Loss Report</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Reports</a>
</body>
</html>