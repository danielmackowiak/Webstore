<?php
// Check if user is logged in, if he is, send him to the main page
session_start();
if(isset($_SESSION["user_id"])){
  header("Location: http://localhost/Webstore/pages/mainpage.php");
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "mywebstore");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];

    // Prepare the SELECT query to check if the email exists
    $query = "SELECT id FROM customers WHERE email = '$email'";

    // Execute the query and get the number of rows returned
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    // Check if the email exists (i.e. the number of rows is greater than zero)
    if ($num_rows > 0) {
        // Redirect to the register page, cause email is allready taken
        ?><script type="text/javascript">
            alert("E-mail is allready taken, please create account using a diffrent e-mail address!")
            window.location.href = "../pages/register.php";
        </script><?php
    } else {
        // Insert the data into the customers table
        $sql = "INSERT INTO customers (username, password, email, full_name, address) VALUES ('$username', '$password', '$email', '$full_name', '$address')";
            // Execute the query and input new customer data
            $exec = mysqli_query($conn, $sql);
    ?><script type="text/javascript">
        alert("Account has been created, click OK to go back to the login page!")
        window.location.href = "../pages/login.php";
    </script><?php
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Webstore - Register</title>
</head>
<body>
	<header>
		<h1>Register</h1>
	</header>
	<main>
        <!-- Registration form -->
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required id="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required id="password"><br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required id="email"><br><br>
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" required id="full_name"><br><br>
            <label for="address">Address:</label>
            <input type="text" name="address" required id="address"><br><br>
            <input type="submit" value="Register">
        </form>
	</main>
</body>
</html>