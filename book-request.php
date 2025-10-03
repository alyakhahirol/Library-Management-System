<?php

include "connection.php";
include "navbar-student.php";

$STUDENTID = $_SESSION['student_id'];

if (isset($_POST['author_name'])) {
	$author_name = $_POST['author_name'];
	$book_title = $_POST['book_title'];

	//insert record into table
	$insertData = "INSERT INTO suggestion (student_id, book_title, author_name) VALUES ('$STUDENTID', '$book_title', '$author_name')";
	$data = mysqli_query($con, $insertData);
	echo "<script>alert('Book request has been sent!');</script>";
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
			<div class="title-container">
				<h2>BOOK REQUEST</h2>
			</div>
		</div>

		<div class="form-container">
			<form method='POST'>
				<p>Book Title</p>
				<input type='text' name='book_title' placeholder="Enter Book Title" size=40 autofocus required>
				
				<p>Author Name</p>
				<input type='text' name='author_name' placeholder="Enter Author Name" size=40 required>
				
				<div class="button-container">
					<button type='submit' value='submit' class="purpleButton">SEND REQUEST</button>
				</div>
			</form>
		</div>
	</div>
</body>

<style> 

.form-container {
	padding-bottom: 30px;
	background-color: #A83AC4;
}
.purpleButton {
	background-color: #531d62;
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

.purpleButton:hover {
	background-color: #752989;
	color: white;
}

</style>
</html>