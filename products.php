<?php
// products.php
// Displays the list of products, allows searching/filtering, and provides actions for each product.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'header.php';
include 'sidebar.php';

// Handle search/filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Fetch categories for filter dropdown
$cat_stmt = $conn->prepare("SELECT id, name FROM categories ORDER BY name ASC");
$cat_stmt->execute();
$cat_result = $cat_stmt->get_result();
$categories = [];
while ($row = $cat_result->fetch_assoc()) {
    $categories[] = $row;
}
$cat_stmt->close();

// Build query for products
$query = "SELECT p.id, p.name, c.name AS category, p.price, p.stock 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          WHERE 1";
$params = [];
$types = "";

if ($search !== '') {
    $query .= " AND p.name LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}
if ($category !== '' && $category !== 'all') {
    $query .= " AND p.category_id = ?";
    $params[] = $category;
    $types .= "i";
}
$query .= " ORDER BY p.name ASC";

$stmt = $conn->prepare($query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2>Products</h2>
<form method="get" style="margin-bottom:10px;">
    <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
    <select name="category">
        <option value="all">All Categories</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>" <?php if ($category == $cat['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($cat['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Search</button>
    <a href="products.php">Reset</a>
</form>
<a href="add_product.php" style="display:inline-block;margin-bottom:10px;">Add Product</a>
<a href="add_category.php" style="display:inline-block;margin-left:10px;">Add Category</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars(number_format($row['price'], 2)); ?></td>
            <td><?php echo htmlspecialchars($row['stock']); ?></td>
            <td>
                <a href="view_product.php?id=<?php echo $row['id']; ?>">View</a> |
                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this product?');">Delete</a>
                <?php if ($row['stock'] > 0): ?>
                    <form action="add_to_cart.php" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="number" name="qty" value="1" min="1" max="<?php echo $row['stock']; ?>" style="width:50px;">
                        <button type="submit">Add to Cart</button>
                    </form>
                <?php else: ?>
                    <span style="color:red;">Out of Stock</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No products found.</td></tr>
    <?php endif; ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>
<?php include 'footer.php'; ?>
</body>
</html>
<?php
$stmt->close();
?>