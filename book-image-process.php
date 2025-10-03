<?php

include "connection.php";

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
		window.location.href = 'book-manage.php';</script>");
	} else {
		die("<script>alert('Image upload failed.');
		window.location.href = 'book-manage.php'; </script>");
	}
}
