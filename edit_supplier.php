<?php
// edit_supplier.php
// Displays a page to edit a supplier (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Supplier</title></head>
<body>
<h2>Edit Supplier</h2>
<p>Feature not implemented.</p>
<a href="supplier_management.php">Back to Suppliers</a>
</body>
</html>