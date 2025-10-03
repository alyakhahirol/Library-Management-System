<?php

require 'connection.php';
session_start();
include 'navbar-admin.php';

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
if (isset($_POST['hantar'])) {
	$title = $_POST['title'];
	$category_id = $_POST['category_id'];
	$author_id = $_POST['author_id'];
	$price = $_POST['price'];
	$description = $_POST['description'];

	//update book table
	$result1 = mysqli_query($con, "UPDATE book SET
	title='$title', category_id='$category_id', author_id='$author_id',
	price='$price', description='$description'
	WHERE ISBN='$ISBN'");

	//popup message
	echo "<script> alert ('Edit successful');
	window.location = 'book-manage-ADMIN.php' </script>";
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
				<a href="book-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>BOOK EDIT</h2>
			</div>
		</div>

		<div class="form-container">
			<div>
				<img src="book/<?php echo $infoBook['filename']; ?>" class="bookImage" alt="book image">
			</div>

			<div>
				<form method="POST">
					<p>ISBN</p>
					<input type="text" name="ISBN" value="<?php echo $infoBook['ISBN']; ?>" size="15" maxlength="130" readonly>

					<p>Title</p>
					<input type="text" name="title" size="70" value="<?php echo $infoBook['title']; ?>" autofocus>

					<p>Category</p>
					<select name="category_id">
						<option value="<?php echo $infoBook['category_id']; ?>" selected><?php echo $infoBook['category_name']; ?></option>
						<?php
						$select = $con->query("SELECT * FROM category ORDER BY category_name ASC");
						while ($row = $select->fetch_assoc()): ?>
							<option value="<?php echo $row['category_id']; ?>">
								<?php echo $row['category_name']; ?>
							</option>
						<?php endwhile; ?>
					</select>

					<p>Author</p>
					<select name="author_id">
						<option value="<?php echo $infoBook['author_id']; ?>" selected><?php echo $infoBook['author_name']; ?></option>
						<?php
						$select = $con->query("SELECT * FROM author ORDER BY author_name ASC");
						while ($row = $select->fetch_assoc()): ?>
							<option value="<?php echo $row['author_id']; ?>">
								<?php echo $row['author_name']; ?>
							</option>
						<?php endwhile; ?>
					</select>

					<p>Price</p>
					<input type="text" name="price" size="10" value="<?php echo $infoBook['price']; ?>">
					
					<!--change image button-->

					<p class="lefttext">Description</p>
					<textarea id="description" name="description" rows="15" col="10"><?php echo $infoBook['description']; ?></textarea>

					<br><br>

					<!--buttons-->
					<div class="button-container">
						<button name="hantar" type="submit" class="greenButton">SAVE</button>
						<button type="reset" class="redButton">RESET</button>
					</div>
				</form>
			</div>
		</div>

		<a href="book-image-ADMIN.php?ISBN=<?php echo $infoBook['ISBN']; ?>">
			<button type="submit" name="change" class="greenButton changeButton">CHANGE IMAGE</button>
		</a>
	</div>

	
</body>

<style>
	.button-container {
		margin-left: -350px;
	}

	.button-container button {
		margin-right: 20px;
	}
	.bookImage {
		width: 300px;
	}

	.form-container {
		width: 80%;
	}

	textarea {
		max-width: 1150;
		width: 1150;
		min-width: 1150;
		margin-left: -350px;
	}

	.lefttext {
		margin-left: -350px;
		margin-top: 70px;
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
		padding-top: 40px;
		flex-direction: row;
		justify-content: flex-start;
		align-items: flex-start;
		padding-left: 90px;
		padding-bottom: 50px;

	}

	.form-container > div {
		display: flex;
		margin-right: 50px;
	}

	.greenButton, .redButton {
		width: 250px;
		height: 35px;
		font-size: 16px;
	}
	
	.changeButton {
		width: 300px;
		margin-left: -570px;
		margin-top: -460px;
		background-color: #272E6A;
		border: none;
	}

	.changeButton:hover {
		background-color: #3C46A2;
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
	font-size: 16px;
}

.pinkButton:hover {
	background-color: #974d81;
	color: white;
}
</style>

</html>