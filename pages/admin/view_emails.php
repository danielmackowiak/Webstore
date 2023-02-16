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
      <th>Sender</th>
      <th>E-mail</th>
      <th>Message</th>
      <th>Created at</th>
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
      
      // Select all emails from the database
      $query = "SELECT * FROM emails";
      $result = mysqli_query($conn, $query);
      
      // Loop through the results and display each email in a row
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
</body>
</html>