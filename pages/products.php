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
    <title>My Webstore - Products</title>
</head>
<body>
<?php require_once("../require/nav.php"); ?>
    <h1>My Webstore - Products</h1>
    <!-- Wanted to create a dynamic product page, that would just get data (description, price, name) from the database table, but encountered some problems so it is static. -->
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Product A</td>
                <td>Description A</td>
                <td>$19.99</td>
                <td>
				<form method="post" action="../script/add_to_cart.php">
                    <input type="hidden" name="product_id" value="1">
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
					<button type="submit">Add to cart</button>
				</form>
            </td>
            </tr>
            <tr>
                <td>Product B</td>
                <td>Description B</td>
                <td>$29.99</td>
                <td>
				<form method="post" action="../script/add_to_cart.php">
                    <input type="hidden" name="product_id" value="2">
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
					<button type="submit">Add to cart</button>
				</form>
            </td>
            </tr>
            <tr>
                <td>Product C</td>
                <td>Description C</td>
                <td>$39.99</td>
                <td>
				<form method="post" action="../script/add_to_cart.php">
                    <input type="hidden" name="product_id" value="3">
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
					<button type="submit">Add to cart</button>
				</form>
            </td>
            </tr>
        </tbody>
    </table>
</form>
</body>
</html>