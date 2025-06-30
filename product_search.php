<?php
// product_search.php
// Displays a page to search for products (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Product Search</title></head>
<body>
<h2>Product Search</h2>
<p>Feature not implemented.</p>
<a href="products.php">Back to Products</a>
</body>
</html>