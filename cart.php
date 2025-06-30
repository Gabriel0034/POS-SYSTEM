<?php
// cart.php
// Displays the user's shopping cart, allows updating/removing items, and clearing the cart.

include 'connection.php';
session_start();
include 'cart_functions.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['qty'] as $pid => $qty) {
            cart_update($pid, intval($qty));
        }
    } elseif (isset($_POST['remove'])) {
        cart_remove($_POST['remove']);
    } elseif (isset($_POST['clear'])) {
        cart_clear();
    }
    header("Location: cart.php");
    exit();
}

// Fetch cart items
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
<head><title>Cart</title></head>
<body>
<h2>Cart</h2>
<?php if ($products): ?>
<form method="post">
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $prod): ?>
    <tr>
        <td><?php echo htmlspecialchars($prod['name']); ?></td>
        <td><?php echo number_format($prod['price'], 2); ?></td>
        <td>
            <input type="number" name="qty[<?php echo $prod['id']; ?>]" value="<?php echo $prod['qty']; ?>" min="1">
        </td>
        <td><?php echo number_format($prod['subtotal'], 2); ?></td>
        <td>
            <button type="submit" name="remove" value="<?php echo $prod['id']; ?>">Remove</button>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" align="right"><strong>Total:</strong></td>
        <td colspan="2"><strong><?php echo number_format($total, 2); ?></strong></td>
    </tr>
</table>
<br>
<button type="submit" name="update">Update Cart</button>
<button type="submit" name="clear" value="1">Clear Cart</button>
</form>
<br>
<a href="checkout.php">Proceed to Checkout</a>
<?php else: ?>
<p>Your cart is empty.</p>
<?php endif; ?>
<a href="products.php">Back to Products</a>
</body>
</html>
