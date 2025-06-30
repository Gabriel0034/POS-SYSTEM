<?php
// delete_product.php
// Displays a page to delete a product (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Product</title></head>
<body>
<h2>Delete Product</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Products</a>
</body>
</html>