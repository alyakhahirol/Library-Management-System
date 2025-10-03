<?php

include "connection.php";
session_start();
include "navbar-admin.php";

$STUDENTID = $_GET["student_id"];

// Fetch student data from the database
$dataStudent = mysqli_query($con, "SELECT * FROM student WHERE student_id='$STUDENTID'");
$infoStudent = mysqli_fetch_array($dataStudent);

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$student_email = $_POST['student_email'];
	$faculty = $_POST['faculty'];

	// Update student data
	$result1 = mysqli_query($con, "UPDATE student
	SET name='$name', date_of_birth='$date_of_birth', gender='$gender',
	phone_number='$phone_number', student_email='$student_email', faculty='$faculty'
	WHERE student_id='$STUDENTID'");

	if ($result1) {
		// Re-fetch the updated data
		$dataStudent = mysqli_query($con, "SELECT * FROM student WHERE student_id='$STUDENTID'");
		$infoStudent = mysqli_fetch_array($dataStudent);

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
			<a href="student-manage-ADMIN.php" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div>
			<h2>STUDENT ACCOUNT DETAIL</h2>
		</div>
	</div>

	<div class="form-container-staff">
		<form method='POST'>
			<p>Matrix Number</p>
			<input type="text" name="name" size="60" value="<?php echo $infoStudent['student_id']; ?>" readonly><br><br>

			<p>Full Name</p>
			<input type="text" name="name" size="60" value="<?php echo $infoStudent['name']; ?>" required><br><br>

			<p>Password</p>
			<input type="text" name="name" size="60" value="<?php echo $infoStudent['password']; ?>" readonly><br><br>

			<p>Phone Number</p>
			<input type="text" name="phone_number" size="60" value="<?php echo $infoStudent['phone_number']; ?>" required><br><br>

			<p>E-mail</p>
			<input type="text" name="student_email" size="60" value="<?php echo $infoStudent['student_email']; ?>" required><br><br>

			<p>Faculty</p>
			<input type="text" name="faculty" size="60" value="<?php echo $infoStudent['faculty']; ?>" required><br><br>

			<p>Date Of Birth</p>
			<input type="date" name="date_of_birth" value="<?php echo $infoStudent['date_of_birth']; ?>" required><br><br>

			<p>Gender</p>
			<input type="radio" id="F" name="gender" value="F" <?php echo ($infoStudent['gender'] == 'F') ? 'checked' : ''; ?>>
			<label for="F">F</label><br>
			<input type="radio" id="M" name="gender" value="M" <?php echo ($infoStudent['gender'] == 'M') ? 'checked' : ''; ?>>
			<label for="M">M</label><br><br><br>

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