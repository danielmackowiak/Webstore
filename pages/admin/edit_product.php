<?php
// Check if user is logged in, if not, send him back to the login page, also checks if user is a admin.
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_SESSION['is_admin'])){
  header("Location: http://localhost/Webstore/pages/login.php");
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mywebstore");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product ID from the form
    $product_id = $_POST["product_id"];

    // Get the updated product information from the form
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Update the product in the database
    $query = "UPDATE products SET name = '$name', description = '$description', price = '$price' WHERE id = $product_id";
    mysqli_query($conn, $query);

    // Redirect back to the product list page
    header("Location: ./manage_products.php");
    exit;
}

// If the form hasn't been submitted, display the edit product form
// Get the product ID from the URL
$product_id = $_GET["id"];

// Get the product information from the database
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Webstore - Admin</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form method="POST" action="">
        <input type="hidden" name="product_id" required value="<?php echo $product['id']; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" required value="<?php echo $product['name']; ?>">

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>

        <label for="price">Price:</label>
        <input type="text" name="price" required value="<?php echo $product['price']; ?>">

        <input type="submit" value="Save">
    </form>
</body>
</html>