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
    // Get the customer ID from the form
    $customer_id = $_POST["customer_id"];

    // Get the updated customer information from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $full_name= $_POST["full_name"];
    $address = $_POST["address"];

    // Update the customer in the database
    $query = "UPDATE customers SET username = '$username', password = '$password', email = '$email', full_name = '$full_name', address = '$address' WHERE id = $customer_id";
    mysqli_query($conn, $query);

    // Redirect back to the manage customers manage page
    header("Location: ./manage_customers.php");
    exit;
}

// If the form hasn't been submitted, display the edit product form
// Get the customer ID from the URL
$customer_id = $_GET["id"];

// Get the customer information from the database
$query = "SELECT * FROM customers WHERE id = $customer_id";
$result = mysqli_query($conn, $query);
$customer = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Webstore - Admin</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <!-- Edit the customer data using forms -->
    <h1>Edit Customer <?php echo $customer['full_name']; ?></h1>

    <form method="POST" action="">
        <input type="hidden" name="customer_id"  value="<?php echo $customer['id']; ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" required value="<?php echo $customer['username']; ?>">

        <label for="password">Password:</label>
        <input type="text" name="password" required value="<?php echo $customer['password']; ?>">

        <label for="email">E-mail:</label>
        <input type="email" name="email" required value="<?php echo $customer['email']; ?>">

        <label for="full_name">Full name:</label>
        <input type="text" name="full_name" required value="<?php echo $customer['full_name']; ?>">

        <label for="address">Address:</label>
        <textarea name="address" required><?php echo $customer['address']; ?></textarea><br>

        <input type="submit" value="Save">
    </form>
</body>
</html>