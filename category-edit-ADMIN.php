<?php

require 'connection.php';
session_start();
include 'navbar-admin.php';

//get category_id
$IDCATEGORY = $_GET['category_id'];

//connect to category table
$dataCategory = mysqli_query($con, "SELECT * FROM category WHERE category_id='$IDCATEGORY'");

$infoCategory = mysqli_fetch_array($dataCategory);

//accept category_id selected
if (isset($_POST['hantar'])) {
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];

	//update category table
	$result1 = mysqli_query($con, "UPDATE category SET category_id='$category_id', category_name='$category_name' WHERE category_id='$category_id'");

	//popup message
	echo "<script> alert ('Edit successful!');
	window.location = 'category-manage-ADMIN.php' </script>";
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
				<a href="category-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>EDIT CATEGORY</h2>
			</div>
		</div>

		<div class="form-container">
			<form method="POST">
				<p>Category ID</p>
				<input type="text" name="category_id" value="<?php echo $infoCategory['category_id']; ?>" readonly>

				<p>Category Name</p>
				<input type="text" name="category_name" size="45" value="<?php echo $infoCategory['category_name']; ?>" autofocus>

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

</style>
</html>