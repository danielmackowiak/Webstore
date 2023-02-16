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
    // Get the order ID from the form
    $order_id = $_POST["order_id"];

    // Get the updated order information from the form
    $customer_id = $_POST["customer_id"];
    $total = $_POST["total"];
    $status = $_POST["status"];

    // Update the order in the database
    $query = "UPDATE orders SET customer_id = '$customer_id', total = '$total', status = '$status' WHERE id = $order_id";
    mysqli_query($conn, $query);

    // Redirect back to the manage orders page
    header("Location: ./manage_orders.php");
    exit;
}

// If the form hasn't been submitted, display the edit product form
// Get the product ID from the URL
$order_id = $_GET["id"];

// Get the orders information from the database
$query = "SELECT * FROM orders WHERE id = $order_id";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Webstore - Admin</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Edit Order nr <?php echo $order_id; ?></h1>
    <!-- Edit order information using forms -->
    <form method="POST" action="">
        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">

        <label for="customer_id">Customer_id:</label>
        <input type="text" name="customer_id" required value="<?php echo $order['customer_id']; ?>">

        <label for="total">Total price:</label>
        <input type="text" name="total" required value="<?php echo $order['total']; ?>">

        <label for="status">Order status:</label>
        <select name="status" required value="<?php echo $order['status']; ?>">
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
        </select>
        <input type="submit" value="Save">
    </form>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th colspan="2">Actions</th>

    </tr>
  </thead>
  <tbody>
    <?php
      // Connect to database
      $conn = mysqli_connect('localhost', 'root', '', 'mywebstore');

      // Check if the connection to the database was successful
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
      
      // Select all customers from the database
      $query = "SELECT * FROM customers ORDER BY id DESC";
      $result = mysqli_query($conn, $query);
      
      // Loop through the results and display each customer in a table
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>";
      }
    ?>
    </tbody>
</table>
</body>
</html>