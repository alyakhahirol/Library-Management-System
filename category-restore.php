<?php
require 'connection.php';
//require 'security.php';
	
$IDRESTORE = $_GET['category_id'];
	
//restore record category
$restore = mysqli_query($con, "UPDATE category SET is_deleted='0' WHERE category_id=$IDRESTORE ");
	
//popup mesej if successful
echo "<script> alert ('Record is restored'); window.location = 'category-manage-ADMIN.php' </script>";

?>