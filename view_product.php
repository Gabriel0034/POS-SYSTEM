<?php
// view_product.php
// Displays details for a single product (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>View Product</title></head>
<body>
<h2>View Product</h2>
<p>Feature not implemented.</p>
<a href="products.php">Back to Products</a>
</body>
</html>