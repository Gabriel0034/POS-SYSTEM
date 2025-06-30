<?php
// supplier_management.php
// Displays the supplier management page (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Supplier Management</title></head>
<body>
<h2>Supplier Management</h2>
<p>Feature not implemented.</p>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>