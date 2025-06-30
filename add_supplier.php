<?php
// add_supplier.php
// Displays a form to add a new supplier (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Supplier</title></head>
<body>
<h2>Add Supplier</h2>
<p>Feature not implemented.</p>
<a href="supplier_management.php">Back to Suppliers</a>
</body>
</html>