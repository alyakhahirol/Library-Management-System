<?php
require 'connection.php';
//require 'security.php';
	
$IDRESTORE = $_GET['author_id'];
	
//restore record author
$restore = mysqli_query($con, "UPDATE author SET is_deleted='0' WHERE author_id=$IDRESTORE ");
	
//popup mesej if successful
echo "<script> alert ('Record is restored'); window.location = 'author-manage-ADMIN.php' </script>";

?>