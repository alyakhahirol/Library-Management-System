<?php
require 'connection.php';
require 'security.php';

$IDHAPUS = $_GET['author_id'];

//delete record author
$softdelete = mysqli_query($con, "UPDATE author SET is_deleted='1' WHERE author_id='$IDHAPUS' ");

clearstatcache();

//popup message if successful
echo "<script> alert ('Record deleted'); window.location = 'author-manage.php' </script>";