<?php
// stock_out.php
// Displays a page for stock out (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Stock Out</title></head>
<body>
<h2>Stock Out</h2>
<p>Feature not implemented.</p>
<a href="inventory.php">Back to Inventory</a>
</body>
</html>