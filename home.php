<?php
	include 'server.php';

	if (!isset($_SESSION['username'])) {
		header('location: index.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport"
	content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script defer
	src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Easy Quiz App :: Home</title>
</head>
<body style="background: white;">
	<h1 style="text-align: center;">EasyTech Chemistry Quiz App</h1>

	<h2 class="" style="text-align: center; color: green;">Welcome <?php echo $_SESSION['username'];?></h2>
	<h3 class="box" style="color: gray; background: #b4eeb4;"><b>Instruction: </b><?php echo $_SESSION['username']; ?>, you need to select one correct option of the 4 options. Best of Luck!</h3>

	<div class="container" style="border-color: gray; box-shadow: 0 1px 5px rgba(104, 104, 104, 0.8); ">
		<form action="scores.php" method="POST">
		<?php 
		for ($i=1; $i < 6; $i++) { 	
		$sql = "select * from questions where question_id='$i'";
		$query = mysqli_query($conn, $sql);

		while ($row = mysqli_fetch_array($query)) {
			?>
		<div class="box">
			<h4 style="text-align: left;"> <?php echo $row['question_id'];?>.  <?php echo $row['question'];?> </h4>
		</div><br>	


			<?php 
			$sql = "select * from answers where ans_id='$i'";
			$query = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($query)) {
				?>

				<div class="box2" style="padding-left: 24px;">
					<input type="radio" name="quizcheck[<?php echo $row['ans_id'];?>]" value="<?php echo $row['a_id'];?>"><?php echo $row['answer'];?>
				</div><br>
				<?
				}
				?>
			
		<?php
		}
	}
		?>
		<div style="text-align: center;">
		<br>
		<input style="margin: auto; color: white; background: #008000; width: 140px; height: 40px; border-radius: 5px; border: none;" name="submit" type="submit" value="Submit">
		
		</div><br>
	</div><br><br>

	

	<div style="text-align: center; ">
	<input style="margin: auto; color: white; background: #ff4040; width: 100px; height: 35px; border-radius: 5px; border: none;" name="logout" type="submit" value="Logout">
	</div>
	</form>
</body>

<footer>
	<div style="width: 100%; height: 70px;">
		<p>&copy; 2019. EasyTech Quiz App </p>
	</div>
</footer>
</html>

<?php
	if (isset($_POST['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header('location: index.php');
}

?>