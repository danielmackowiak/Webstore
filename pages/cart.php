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
	<title>My Webstore - Shopping Cart</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php require_once("../require/nav.php"); ?>
	<table>
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
        <?php
            // Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mywebstore");


            // Check if cart is empty 
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            $total_price = 0;
            $sum = 0;
            if (!empty($_SESSION['cart'])) {
                $product_ids = array_keys($_SESSION['cart']);
                $sql = "SELECT * FROM products WHERE id IN (" . implode(",", $product_ids) . ")";
                $result = mysqli_query($conn, $sql);
                // Generate a table with your current order details
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $quantity = $_SESSION['cart'][$row['id']];
                        $price = $row['price'];
                        $total_price += $price * $quantity;
                        $sum += $total_price;
                        ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $total_price; ?></td>
                        </tr>
                        <?php
                        $total_price = 0;
                    }
                }
            }
            
            $_SESSION['sum'] = $sum;
            mysqli_close($conn);
            ?>
		</tbody>
	</table>
    <!-- Submit order by typing in name, email and a address -->
	<form action="../script/submit_order.php" method="post">
		<label for="name" value="">Name:</label>
		<input type="text" name="name" required><br>
		<label for="email">Email:</label>
		<input type="email" name="email" required><br>
		<label for="address">Address:</label>
		<textarea name="address" required></textarea><br>
		<input type="submit" value="Submit Order">
	</form>
</body>
</html>