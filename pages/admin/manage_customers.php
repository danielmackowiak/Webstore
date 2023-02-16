<?php
// Check if user is logged in, if not, send him back to the login page, also checks if user is a admin.
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
      <th>Username</th>
      <th>Password</th>
      <th>E-mail</th>
      <th>Full name</th>
      <th>Address</th>
      <th>Created at</th>
      <th>Updated at</th>
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
      $query = "SELECT * FROM customers";
      $result = mysqli_query($conn, $query);
      
      // Loop through the results and display each customer in a new row
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>" . $row['updated_at'] . "</td>";
        echo "<td>";
        echo "<form method='' action='edit_customer.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='edit' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='delete_customer.php'>";
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