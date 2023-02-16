<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mywebstore");

// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert data into database
$sql = "INSERT INTO emails (name, email, message) VALUES ('$name', '$email', '$message')";
if (mysqli_query($conn, $sql)) {
    header('Location: ../pages/about.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>