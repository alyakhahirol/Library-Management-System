<?php
include 'connection.php';
session_start();
include 'navbar-admin.php';
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
	<link rel="stylesheet" href="CSS/SIGNUP.css">
</head>

<body>
<div class="flex-container">
<div class="title-container">
			<div>
				<!--back button-->
				<a href="staff-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>STAFF SIGN UP</h2>
			</div>
		</div>

	<div class="form-container-staff">
		<!-- display sign up form -->
		<form method="POST" action="signup-staff-process-ADMIN.php">
			<p>Staff ID</p>
			<input type="text" name="staff_id" placeholder="Enter staff ID" autocomplete="NO" autofocus><br><br>

			<p>Full Name</p>
			<input type="text" name="name" placeholder="Enter full name" autocomplete="NO" required><br><br>
					
			<p>Staff Email</p>
			<input type="text" name="staff_email" placeholder="Enter staff email" autocomplete="NO" required><br><br>

			<p>Password</p>
			<input type="password" name="password" placeholder="********" autocomplete="NO" required><br><br>

			<p>Gender:</p>
			<input type="radio" id="F" name="gender" value="F">
			<label for="F">F</label><br>
			<input type="radio" id="M" name="gender" value="M">
			<label for="M">M</label><br><br>

			<p>Phone Number</p>
			<input type="tel" name="phone_number" maxlength="12" placeholder="01X-XXXXXXXX" autocomplete="NO" required><br><br>

			<p>Date Of Birth</p>
			<input type="date" name="date_of_birth" placeholder="DD-MM-YYYY" required>

			<br><br><br>
			<div>
				<button name="submit" type="submit" class="pinkButton"> SIGN UP </button>
			</div>
			
		</form>
	</div>
</div>
</body>

<style>
	h2 {
		margin: 0px;
	}

	.title-container {
		margin-bottom: 40px;
	}
</style>
</html>