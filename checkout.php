<?php
// checkout.php
// Displays the checkout page, shows cart items, calculates total, and collects payment amount.

include 'connection.php';
session_start();
include 'cart_functions.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$cart = cart_get_items();
$products = [];
$total = 0.00;

if ($cart) {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $row['qty'] = $cart[$row['id']];
        $row['subtotal'] = $row['qty'] * $row['price'];
        $products[] = $row;
        $total += $row['subtotal'];
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Checkout</title></head>
<body>
<h2>Checkout</h2>
<?php if ($products): ?>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>
    <?php foreach ($products as $prod): ?>
    <tr>
        <td><?php echo htmlspecialchars($prod['name']); ?></td>
        <td><?php echo number_format($prod['price'], 2); ?></td>
        <td><?php echo $prod['qty']; ?></td>
        <td><?php echo number_format($prod['subtotal'], 2); ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" align="right"><strong>Total:</strong></td>
        <td><strong><?php echo number_format($total, 2); ?></strong></td>
    </tr>
</table>
<br>
<form method="post" action="process_order.php">
    <label>Payment Amount: <input type="number" name="payment" step="0.01" min="<?php echo $total; ?>" required></label><br>
    <button type="submit">Complete Order</button>
</form>
<?php else: ?>
<p>Your cart is empty.</p>
<?php endif; ?>
<a href="cart.php">Back to Cart</a>
</body>
</html>
