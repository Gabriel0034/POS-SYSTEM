<?php
// add_product.php
// Displays a form to add a new product, handles form submission, validates input,
// inserts the product into the database, loads available categories for selection,
// and applies global and form-specific CSS styles.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

// Fetch categories for dropdown
$categories = [];
$cat_stmt = $conn->prepare("SELECT id, name FROM categories ORDER BY name ASC");
$cat_stmt->execute();
$cat_result = $cat_stmt->get_result();
while ($row = $cat_result->fetch_assoc()) {
    $categories[] = $row;
}
$cat_stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $category_id = intval($_POST['category_id']);
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);

    // Basic validation
    if ($name === "" || $category_id <= 0 || !is_numeric($price) || !is_numeric($stock)) {
        $msg = "<span style='color:red;'>All fields are required and must be valid.</span>";
    } else {
        $stmt = $conn->prepare("INSERT INTO products (name, category_id, price, stock) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sidi", $name, $category_id, $price, $stock);
        if ($stmt->execute()) {
            $msg = "<span style='color:green;'>Product added successfully!</span>";
        } else {
            $msg = "<span style='color:red;'>Error adding product.</span>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   
</head>
<body>
<h2>Add Product</h2>
<?php if ($msg) echo "<p>$msg</p>"; ?>
<form method="post">
    <label>Product Name: <input type="text" name="name" required></label><br>
    <label>Category:
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <a href="add_category.php" style="margin-left:10px;">Add Category</a>
    </label><br>
    <label>Price: <input type="number" name="price" step="0.01" min="0" required></label><br>
    <label>Stock: <input type="number" name="stock" min="0" required></label><br>
    <button type="submit">Add Product</button>
</form>
<a href="products.php">Back to Products</a>
</body>
</html>