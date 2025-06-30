<?php
// pos.php
// Displays the main POS interface (feature not implemented).

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>POS</title></head>
<body>
<h2>Point of Sale</h2>
<p>Feature not implemented.</p>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>