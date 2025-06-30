<?php
// inventory_history.php
// Displays the inventory history page (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Inventory History</title></head>
<body>
<h2>Inventory History</h2>
<p>Feature not implemented.</p>
<a href="inventory.php">Back to Inventory</a>
</body>
</html>