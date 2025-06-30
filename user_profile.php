<?php
// user_profile.php
// Displays the logged-in user's profile information.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_username, $user_email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head><title>User Profile</title></head>
<body>
<h2>User Profile</h2>
<p>Username: <?php echo htmlspecialchars($user_username); ?></p>
<p>Email: <?php echo htmlspecialchars($user_email); ?></p>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>