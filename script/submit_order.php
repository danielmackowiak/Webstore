<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: ../pages/login.php');
    exit();
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    // Redirect to the products page if the cart is empty
    header('Location: ../pages/products.php');
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mywebstore");

// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID
$user_id = $_SESSION['user_id'];

// Get the sum of an order
$order_sum = $_SESSION['sum'];

// Insert the order into the orders table
$sql = "INSERT INTO orders (customer_id, total) VALUES ($user_id, $order_sum)";
$conn->query($sql);

// Get the order ID
$order_id = $conn->insert_id;

// Insert the order items into the order_items table
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $product_id, $quantity)";
    $conn->query($sql);
}
// Get order items and product details
$query = "SELECT oi.order_id, oi.product_id, oi.quantity, p.price FROM order_items oi JOIN products p ON oi.product_id = p.id";
$result = mysqli_query($conn, $query);

// Loop through each order item and update price
while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row['order_id'];
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $total_price = $quantity * $price;

    // Update the price column in order_items table for this product and order
    $update_query = "UPDATE order_items SET price = $total_price WHERE order_id = $order_id AND product_id = $product_id";
    mysqli_query($conn, $update_query);
}
// Clear the cart
$_SESSION['cart'] = array();

// Close the database connection
$conn->close();

// Redirect to the main page with confirmation about the order
?><script type="text/javascript">
    alert("Your order has been confirmed, click OK to go back to the home page!")
    window.location.href = "../pages/mainpage.php";
</script><?php
exit();