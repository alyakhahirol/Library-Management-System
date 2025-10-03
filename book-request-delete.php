<?php
require 'connection.php';
require 'security.php';

$suggestion_id = $_GET['suggestion_id'];

$delete = mysqli_query($con, "DELETE FROM suggestion WHERE suggestion_id='$suggestion_id' ");

clearstatcache();

echo "<script> alert ('Request dismissed.'); window.location = 'book-request-ADMIN.php' </script>";
