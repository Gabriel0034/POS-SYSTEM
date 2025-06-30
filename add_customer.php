<?php
// add_customer.php
// Displays a form to add a new customer (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Customer</title></head>
<body>
<h2>Add Customer</h2>
<p>Feature not implemented.</p>
<a href="customer_management.php">Back to Customers</a>
</body>
</html>