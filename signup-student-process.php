<?php

include "connection.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if (!isset($student_id)) {
	$student_id = $_POST['student_id'];
	$student_email = $_POST['student_email'];

	// Check if student already exists
	$checkdupSQL = "SELECT * FROM student WHERE student_id='$student_id' OR student_email='$student_email' ";
	$result = mysqli_query($con, $checkdupSQL);

	if (mysqli_num_rows($result) > 0) {
		echo "<script> alert('Registration failed, you might already have an account');
        window.location='login-student.php'</script>";
	} else {
		// Hash the password before storing it in the database
		$password = $_POST['password'];
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// generate a 6-digit verification code
		$verificationCode = rand(100000, 999999);

		$query_login = "INSERT INTO student (name, student_id, date_of_birth, gender, phone_number, student_email, faculty, password, verification_code) 
        VALUES ('" . $_POST['name'] . "', '" . $_POST['student_id'] . "', '" . $_POST['date_of_birth'] . "', '" . $_POST['gender'] . "', '" . $_POST['phone_number'] . "', '" . $_POST['student_email'] . "', '" . $_POST['faculty'] . "', '$hashedPassword', '$verificationCode')";
		session_start();
		$_SESSION["student_id"] = $student_id;

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
				$mail->addAddress($_POST['student_email']);   // Student's email

				// Content
				$mail->isHTML(true);
				$mail->Subject = 'Your Verification Code';
				$mail->Body    = "Dear " . $_POST['name'] . ",<br><br>Your verification code is: <b>$verificationCode</b><br><br>Please enter this code to complete your registration.";

				$mail->send();
				echo "<script> alert('Sign Up Successful. A verification code has been sent to your email.');
                			window.location = 'verify-student.php' </script>";
			} catch (Exception $e) {
				echo "Verification email could not be sent. Error: {$mail->ErrorInfo}";
			}
		} else {
			echo "<script>
				  alert('Registration failed. Please try again.');
				  window.location = 'signup-student.php';
				</script>";
		}
	}
}
