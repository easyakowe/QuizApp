<?php
include 'server.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title> Easy Quiz App :: Login </title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body style="background: #cccccc;">
	<div class="header">
		<h2>Login</h2>
	</div>

	<form class="form_1" method="post" action="index.php">
		
		<!-- display validation errors here -->
		<?php include('errors.php');?>

		<div class="form-input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username;?>">
		</div>
		<div class="form-input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="form-input-group">
			<button type="submit" name="login" class="btn">Login</button>
		</div>
		<p>
			Not yet an admin? <a href="register.php">Sign up</a>
		</p>
	</form>
</body>
</html>