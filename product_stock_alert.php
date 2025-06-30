<?php
// product_stock_alert.php
// Displays a page for product stock alerts (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Product Stock Alert</title></head>
<body>
<h2>Product Stock Alert</h2>
<p>Feature not implemented.</p>
<a href="products.php">Back to Products</a>
</body>
</html>