<?php
session_start();
$admin_login = isset($_POST['admin']);

if($admin_login) {
	$username = $_POST['admin_username'];
	$password = $_POST['admin_password'];
} else {
	$username = $_POST['username'];
	$password = $_POST['password'];
}

// Connect to database
$db = new PDO('mysql:host=localhost;dbname=mywebstore', 'root', '');

// Fetch user information
if($admin_login) {
	$statement = $db->prepare('SELECT id, username, password FROM administrators WHERE username = :username AND password = :password');
} else {
	$statement = $db->prepare('SELECT id, username, password FROM customers WHERE username = :username AND password = :password');
}

$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($user) {
	$_SESSION['user_id'] = $user['id'];
	$_SESSION['user_username'] = $user['username'];

    // Later add diffrent dashboards for a user and a admin
	if($admin_login) {
		$_SESSION['is_admin'] = true;
		header('Location: ../pages/mainpage.php');
	} else {
		header('Location: ../pages/mainpage.php');
	}
} else {
	$_SESSION['login_error'] = 'Invalid username or password';
	header('Location: ../pages/login.php');
}