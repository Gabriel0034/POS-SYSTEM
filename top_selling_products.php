<?php
// top_selling_products.php
// Displays a report of top selling products (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Top Selling Products</title></head>
<body>
<h2>Top Selling Products</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Reports</a>
</body>
</html>