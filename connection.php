<!--CONNECTION-->

<?php

//connect to mysqli $con
$con = mysqli_connect("localhost", "root", "", "thebookhaven");
	
//check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}

?>

<html>
	<head>
		<!--font-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Unica+One&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Unica+One&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Overpass+Mono:wght@300..700&display=swap" rel="stylesheet">
		<!--title and icon on windows tab-->
		<title>Book Haven Library</title>
		<link rel="icon" type="image" href="icon/book-icon.png">
  	</head>
</html>