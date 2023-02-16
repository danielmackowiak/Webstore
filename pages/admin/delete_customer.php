<?php
// Check if user is logged in, if not, send him back to the login page, also checks if user is a admin.
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_SESSION['is_admin'])){
  header("Location: http://localhost/Webstore/pages/login.php");
}

// Check if the delete button was clicked
if (isset($_POST['delete'])) {
    // Get the ID of the row to be deleted
    $id = $_POST['id'];
    
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'mywebstore');
    
    // Delete the row from the table
    $query = "DELETE FROM customers WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    // Close the database connection
    mysqli_close($conn);
    
    header("Location: http://localhost/Webstore/pages/admin/manage_customers.php");
}
?>