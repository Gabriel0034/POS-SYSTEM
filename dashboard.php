<?php
// dashboard.php
// Displays the main dashboard for logged-in users, including navigation and user info.

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<a href="user_profile.php">Profile</a> | 
<a href="change_password.php">Change Password</a> | 
<a href="logout.php">Logout</a>

<h3>Your Dashboard</h3>
<p>This is your dashboard where you can manage your account settings and view your profile.</p>
<?php include 'footer.php'; ?>
</body>
</html>