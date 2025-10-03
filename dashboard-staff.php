<?php
require 'connection.php';
include 'navbar-staff.php';

#call all table
$data1 = mysqli_query ($con, "SELECT * FROM STUDENT");
$info1 = mysqli_num_rows($data1); #count number of row (data)
$data2 = mysqli_query ($con, "SELECT * FROM BOOK");
$info2 = mysqli_num_rows($data2);
$data3 = mysqli_query ($con, "SELECT * FROM AUTHOR");
$info3 = mysqli_num_rows($data3);
$data4 = mysqli_query ($con, "SELECT * FROM CATEGORY");
$info4 = mysqli_num_rows($data4);
$data5 = mysqli_query ($con, "SELECT * FROM ISSUE");
$info5 = mysqli_num_rows($data5);
$data6 = mysqli_query ($con, "SELECT * FROM ISSUE WHERE return_status='1' ");
$info6 = mysqli_num_rows($data6);
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/DASHBOARD-STAFF.css">
</head>

<body>
<h2>DASHBOARD</h2>

<div class="flex-container">
      <div>
            <div class="text">
                  <a href="student-manage.php">
                        <img src="icon/registered-user.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info1; ?></div>
            <div>Registered Students</div>
      </div>
      <div>
            <div class="text">
                  <a href="book-manage.php">
                        <img src="icon/book-listed.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info2; ?></div>
            <div>Book Listed</div>
      </div>
      <div>
            <div class="text">
                  <a href="author-manage.php">
                        <img src="icon/author-listed.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info3; ?></div>
            <div>Authors Listed</div>
      </div>
</div>

<div class="flex-container">
      <div>
            <div class="text">
                  <a href="category-manage.php">
                        <img src="icon/category-listed.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info4; ?></div>
            <div>Listed Categories</div>
      </div>
      <div>
            <div class="text">
                  <a href="issue-manage.php">
                        <img src="icon/book-issued.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info5; ?></div>
            <div>Times Book Issued</div>
      </div>
      <div>
            <div class="text">
                  <a href="issue-manage.php">
                        <img src="icon/book-returned.png" class="image">
                  </a>
            </div>
            <div class="text"><?php echo $info6; ?></div>
            <div>Times Book Returned</div>
      </div>
</div>

</body>

<style> 

.flex-container > div {
      background-color: #646EC6;
}

</style>
</html>