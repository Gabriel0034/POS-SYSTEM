<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Audit Log</title></head>
<body>
<h2>Audit Log</h2>
<p>Feature not implemented.</p>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>