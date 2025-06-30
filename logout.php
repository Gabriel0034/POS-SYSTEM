<?php
// logout.php
// Logs out the user by destroying the session and redirecting to login.

session_start();
session_destroy();
header("Location: login.php");
exit();
?>
