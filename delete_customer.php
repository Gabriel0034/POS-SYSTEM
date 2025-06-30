<?php
// delete_customer.php
// Displays a page to delete a customer (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Customer</title></head>
<body>
<h2>Delete Customer</h2>
<p>Feature not implemented.</p>
<a href="customer_management.php">Back to Customers</a>
</body>
</html>