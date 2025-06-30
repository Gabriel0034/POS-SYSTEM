<?php
// new_sale.php
// Displays a page to create a new sale (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>New Sale</title></head>
<body>
<h2>New Sale</h2>
<p>Feature not implemented.</p>
<a href="sales.php">Back to Sales</a>
</body>
</html>