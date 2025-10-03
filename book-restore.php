<?php
require 'connection.php';
//require 'security.php';
	
$IDRESTORE = $_GET['ISBN'];
	
//restore record
$restore = mysqli_query($con, "UPDATE book SET is_deleted=0 WHERE ISBN=$IDRESTORE ");
	
//popup mesej if successful
echo "<script> alert ('Record is restored');
window.location = 'book-manage-ADMIN.php' </script>";

?>