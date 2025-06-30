<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Barcode Generator</title></head>
<body>
<h2>Barcode Generator</h2>
<p>Feature not implemented.</p>
<a href="products.php">Back to Products</a>
</body>
</html>