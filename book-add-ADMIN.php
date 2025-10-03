<?php

include "connection.php";
session_start();
include "navbar-admin.php";


if (isset($_POST['ISBN'])) {
	// Get form data
	$ISBN = $_POST['ISBN'];
	$title = $_POST['title'];
	$category_id = $_POST['category_id'];
	$author_id = $_POST['author_id'];
	$price = $_POST['price'];
	$description = $_POST['description'];

	// Image file handling
	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./book/" . $filename;

	$checkdupSQL = "SELECT * FROM book where ISBN='$ISBN'";
	$result = mysqli_query($con, $checkdupSQL);

	//eror message if author already exists
	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Failed, book already registered');
		window.location='book-add-ADMIN.php'</script>";
	} else {
		if (move_uploaded_file($tempname, $folder)) {
			$insert = "INSERT INTO book (ISBN, title, category_id, author_id, price, description, filename) VALUES
			('$ISBN', '$title', '$category_id', '$author_id', '$price', '$description', '$filename')";

			$laksana_query = mysqli_query($con, $insert);

			die("<script>alert('Book Registered');
			window.location.href= 'book-manage-ADMIN.php';</script>");
		}
	}
}

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
			<a href="book-manage-ADMIN.php" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div class="title-container">
			<h2>ADD BOOK</h2>
		</div>
	</div>

	<div class="form-container">
		<form method='POST' enctype="multipart/form-data">
			<p>ISBN Number</p>
			<input type='text' name='ISBN' placeholder="Without -" size=15 required>

			<p>Book Title</p>
			<input type='text' name='title' placeholder="Enter Book Title" size=60 required>

			<p>Category</p>
			<select name="category_id" required>
				<option value="" disabled selected>Select Category</option>
				<?php
				$select = $con->query("SELECT * FROM category ORDER BY category_name ASC");
				while ($row = $select->fetch_assoc()): ?>
					<option value="<?php echo $row['category_id']; ?>">
						<?php echo $row['category_name']; ?>
					</option>
				<?php endwhile; ?>
			</select>

			<p>Author</p>
			<select name="author_id" required>
				<option value="" disabled selected>Select Author</option>
				<?php
				$select = $con->query("SELECT * FROM author ORDER BY author_name ASC");
				while ($row = $select->fetch_assoc()): ?>
					<option value="<?php echo $row['author_id']; ?>">
						<?php echo $row['author_name']; ?>
					</option>
				<?php endwhile; ?>
			</select>

			<p>Price</p>
			<input type='text' name='price' placeholder="RM" size=15 required>

			<p>Description</p>
			<textarea id="description" name="description" rows="10" required></textarea>

			<br><br>
			<p>Book Image File</p>
			<input type="file" id="uploadfile" name="uploadfile" value="" required />
			<br><br><br>
			<button type='Submit' value='Create' class="pinkButton">ADD BOOK</button>
		</form>
	</div>
</div>
<style>
	.form-container {
		padding-bottom: 30px;
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


	.form-container {
		background-color: #BD61A2;
		padding-bottom: 30px;
	}

	.pinkButton {
		background-color: #713a61;
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
		width: 900px;
		font-size: 16px;
	}

	.pinkButton:hover {
		background-color: #974d81;
		color: white;
	}
</style>
</style>

</html>