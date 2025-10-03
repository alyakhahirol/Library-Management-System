<?php
require 'connection.php';
require 'security.php';

$ISBN = $_GET['ISBN'];

//delete record author
$softdelete = mysqli_query($con, "DELETE FROM book WHERE ISBN='$ISBN' ");

clearstatcache();

//popup message if successful
echo "<script> alert ('Record deleted'); window.location = 'book-manage-ADMIN.php' </script>";
