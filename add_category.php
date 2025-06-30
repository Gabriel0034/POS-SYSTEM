<?php
// add_category.php
// Provides a form to add a new product category and handles the insertion into the database.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = trim($_POST['category']);
    if (!empty($category)) {
        // Use prepared statement
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $category);
        if ($stmt->execute()) {
            $msg = "Category added!";
        } else {
            $msg = "Error adding category.";
        }
        $stmt->close();
    } else {
        $msg = "Category name required.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Category</title></head>
<body>
<h2>Add Category</h2>
<?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
<form method="post">
    Category Name: <input name="category" required><br>
    <button type="submit">Add</button>
</form>
<a href="products.php">Back to Products</a>
</body>
</html>