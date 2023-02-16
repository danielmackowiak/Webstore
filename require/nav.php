<?php
if(isset($_SESSION['is_admin'])){
    ?>
	<header>
		<h1>My Webstore</h1>
		<nav>
			<ul>
				<li><a href="http://localhost/Webstore/pages/mainpage.php">Home</a></li>
				<li><a href="http://localhost/Webstore/pages/products.php">Products</a></li>
                <li><a href="http://localhost/Webstore/pages/orders.php">My Orders</a></li>
				<li><a href="http://localhost/Webstore/pages/cart.php">Shopping Cart</a></li>
				<li><a href="http://localhost/Webstore/pages/about.php">About Us</a></li>
                <li><a href="http://localhost/Webstore/script/logout.php">Logout</a></li>
			</ul>
			<ul>
				<li><a href="http://localhost/Webstore/pages/admin/manage_products.php">Manage products</a></li>
				<li><a href="http://localhost/Webstore/pages/admin/manage_customers.php">Manage customers</a></li>
				<li><a href="http://localhost/Webstore/pages/admin/manage_orders.php">Manage orders</a></li>
				<li><a href="http://localhost/Webstore/pages/admin/view_emails.php">View e-mails</a></li>
			</ul>
		</nav>
	</header>
	<?php
}else{
	?>
	<header>
		<h1>My Webstore</h1>
		<nav>
			<ul>
				<li><a href="http://localhost/Webstore/pages/mainpage.php">Home</a></li>
				<li><a href="http://localhost/Webstore/pages/products.php">Products</a></li>
                <li><a href="http://localhost/Webstore/pages/orders.php">My Orders</a></li>
				<li><a href="http://localhost/Webstore/pages/edit_profile.php">Edit profile</a></li>
				<li><a href="http://localhost/Webstore/pages/cart.php">Shopping Cart</a></li>
				<li><a href="http://localhost/Webstore/pages/about.php">About Us</a></li>
                <li><a href="http://localhost/Webstore/script/logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>
	<?php
}
?>