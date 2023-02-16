<?php
// Check if user is logged in, if not, send him back to the login page, also checks if user is a admin
session_start();
if(!isset($_SESSION["user_id"]) || !isset($_SESSION['is_admin'])){
  header("Location: http://localhost/Webstore/pages/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Webstore - Admin</title>
  <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php require_once("../../require/nav.php"); ?>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Full name</th>
      <th>E-mail</th>
      <th>Address</th>
      <th>Order date</th>
      <th>Total price</th>
      <th>Order status</th>
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
      
      // Select specified columns from orders and customers table in the database
      $query = "SELECT orders.id, orders.customer_id, customers.email, customers.address, customers.full_name, orders.order_date, orders.total, orders.status FROM orders JOIN customers ON orders.customer_id = customers.id ORDER BY orders.id ASC";
      $result = mysqli_query($conn, $query);
      
      // Loop through the results and display each order in a row
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['order_date'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>";
        echo "<form method='' action='edit_order.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='edit' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='delete_order.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
</body>
</html>