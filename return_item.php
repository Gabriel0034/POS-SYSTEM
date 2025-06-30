<?php
// return_item.php
// Displays a page to return an item (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Return Item</title></head>
<body>
<h2>Return Item</h2>
<p>Feature not implemented.</p>
<a href="javascript:history.back()">Back to Sales History</a>
</body>
</html>