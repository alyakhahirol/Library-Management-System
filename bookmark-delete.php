<?php
require 'connection.php';

$IDHAPUS = $_GET['bookmark_id'];
	
//delete record category
$delete = mysqli_query($con, "DELETE FROM bookmark WHERE bookmark_id='$IDHAPUS'");
	
clearstatcache();
	
//popup mesej if successful
echo "<script> alert ('Bookmark removed.');
window.location = 'bookmark.php' </script>";

?>