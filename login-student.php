<?php

session_start();

require "connection.php";
include 'navbar-index.php';


if (isset($_POST['student_id'])) {
	$user = mysqli_real_escape_string($con, $_POST['student_id']);
	$inputPassword = $_POST['password'];

	$query = mysqli_query($con, "SELECT password FROM student WHERE student_id='$user'");
	$hashedPasswordData = mysqli_fetch_assoc($query);

	// Fetch user details for session creation if needed
	$query2 = mysqli_query($con, "SELECT * FROM student WHERE student_id='$user'");
	$row = mysqli_fetch_assoc($query2);

	if ($row['verification_code'] != 1) {
		echo "<script> alert('You have not verified your email');
			window.location = 'verify-student.php'</script>";
	}

	else if ($hashedPasswordData) {
		$hashedPassword = $hashedPasswordData['password'];

		// Verify the password
		if (password_verify($inputPassword, $hashedPassword)) {
			$_SESSION["student_id"] = $row["student_id"];
			echo "<script>window.location = 'dashboard-student.php'</script>";
		} else {
			echo "<script> alert('Wrong username or password');</script>";
		}
	}
	
	else {
		echo "<script> alert('Wrong username or password');</script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/LOGIN.css">
</head>

<body>
	<div class="flex-container">
		<div>
			<h2>STUDENT LOG IN</h2>
		</div>

		<div class="form-container-student">
			<form method="post">
				<p>Student ID</p>
				<input type="text" name="student_id" placeholder="Enter your matrix number" required autofocus><br><br>

				<p>Password</p>
				<input type="password" name="password" placeholder="********" required>

				<br><br><br>
				<button name="hantar" type="submit" class="purpleButton">LOG IN </button>

				<p>Don't have an account? <u><a href="signup-student.php">Sign up</a></u></p>
			</form>
		</div>
	</div>
</body>

</html>