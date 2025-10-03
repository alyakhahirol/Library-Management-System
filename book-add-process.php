<?php
include "connection.php";


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
		window.location='book-add.php'</script>";
	} else {
		if (move_uploaded_file($tempname, $folder)) {
			$insert = "INSERT INTO book (ISBN, title, category_id, author_id, price, description, filename) VALUES
			('$ISBN', '$title', '$category_id', '$author_id', '$price', '$description', '$filename')";

			$laksana_query = mysqli_query($con, $insert);

			die("<script>alert('Book Registered');
			window.location.href= 'book-manage.php';</script>");
		}
	}
}
