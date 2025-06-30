<?php
// delete_supplier.php
// Displays a page to delete a supplier (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Supplier</title></head>
<body>
<h2>Delete Supplier</h2>
<p>Feature not implemented.</p>
<a href="supplier_management.php">Back to Suppliers</a>
</body>
</html>