<?php

include "connection.php";
include "navbar-staff.php";

if (isset($_POST['author_name'])) {
	//get author_name
	$author_name = $_POST['author_name'];

	//check if duplicate
	$checkdupSQL = "SELECT * FROM author where author_name='$author_name'";

	$result = mysqli_query($con, $checkdupSQL);

	//eror message if author already exists
	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Failed, author already registered');
		window.location='author-add.php'</script>";
	} else {
		//insert record into table
		$insertData = "INSERT INTO author (author_name) VALUES ('$author_name')";
		$data = mysqli_query($con, $insertData);
		echo "<script>alert('Successful!');
		window.location='author-manage.php'</script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
</head>

<body>
	<div class="flex-container">
		<div class="title-container">
			<div>
				<!--back button-->
				<a href="author-manage.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div class="title-container">
				<h2>ADD AUTHOR</h2>
			</div>
		</div>

		<div class="form-container">
			<form method='POST'>
				<p>Author Name</p>
				<input type='text' name='author_name' placeholder="Enter Author Name" size=40 autofocus required>

				<div class="button-container">
					<button type='submit' value='submit' class="blueButton">CREATE</button>
				</div>
			</form>
		</div>
	</div>
</body>

<style> 

.form-container {
	padding-bottom: 30px;
}
.blueButton {
	background-color: #272E6A;
	border-radius: 25px;
	transition-duration: 0.4s;
	border: none;
	width: 430px;
	color: white;
	text-align: center;
	padding: 8px 10px;
	font-family: "Unica One", sans-serif;
	font-weight: 400;
	font-style: normal;
	cursor: pointer;
	font-size: 16px;
}

.blueButton:hover {
	background-color: #3C46A2;
	color: white;
}

</style>
</html>