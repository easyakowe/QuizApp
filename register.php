<?php 
	include 'server.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Easy Quiz App :: Register</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body style="background: #cccccc;">
	<div class="header">
		<h2>Register</h2>
	</div>

	<form class="form_1" method="post" action="register.php">

		<!-- display validation errors here -->
		<?php include('errors.php');?>

		<div class="form-input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username;?>">
		</div>
		<div class="form-input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="form-input-group">
			<label>Confirm Password</label>
			<input type="password" name="password_2">
		</div>
		<div class="form-input-group">
			<button type="submit" name="register" class="btn">Register</button>
		</div>
		<p>
			Already an admin? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html>