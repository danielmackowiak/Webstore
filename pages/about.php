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
    <title>My Webstore - About Us</title>
  </head>
  <body>
<?php require_once("../require/nav.php"); ?>
    <h1>About Us</h1>
    <p>We are a webstore that sells a variety of products at affordable prices. Our goal is to provide a convenient and reliable online shopping experience for our customers.</p>
    <p>If you have any questions or concerns, please don't hesitate to contact us using the form below:</p>
    <!-- Form for sending an e-mail to the database, database should be replaced by a proper mailbox -->
    <form action="../script/send_email.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br>
      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea><br>
      <button type="submit">Send</button>
    </form>
    <p>If you have any questions or concerns, you can reach us by phone or email:</p>
    <ul>
      <li>Phone: 1-800-555-1234</li>
      <li>Email: info@mywebstore.com</li>
    </ul>
  </body>
</html>