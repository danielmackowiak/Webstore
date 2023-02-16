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
	<title>My Webstore - Home</title>
</head>
<body>
<?php require_once("../require/nav.php"); ?>
	<main>
		<h2>Featured Products</h2>
		<section>
				<h3>Product 1</h3>
				<img src="./pictures/product1.jpg" alt="Product 1">
				<p>Description of Product 1</p>

				<h3>Product 2</h3>
				<img src="./pictures/product2.jpg" alt="Product 2">
				<p>Description of Product 2</p>

				<h3>Product 3</h3>
				<img src="./pictures/product3.jpg" alt="Product 3">
				<p>Description of Product 3</p>
		</section>
	</main>
</body>
</html>