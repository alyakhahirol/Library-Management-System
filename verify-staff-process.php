<?php
include "connection.php";
session_start();
$staff_id = $_SESSION["staff_id"];
$inputCode = $_POST['verification_code'];

$sql = "SELECT verification_code FROM staff WHERE staff_id='$staff_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['verification_code'] == $inputCode) {
	$updateSQL = "UPDATE staff SET verification_code='1' WHERE staff_id = '$staff_id'";
	mysqli_query($con, $updateSQL);

	echo "<script>alert('Verification successful! You can now log in.');
    window.location='login-staff.php';</script>";
} else {
	echo "<script>alert('Invalid verification code. Please try again.');
    window.location='verify-staff.php';</script>";
}
