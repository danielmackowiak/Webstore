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
    <form action="add_product.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br>
        <label for="price" min="0">Price:</label>
        <input type="text" name="price" required>
        <br>
        <input type="submit" value="Add Product">
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
      
      // Select all products from the database
      $query = "SELECT * FROM products";
      $result = mysqli_query($conn, $query);
      
      // Loop through the results and display each product in a row
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>";
        echo "<form method='' action='edit_product.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='edit' value='Edit'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='delete_product.php'>";
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