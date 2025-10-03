<?php
require 'connection.php';
//require 'security.php';
	
$IDHAPUS = $_GET['category_id'];
	
//delete record category
$softdelete = mysqli_query($con, "UPDATE category SET is_deleted='1' WHERE category_id='$IDHAPUS' ");
	
clearstatcache();
	
//popup mesej if successful
echo "<script> alert ('Record deleted'); window.location = 'category-manage.php' </script>";

?>