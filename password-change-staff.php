<?php

require 'connection.php';
include 'navbar-staff.php';

// Get staff_id
$STAFFID = $_SESSION['staff_id'];

// Fetch stored password from the staff table
$dataStaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$STAFFID'");
$infoStaff = mysqli_fetch_array($dataStaff);

// Check if the form is submitted
if (isset($_POST['hantar'])) {
    	$password = $_POST['password'];
    	$newpassword = $_POST['newpassword'];

	// Verify current password
	if ($password == $infoStaff['password']) {
		// Update the password in the database
		$result = mysqli_query($con, "UPDATE staff SET password='$newpassword' WHERE staff_id='$STAFFID'");

		// Success message
		if ($result) {
			echo "<script> alert('Password updated successfully!');
			window.location = 'account-detail-staff.php'; </script>";
		} else {
			echo "<script> alert('Failed to update password. Please try again.');
			window.location = 'password-change-staff.php'; </script>";
		}
	} else {
		// Error if the current password does not match
		echo "<script> alert('Your old password has been entered incorrectly. Please enter it again.');
			window.location = 'password-change-staff.php'; </script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    	<link rel="stylesheet" href="CSS/login.css">
</head>
<body>

<div class="flex-container">
	<div class="title-container">
		<div>
			<!-- Back button -->
			<a href="account-detail-staff.php" class="circle-button">
			<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div>
			<h2>CHANGE PASSWORD</h2>
		</div>
	</div>

	<div class="form-container-staff">
		<form method="POST">
			<label>Current Password</label><br><br>
			<input type="password" name="password" value="" placeholder="Enter current password" autofocus required><br><br><br>
					
			<label>New Password</label><br><br>
			<input type="password" name="newpassword" size="45" value="" minlength="8" placeholder="Enter new password" required><br><br><br>    
			
			<!-- Buttons -->
			<div class="button-container">
			<button name="hantar" type="submit" class="purpleButton">CHANGE PASSWORD</button>
			</div>
		</form>
	</div>
</div>
</body>

<style> 

h2 {
	letter-spacing: 1px;
	transition-duration: 0.4s;
}

h2:hover {
	letter-spacing: 2px;
}
.circle-button {
	margin: 0;
	overflow: hidden;
	display: block;
	background-color: white;
	border-radius: 25px;
	transition-duration: 0.4s;
	border: 2px solid white;
	width: 35px;
	height: 35px;
	margin-right: 20px;
	padding: 0;
	list-style-type: none;
	overflow: hidden;
	text-align: center;
	float: left;
}

.circle-button:hover {
	border: 2px solid lightgray;
      background-color: lightgray;
      border-radius: 50px;
}

.circle-button-link {
	font-size: 20px;
	text-align: center;
	text-decoration: none;
	margin-top: -7px;
	margin-left: -8px;
}

.image {
	height: 35px;
}


/*button*/
.purpleButton {
	font-family: "Unica One", sans-serif;
	font-size: 16px;
	color: white;

	width: 540px;
	height: 36px;
	border: none;
	outline:none;
	background-color: #646EC6;
	border-radius: 35px;

	transition-duration: 0.3s;
	cursor: pointer;
}

.purpleButton:hover {
      background-color: #423ca2;
      color: white;
}
</style>
</html>
