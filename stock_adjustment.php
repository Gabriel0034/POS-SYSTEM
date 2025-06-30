<?php
// stock_adjustment.php
// Displays a page for stock adjustment (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Stock Adjustment</title></head>
<body>
<h2>Stock Adjustment</h2>
<p>Feature not implemented.</p>
<a href="inventory.php">Back to Inventory</a>
</body>
</html>