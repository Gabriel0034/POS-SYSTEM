<?php
// product_categories.php
// Displays a page to manage product categories (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Product Categories</title></head>
<body>
<h2>Product Categories</h2>
<p>Feature not implemented.</p>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>