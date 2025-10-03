<?php

include "connection.php";
include "navbar-staff.php";


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

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
</head>

<div class="flex-container">
	<div class="title-container">
		<div>
			<!--back button-->
			<a href="book-edit.php?ISBN=<?php echo $ISBN; ?>" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div class="title-container">
			<h2>EDIT BOOK IMAGE</h2>
		</div>
	</div>

	<div class="form-container">
		<form action='book-image-process.php' method='POST' enctype="multipart/form-data">
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
			<button type='Submit' value='change' class="blueButton">CHANGE IMAGE</button>
		</form>
	</div>
</div>
<style>
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

	.blueButton {
		width: 900px;
		height: 40px;
		font-size: 16px;
	}
</style>

</html>