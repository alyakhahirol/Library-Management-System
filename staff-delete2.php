<?php
require 'connection.php';
//require 'security.php';
	
$IDHAPUS = $_GET['staff_id'];
	
//delete record category
$delete = mysqli_query($con, "DELETE FROM staff WHERE staff_id='$IDHAPUS' ");
	
clearstatcache();
	
//popup mesej if successful
echo "<script> alert ('Record deleted'); window.location = 'staff-manage-ADMIN.php' </script>";

?>