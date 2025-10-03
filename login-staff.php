<?php
session_start();
require "connection.php";
include 'navbar-index.php';

if (isset($_POST['staff_id'])) {
	$user = mysqli_real_escape_string($con, $_POST['staff_id']);
	$inputPassword = mysqli_real_escape_string($con, $_POST['password']);

	$query = mysqli_query($con, "SELECT password FROM staff WHERE staff_id='$user'");
	$hashedPasswordData = mysqli_fetch_assoc($query);

	// Fetch the hashed password from the database
	$query2 = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$user'");
	$row = mysqli_fetch_assoc($query2);

	if ($row['verification_code'] != 1) {
		echo "<script> alert('You have not verified your email');
		window.location = 'verify-staff.php'</script>";
	}
	
	else if ($hashedPasswordData) {
		$hashedPassword = $hashedPasswordData['password']; // Extract the hashed password

		// Verify the password
		if (password_verify($inputPassword, $hashedPassword)) {
			$_SESSION["staff_id"] = $row["staff_id"];

			if (strtolower($user) == 'admin') {
				echo "<script>window.location = 'dashboard-admin.php'</script>";
			} else {
				echo "<script>window.location = 'dashboard-staff.php'</script>";
			}
		} else {
			echo "<script> alert('Wrong username or password');</script>";
		}
	} else {
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
			<h2>STAFF LOG IN</h2>
		</div>

		<div class="form-container-staff">
			<form method="post">
				<p>Staff ID</p>
				<input type="text" name="staff_id" placeholder="Enter your staff ID" required autofocus><br><br>

				<p>Password</p>
				<input type="password" name="password" placeholder="********" required>

				<br><br><br>
				<button name="hantar" type="submit" class="blueButton">LOG IN</button>

				<p>Don't have an account? Contact admin</p>
			</form>
		</div>
	</div>
</body>

</html>