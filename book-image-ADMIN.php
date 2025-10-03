<?php

include "connection.php";
session_start();
include "navbar-admin.php";


//get ISBN
$ISBN = $_GET['ISBN'];

//connect to table book
$dataBook = mysqli_query(
	$con,
	"SELECT * FROM BOOK
	INNER JOIN CATEGORY ON book.category_id=category.category_id
	INNER JOIN AUTHOR ON book.author_id=author.author_id
	WHERE ISBN='$ISBN'"
);

$infoBook = mysqli_fetch_array($dataBook);

//accept ISBN selected
if (isset($_POST['ISBN'])) {
	$ISBN = $_POST['ISBN'];

	//connect to author table
	$dataBook = mysqli_query($con, "SELECT * FROM book WHERE ISBN='$ISBN'");

	$infoBook = mysqli_fetch_array($dataBook);

	// Image file handling
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./book/" . $filename;

	if (move_uploaded_file($tempname, $folder)) {
		$update = mysqli_query($con, "UPDATE book SET filename='$filename' WHERE ISBN='$ISBN'");

		die("<script>alert('Image uploaded');
		window.location.href = 'book-manage-ADMIN.php';</script>");
	} else {
		die("<script>alert('Image upload failed.');
		window.location.href = 'book-manage-ADMIN.php'; </script>");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
</head>

<div class="flex-container">
	<div class="title-container">
		<div>
			<!--back button-->
			<a href="book-edit-ADMIN.php?ISBN=<?php echo $ISBN; ?>" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div class="title-container">
			<h2>EDIT BOOK IMAGE</h2>
		</div>
	</div>

	<div class="form-container">
		<form method='POST' enctype="multipart/form-data">
			<p>ISBN Number</p>
			<input type="text" name="ISBN" value="<?php echo $infoBook['ISBN']; ?>" size="15" maxlength="130" readonly>

			<p>Book Title</p>
			<input type="text" name="title" size="70" value="<?php echo $infoBook['title']; ?>" readonly>

			<p>Current Book Image</p>
			<img src="book/<?php echo $infoBook['filename']; ?>" class="book-image" alt="book image">

			<br><br>
			<p>Choose new image file</p>
			<input type="file" id="uploadfile" name="uploadfile" value="" required />
			<br><br><br>
			<button type='Submit' value='change' class="pinkButton">CHANGE IMAGE</button>
		</form>
	</div>
</div>
<style>


.form-container {
	background-color: #BD61A2;
	padding-bottom: 30px;
}
.pinkButton {
	background-color: #713a61;
	border-radius: 25px;
	transition-duration: 0.4s;
	border: none;
	color: white;
	text-align: center;
	padding: 8px 10px;
	font-family: "Unica One", sans-serif;
	font-weight: 400;
	font-style: normal;
	cursor: pointer;
		width: 900px;
		font-size: 16px;
}

.pinkButton:hover {
	background-color: #974d81;
	color: white;
}
	.book-image {
		width: 200px;
	}
	.form-container {
		width: 1000px;
	}

	.form {
		width: 900px;
	}

	textarea {
		max-width: 900px;
		width: 900px;
		min-width: 900px;
	}

	input[type="file"] {
		padding: 5px 15px;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
		border-radius: 35px;
		font-size: 16px;
		color: white;
		background-color: black;
	}

	input {
		padding: 5px 15px;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
		border-radius: 35px;
		font-size: 16px;
	}

	option,
	select {
		padding: 5px 15px;
		padding-right: 50px;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
		border-radius: 35px;
		font-size: 16px;
	}
</style>

</html>