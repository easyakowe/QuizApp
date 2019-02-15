<?php
session_start();

$username = "";
$email = "";
$errors = array();

// Connecting to the database
$conn = mysqli_connect('localhost', 'root');
mysqli_select_db($conn, 'quizapp');

if (isset($_POST['register'])) {
	$username = $_POST['username'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Passwords do not match");
	}

	// if there are no errors then save to database

	if (count($errors) == 0) {

		$password = md5($password_1);

		$sql = "INSERT INTO user(username, password) VALUES ('$username', '$password')";

		mysqli_query($conn, $sql);

		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['success'] = "You are now logged in";
		header('location: home.php');
	}
	else{
		echo "<script>alert('Failed to register user')</script>";
	}
}
	// login user
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0 ) {
		$password = md5($password);
		$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) == 1) {
			# log in user
			$_SESSION['username'] = $username;
			$_SESSION['user_id'] = $user_id;
			$_SESSION['success'] = "You are now logged in";
			header('location: home.php');
		}else {
			array_push($errors, "wrong username/password combination");
		}

	}
}


	// logout
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header('location: index.php');
}

?>