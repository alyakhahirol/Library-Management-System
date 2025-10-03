<?php
require 'connection.php';
require 'security.php';

$IDHAPUS = $_GET['author_id'];

//delete record author
$delete1 = mysqli_query($con, "DELETE FROM author WHERE author_id='$IDHAPUS' ");

clearstatcache();

//popup message if successful
echo "<script> alert ('Record deleted'); window.location = 'author-manage-ADMIN.php' </script>";
