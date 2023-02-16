<?php
// Check if user is logged in, if not, send him back to the login page, also checks if user is a admin.
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_SESSION['is_admin'])){
  header("Location: http://localhost/Webstore/pages/login.php");
}

// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'mywebstore');

// Check if the connection to the database was successful
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);

  $query = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";

  if (mysqli_query($conn, $query)) {
    header("Location: ./edit_products.php");
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>