<?php

include "connection.php";
session_start();
include "navbar-admin.php";

if (isset($_POST['category_name']))
{
	//get category name
	$category_name = $_POST['category_name'];
		
	//check if duplicate
	$checkdupSQL = "SELECT * FROM category where category_name='$category_name'";

	$result = mysqli_query($con, $checkdupSQL);

	//eror message if category already exists
	if(mysqli_num_rows($result) > 0)
	{
		echo "<script>alert('Failed, category already registered');
		window.location='category-add-ADMIN.php'</script>";
	}
	else
	{
		//insert record into table
		$insertData = "INSERT INTO category (category_name) VALUES ('$category_name')";
		$data = mysqli_query($con, $insertData);
		echo "<script>alert('Successful!');
		window.location='category-manage-ADMIN.php'</script>";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
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

		<div class="title-container">
			<h2>ADD CATEGORY</h2>
		</div>
	</div>

	<div class="form-container">
		<form method='POST'>
			<p>Category Name</p>
			<input type='text' name='category_name' placeholder="Enter Category Name" size=40 autofocus required>

			<div class="button-container">
				<button type ='submit' value='submit' class="pinkButton">CREATE</button>
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
