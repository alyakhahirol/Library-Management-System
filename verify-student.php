<?php

include 'connection.php';

session_start();
$student_id = $_SESSION["student_id"];
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/SIGNUP.css">
	<link rel="stylesheet" href="CSS/NAVBAR.css">
	<link rel="stylesheet" href="stars.css">
	<title>Student Verification</title>
</head>

<body>
	<section class="wrapper">
		<div id="stars1"></div>
		<div id="stars2"></div>
		<div id="stars3"></div>
	</section>

	<div class="flex-container">
		<div>
			<h2>VERIFY YOUR ACCOUNT</h2>
		</div>

		<div class="form-container-student">
			<form method='POST' action="verify-student-process.php">
				<p>Verification Code</p>
				<input type='text' name='verification_code' placeholder="Enter the code sent to your email" required><br><br>
				<button type='submit' value='submit' class="purpleButton">VERIFY</button>
			</form>
		</div>
	</div>
</body>
<script>
	// Prevent going back to the previous page
	history.pushState(null, document.title, location.href);
	window.addEventListener('popstate', function(event) {
		history.pushState(null, document.title, location.href);
	});
</script>
<style>
	h2 {
		margin-top: 200px;
	}
</style>

</html>