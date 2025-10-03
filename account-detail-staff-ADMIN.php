<?php

include "connection.php";
session_start();
include "navbar-admin.php";

$STAFFID = $_GET["staff_id"];

// Fetch staff data from the database
$dataStaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$STAFFID'");
$infoStaff = mysqli_fetch_array($dataStaff);

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$staff_email = $_POST['staff_email'];

	// Update staff data
	$result1 = mysqli_query($con, "UPDATE staff
	SET name='$name', date_of_birth='$date_of_birth', gender='$gender',
	phone_number='$phone_number', staff_email='$staff_email'
	WHERE staff_id='$STAFFID'");

	if ($result1) {
		// Re-fetch the updated data
		$dataStaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$STAFFID'");
		$infoStaff = mysqli_fetch_array($dataStaff);

		// Show a success message
		echo "<script>alert('Edit successful');</script>";
	} else {
		echo "<script>alert('Error: Unable to update data');</script>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
	<link rel="stylesheet" href="CSS/SIGNUP.css">
</head>

<div class="flex-container">
	<div class="title-container">
		<div>
			<!--back button-->
			<a href="staff-manage-ADMIN.php" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div>
			<h2>STAFF ACCOUNT DETAILS</h2>
		</div>
	</div>

	<div class="form-container-staff">
		<form method='POST'>
			<p>Staff ID</p>
			<input type="text" name="staff_id" size="60" value="<?php echo $infoStaff['staff_id']; ?>" readonly><br><br>

			<p>Full Name</p>
			<input type="text" name="name" size="60" value="<?php echo $infoStaff['name']; ?>" required><br><br>

			<p>E-mail</p>
			<input type="email" name="staff_email" size="60" value="<?php echo $infoStaff['staff_email']; ?>" required><br><br>

			<p>Password</p>
			<input type='text' name='password' value="<?php echo $infoStaff['password']; ?>" readonly>

			<p>Gender</p>
			<input type="radio" id="F" name="gender" value="F" <?php echo ($infoStaff['gender'] == 'F') ? 'checked' : ''; ?>>
			<label for="F">F</label><br>
			<input type="radio" id="M" name="gender" value="M" <?php echo ($infoStaff['gender'] == 'M') ? 'checked' : ''; ?>>
			<label for="M">M</label><br><br><br>

			<p>Phone Number</p>
			<input type="text" name="phone_number" size="10" value="<?php echo $infoStaff['phone_number']; ?>" required><br><br>

			<p>Date Of Birth</p>
			<input type="date" name="date_of_birth" value="<?php echo $infoStaff['date_of_birth']; ?>" required><br><br>

			<!--update button-->
			<button name="submit" type="submit" class="pinkButton">UPDATE</button>
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