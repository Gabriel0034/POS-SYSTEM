<?php
// stock_in.php
// Displays a page for stock in (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Stock In</title></head>
<body>
<h2>Stock In</h2>
<p>Feature not implemented.</p>
<a href="inventory.php">Back to Inventory</a>
</body>
</html>