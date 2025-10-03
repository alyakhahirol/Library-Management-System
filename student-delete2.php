<?php
require 'connection.php';
//require 'security.php';
	
$IDHAPUS = $_GET['student_id'];
	
//delete record category
$delete = mysqli_query($con, "DELETE FROM student WHERE student_id='$IDHAPUS' ");
	
clearstatcache();
	
//popup mesej if successful
echo "<script> alert ('Record deleted'); window.location = 'student-manage-ADMIN.php' </script>";

?>