<?php
// process_order.php
// Processes the order at checkout, inserts sale and sale items, updates stock, and clears the cart.

include 'connection.php';
session_start();
include 'cart_functions.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit();
}

$cart = cart_get_items();
if (!$cart) {
    echo "Cart is empty.";
    exit();
}

$payment = floatval($_POST['payment']);
$products = [];
$total = 0.00;

// Fetch product details and calculate total
$ids = implode(',', array_map('intval', array_keys($cart)));
$result = $conn->query("SELECT * FROM products WHERE id IN ($ids) FOR UPDATE");
while ($row = $result->fetch_assoc()) {
    $row['qty'] = $cart[$row['id']];
    $row['subtotal'] = $row['qty'] * $row['price'];
    $products[] = $row;
    $total += $row['subtotal'];
}

if ($payment < $total) {
    echo "Insufficient payment.";
    exit();
}

$user_stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
$user_stmt->bind_param("s", $_SESSION['username']);
$user_stmt->execute();
$user_stmt->bind_result($user_id);
$user_stmt->fetch();
$user_stmt->close();

$conn->begin_transaction();
try {
    // Insert sale
    $sale_stmt = $conn->prepare("INSERT INTO sales (user_id, total, payment, change_due) VALUES (?, ?, ?, ?)");
    $change_due = $payment - $total;
    $sale_stmt->bind_param("iddd", $user_id, $total, $payment, $change_due);
    $sale_stmt->execute();
    $sale_id = $sale_stmt->insert_id;
    $sale_stmt->close();

    // Insert sale items and update stock
    $item_stmt = $conn->prepare("INSERT INTO sale_items (sale_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stock_stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($products as $prod) {
        $item_stmt->bind_param("iiid", $sale_id, $prod['id'], $prod['qty'], $prod['price']);
        $item_stmt->execute();
        $stock_stmt->bind_param("ii", $prod['qty'], $prod['id']);
        $stock_stmt->execute();
    }
    $item_stmt->close();
    $stock_stmt->close();

    $conn->commit();
    cart_clear();
    echo "<h2>Order Complete</h2>";
    echo "<p>Sale ID: $sale_id</p>";
    echo "<p>Total: " . number_format($total, 2) . "</p>";
    echo "<p>Payment: " . number_format($payment, 2) . "</p>";
    echo "<p>Change Due: " . number_format($change_due, 2) . "</p>";
    echo '<a href="sales.php">View Sales</a> | <a href="products.php">New Sale</a>';
} catch (Exception $e) {
    $conn->rollback();
    echo "Order failed: " . $e->getMessage();
}
?>
