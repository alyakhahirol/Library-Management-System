<?php
require 'connection.php';
//require 'security.php';
	
$IDHAPUS = $_GET['category_id'];
	
//delete record category
$delete = mysqli_query($con, "DELETE FROM category WHERE category_id='$IDHAPUS' ");
	
clearstatcache();
	
//popup mesej if successful
echo "<script> alert ('Record deleted'); window.location = 'category-manage-ADMIN.php' </script>";

?>