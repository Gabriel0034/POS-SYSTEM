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
<head><title>Database Backup</title></head>
<body>
<h2>Database Backup</h2>
<p>Feature not implemented.</p>
<a href="settings.php">Back to Settings</a>
</body>
</html>