<?php
session_start();
include "connection.php";
include 'navbar-index.php';

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="CSS/SIGNUP.css">
</head>

<body>
<div class="flex-container">
	<div>
		<h2>STUDENT SIGN UP</h2>
	</div>

	<div class="form-container-student">
		<form method='POST' action="signup-student-process.php">
			<p>Student ID</p>
			<input type='text' name='student_id' placeholder="Enter Your Matrix Number" autofocus required><br><br>
			
			<p>Full Name</p>
			<input type='text' name='name' placeholder="Enter Your Full Name" required><br><br>
			
			<p>Student Email</p>  
			<input type='text' name='student_email' placeholder="Enter Your Email" required><br><br>
			
			<p>Faculty</p>         
			<input type='text' name='faculty' placeholder="Enter Your Faculty Name" required><br><br>
			
			<p>Password</p>        
			<input type='password'  name='password' placeholder="********" required>
			
			<p>Gender:</p>
			<input type="radio" id="F" name="gender" value="F">
			<label for="F">F</label><br>
			<input type="radio" id="M" name="gender" value="M">
			<label for="M">M</label><br>

			<p>Phone Number</p>    
			<input type='tel' name='phone_number' placeholder="01X-XXXXXXXX" required><br><br>
			
			
			<p>Date Of Birth</p>
			<input type='date' name='date_of_birth' placeholder="DD/MM/YYYY" required>
			
			<br><br><br>
			<div>
				<button type ='submit' value='submit' class="purpleButton">SIGN UP</button>
			</div>

			<p>Already have an account? <u><a href="login-student.php">Log In</a></u></p>
		</form>
	</div>
</div>
</body>
</html>