<?php
// edit_customer.php
// Allows editing of customer details and updates the database.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if customer ID is provided
if (!isset($_GET['id'])) {
    echo "No customer ID specified.";
    exit();
}

$customer_id = intval($_GET['id']);
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Use prepared statement for update
    $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $customer_id);
    if ($stmt->execute()) {
        $message = "Customer updated successfully.";
    } else {
        $message = "Error updating customer: " . $conn->error;
    }
    $stmt->close();
}

// Fetch customer data
$stmt = $conn->prepare("SELECT * FROM customers WHERE id=?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result || $result->num_rows == 0) {
    echo "Customer not found.";
    exit();
}
$customer = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head><title>Edit Customer</title></head>
<body>
<h2>Edit Customer</h2>
<?php if ($message) echo "<p>$message</p>"; ?>
<form method="post">
    <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required></label><br>
    <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required></label><br>
    <label>Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required></label><br>
    <input type="submit" value="Update Customer">
</form>
<a href="customer_management.php?id=<?php echo $customer_id; ?>">Back to Customers</a>
</body>
</html>