<?php
// cart_functions.php
// Contains reusable functions for cart operations: add, update, remove, clear, and get items.

function cart_add($product_id, $qty = 1) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $qty;
    } else {
        $_SESSION['cart'][$product_id] = $qty;
    }
}

function cart_update($product_id, $qty) {
    if (isset($_SESSION['cart'][$product_id])) {
        if ($qty > 0) {
            $_SESSION['cart'][$product_id] = $qty;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

function cart_remove($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

function cart_clear() {
    $_SESSION['cart'] = [];
}

function cart_get_items() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}
?>
