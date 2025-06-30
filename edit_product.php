<?php
// edit_product.php
// Displays a page to edit a product (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Product</title></head>
<body>
<h2>Edit Product</h2>
<p>Feature not implemented.</p>
<a href="products.php">Back to Products</a>
</body>
</html>