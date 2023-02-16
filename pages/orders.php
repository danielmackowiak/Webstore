<?php
// Check if user is logged in, if not, send him back to the login page
session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: http://localhost/Webstore/pages/login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>My Webstore - My Orders</title>
    <link rel="stylesheet" href="../style.css">
  </head>
  <?php require_once("../require/nav.php"); ?>
  <body>
    <?php
      // Connect to the database
      $conn = mysqli_connect("localhost", "root", "", "mywebstore");

      // Check if the connection to the database was successful
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Get the logged in user's ID
      $customer_id = $_SESSION["user_id"];

      // Retrieve the orders for the logged in customer
      $sql = "SELECT * FROM orders WHERE customer_id = '$customer_id'";
      $result = $conn->query($sql);

      // Display the orders in a table
      if ($result->num_rows > 0) {
        echo "<table><tr><th>Order ID</th><th>Order Date</th><th>Total</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
          $order_id = $row["id"];
          $order_date = $row["order_date"];
          $total = $row["total"];
          $status = $row["status"];
          echo "<tr><td>$order_id</td><td>$order_date</td><td>$total</td><td>$status</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No orders found for this customer.";
      }
      $conn->close();
    ?>
  </body>
</html>