<?php
	include 'server.php';

	if (!isset($_SESSION['username'])) {
		header('location: index.php');
	}

	$count = 0;
	if (isset($_POST['submit'])) {
		if (!empty($_POST['quizcheck'])) {
					
			$count = count($_POST['quizcheck']);

			$result = 0;
			$i = 1;

			$selected = $_POST['quizcheck'];
			// print_r($selected);

			$sql = "select * from questions";
			$query = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($query)) {
				
				$answers = $row['answer_id'];
				// print_r($answers);

				$checked = $answers == $selected[$i];

				if ($checked) {
					$result++;
				}
				$i++;

			}
			$percent = ($result/5)*100;
			$grade = "";
			if ($percent >= 50) {
				$grade = "Pass";
			}else{
				$grade = "Fail";
			}

			$username = $_SESSION['username'];
			$user_id = $_SESSION['user_id'];

			$f_result = "insert into result(user_id, username, score, grade) values ('$user_id', '$username', '$percent', '$grade')";
			$f_query = mysqli_query($conn, $f_result);

			if ($f_query) {
				echo "Successful!";
			}
		}
	
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
	<title>Easy Quiz App :: Scores</title>
</head>
<body style="background: white;"><br>
	<h1 style="text-align: center;">EasyTech Chemistry Quiz App</h1><br><br>

	<div style="border-color: gray; box-shadow: 0 1px 5px rgba(104, 104, 104, 0.8); margin-left: 80px; margin-right: 80px;">
		<h2 class="box" style="background: black; color: white; text-align: center;">Result</h2>
		
		<div class="box" style="text-align: left;">

			<div >
				<?
			if ($percent >= 50) {
				echo "<h2 style='color: green;'>Congratulations, you Passed!!!";
			}else{
				echo "<h2 style='color: red;'>Sorry, You didn't Pass :(";
			}
			?>
			</div>

			<p>Questions attempted</p>
			<p><?php echo "Out of 5 questions, You answered ". $result. " correctly!"; ?></p>
		</div>

		<div style="padding-left: 32px; padding-bottom: 8px;">
			<p>Your total score</p>
			<p><?php echo "Your total score is ".$percent ."%"; ?></p>
		</div>
	</div><br>
	<div style="text-align: center; ">
	<input style="margin: auto; color: white; background: #ff4040; width: 100px; height: 35px; border-radius: 5px; border: none;" name="logout" type="submit" value="Logout">
	</div>

	<?php

	if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header('location: index.php');
	}

	?>
</body>
</html>