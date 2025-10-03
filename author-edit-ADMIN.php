<?php

require 'connection.php';
session_start();
include 'navbar-admin.php';

//get author_id
$IDAUTHOR = $_GET['author_id'];

//connect to author table
$dataAuthor = mysqli_query($con, "SELECT * FROM author WHERE author_id='$IDAUTHOR'");

$infoAuthor = mysqli_fetch_array($dataAuthor);

//accept author_id selected
if (isset($_POST['hantar'])) {
	$author_id = $_POST['author_id'];
	$author_name = $_POST['author_name'];

	//update author table
	$result1 = mysqli_query($con, "UPDATE author SET author_id='$author_id', author_name='$author_name' WHERE author_id='$author_id'");

	//popup message
	echo "<script> alert ('Edit successful!');
	window.location = 'author-manage-ADMIN.php' </script>";
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
				<a href="author-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>EDIT AUTHOR</h2>
			</div>
		</div>

		<div class="form-container">
			<form method="POST">
				<p>Author ID</p>
				<input type="text" name="author_id" value="<?php echo $infoAuthor['author_id']; ?>" readonly>

				<p>Author Name</p>
				<input type="text" name="author_name" size="45" value="<?php echo $infoAuthor['author_name']; ?>" autofocus>

				<!--buttons-->
				<div class="button-container">
					<button name="hantar" type="submit" class="greenButton">SAVE</button>
					<button type="reset" class="redButton">RESET</button>
				</div>
			</form>
		</div>
	</div>
</body>

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