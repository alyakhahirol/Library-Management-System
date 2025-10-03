<?php

require 'connection.php';
include "navbar-staff.php";


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
	window.location = 'author-manage.php' </script>";
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

</html>