<!-- SECURITY -->

<?php

//start and receive data from session
session_start();
$LOGIN = $_SESSION['staff_id'];
	
//check login session
if (!isset($_SESSION['staff_id']) && !isset($_SESSION['student_id']))
{
	//go to this file if not logged in
	header('Location: index.php');
	exit();
}

?>