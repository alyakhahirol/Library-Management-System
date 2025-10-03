<?php

session_start();
$staff_id = $_SESSION["staff_id"];

include "connection.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Accept POST value
if (isset($_POST['verify'])) {
	$staff_id = $_SESSION['staff_id'];
	$data = "SELECT * FROM staff WHERE staff_id='$staff_id'";
	$info = mysqli_query($con, $data);

	// Fetch the row as an associative array
	if ($info && $row = mysqli_fetch_assoc($info)) {
		// Generate a 6-digit verification code
		$verificationCode = rand(100000, 999999);
		$update = mysqli_query($con, "UPDATE staff SET verification_code='$verificationCode' WHERE staff_id='$staff_id' ");

		$mail = new PHPMailer(true);
		try {
			// Server settings
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com'; // SMTP server
			$mail->SMTPAuth   = true;
			$mail->Username   = 'miku.alya@gmail.com'; // Email
			$mail->Password   = 'zjdc wypu tuxs gupd'; // Email password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;

			// Recipients
			$mail->setFrom('miku.alya@gmail.com', 'Book Haven');
			$mail->addAddress($row['staff_email']); // Use the fetched email

			// Content
			$mail->isHTML(true);
			$mail->Subject = 'Password Change';
			$mail->Body    = "Dear " . $row['name'] . ",<br><br>Your verification code is: <b>$verificationCode</b><br><br>Please enter this code to confirm changing your password.";

			$mail->send();
			echo "<script> alert('Request sent. A verification code has been sent to your email.');
                			window.location = 'email-verify-staff.php' </script>";
		} catch (Exception $e) {
			echo "Verification email could not be sent. Error: {$mail->ErrorInfo}";
		}
	} else {
		echo "Staff information not found.";
	}
}
?>
