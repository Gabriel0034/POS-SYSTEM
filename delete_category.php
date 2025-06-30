<?php
// delete_category.php
// Displays a page to delete a product category (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Category</title></head>
<body>
<h2>Delete Category</h2>
<p>Feature not implemented.</p>
<a href="product_categories.php">Back to Categories</a>
</body>
</html>