<?php
include 'connection.php';
session_start();
include 'cart_functions.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;
    if ($product_id > 0 && $qty > 0) {
        cart_add($product_id, $qty);
    }
}

header("Location: products.php");
exit();
?>
