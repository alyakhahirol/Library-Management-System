<?php

include "connection.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

//accept POST value
if (isset($_POST['staff_id'])) {
	$staff_id = $_POST['staff_id'];
	$staff_email = $_POST['staff_email'];

	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$date_of_birth = $_POST['date_of_birth'];

	//check if duplicate
	$checkdupSQL = "SELECT * FROM STAFF WHERE staff_id='$staff_id' OR staff_email='$staff_email'";

	$result = mysqli_query($con, $checkdupSQL);

	//message if already have an account	
	if (mysqli_num_rows($result) > 0) {
		echo "<script> alert('Registration failed, staff ID already exists.');
		window.location = 'signup-staff-ADMIN.php' </script>";
	} else {
		$password = $_POST['password'];
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// generate a 6-digit verification code
		$verificationCode = rand(100000, 999999);

		$query_login = "INSERT INTO staff (name, staff_id, date_of_birth, gender, phone_number, staff_email, password, verification_code) 
        VALUES ('" . $_POST['name'] . "', '" . $_POST['staff_id'] . "', '" . $_POST['date_of_birth'] . "', '" . $_POST['gender'] . "', '" . $_POST['phone_number'] . "', '" . $_POST['staff_email'] . "', '$hashedPassword', '$verificationCode')";

		session_start();
		$_SESSION["staff_id"] = $staff_id;

		$laksana_query = mysqli_query($con, $query_login);

		if ($laksana_query) {
			$mail = new PHPMailer(true);
			try {
				// Server settings
				$mail->isSMTP();
				$mail->Host       = 'smtp.gmail.com';      // Set SMTP server
				$mail->SMTPAuth   = true;
				$mail->Username   = 'miku.alya@gmail.com'; // Your email
				$mail->Password   = 'zjdc wypu tuxs gupd';    // Your email password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port       = 587;

				// Recipients
				$mail->setFrom('miku.alya@gmail.com', 'Book Haven');
				$mail->addAddress($_POST['staff_email']);

				// Content
				$mail->isHTML(true);
				$mail->Subject = 'Your Verification Code';
				$mail->Body    = "Dear " . $_POST['name'] . ",<br><br>Your verification code is: <b>$verificationCode</b><br><br>Please enter this code to complete your registration.";

				$mail->send();
				echo "<script> alert('Sign Up Successful. A verification code has been sent to your email.');
                			window.location = 'verify-staff.php' </script>";
			} catch (Exception $e) {
				echo "Verification email could not be sent. Error: {$mail->ErrorInfo}";
			}
		} else {
		echo "<script>
			  alert('Registration failed. Please try again.');
			  window.location = 'signup-staff-ADMIN.php';
			</script>";
		}
	}
}
