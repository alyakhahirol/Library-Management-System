<?php
include "connection.php";
session_start();
$student_id = $_SESSION["student_id"];
$inputCode = $_POST['verification_code'];

$sql = "SELECT verification_code FROM student WHERE student_id='$student_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['verification_code'] == $inputCode) {
	$updateSQL = "UPDATE student SET verification_code='1' WHERE student_id = '$student_id'";
	mysqli_query($con, $updateSQL);

	echo "<script>alert('Verification successful! You can change your password.');
    window.location='password-change.php';</script>";
} else {
	echo "<script>alert('Invalid verification code. Try again.');
    window.location='email-verify-student.php';</script>";
}
