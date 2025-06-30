<?php
// delete_sale.php
// Displays a page to delete a sale (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Sale</title></head>
<body>
<h2>Delete Sale</h2>
<p>Feature not implemented.</p>
<a href="sales_history.php">Back to Sales History</a>
</body>
</html>