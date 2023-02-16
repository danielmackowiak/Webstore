<!DOCTYPE html>
<html>
<head>
	<title>My Webstore - Login</title>
</head>
<body>
	<header>
		<h1>Login</h1>
	</header>
	<main>
		<!-- Login form for customers -->
		<h2>Customer Login</h2>
		<form method="POST" action="../script/process_login.php">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required><br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required><br>
			<a href="http://localhost/Webstore/pages/register.php">Register</a>
			<button type="submit">Login</button>
		</form>
		<!-- Login form for administrators -->
		<h2>Administrator Login</h2>
		<form method="POST" action="../script/process_login.php">
			<input type="hidden" name="admin" value="true">
			<label for="admin_username">Username:</label>
			<input type="text" id="admin_username" name="admin_username" required><br>
			<label for="admin_password">Password:</label>
			<input type="password" id="admin_password" name="admin_password" required><br>
			<button type="submit">Login</button>
		</form>
	</main>
</body>
</html>