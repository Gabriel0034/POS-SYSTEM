<?php
// change_password.php
// Allows the logged-in user to change their password after verifying the current password.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];

    // Fetch user from users table
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    if ($stmt->fetch() && password_verify($current, $hashed_password)) {
        $stmt->close();
        $new_hashed = password_hash($new, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
        $update_stmt->bind_param("ss", $new_hashed, $username);
        $update_stmt->execute();
        $msg = "Password changed successfully.";
        $update_stmt->close();
    } else {
        $msg = "Current password incorrect.";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Change Password</title></head>
<body>
<h2>Change Password</h2>
<?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
<form method="post">
    Current Password: <input type="password" name="current_password" required><br>
    New Password: <input type="password" name="new_password" required><br>
    <button type="submit">Change Password</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>