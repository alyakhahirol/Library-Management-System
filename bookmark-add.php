<?php

include "connection.php";
session_start();

$student_id = $_SESSION['student_id'];
$ISBN = $_GET['ISBN'];

$checkdupSQL = "SELECT * FROM bookmark WHERE student_id='$student_id' AND ISBN='$ISBN'";

$result = mysqli_query($con, $checkdupSQL);

//eror message if book already bookmarked
if(mysqli_num_rows($result) > 0)
{
	echo "<script>alert('Book is already bookmarked.');
	history.back(); </script>";
}
else
{
	//insert record into table
	$insertData = "INSERT INTO bookmark (ISBN, student_id) VALUES ('$ISBN', '$student_id')";
	$data = mysqli_query($con, $insertData);

	echo "<script>alert('Bookmark added!');
	history.back(); </script>";
}

?>