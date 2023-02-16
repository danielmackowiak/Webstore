<?php
session_start();

// If cart array isn't set, then it creates one
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Adding products, and quantity to the cart array
if (isset($_SESSION['cart'][$product_id])) {
	$_SESSION['cart'][$product_id] += $quantity;
} else {
	$_SESSION['cart'][$product_id] = $quantity;
}

header('Location: ../pages/products.php');
exit;
?>