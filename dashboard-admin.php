<?php

session_start();

require 'connection.php';
include 'navbar-admin.php';

#call all table
$data1 = mysqli_query($con, "SELECT * FROM STUDENT");
$info1 = mysqli_num_rows($data1); #count number of row (data)
$data2 = mysqli_query($con, "SELECT * FROM BOOK");
$info2 = mysqli_num_rows($data2);
$data3 = mysqli_query($con, "SELECT * FROM AUTHOR");
$info3 = mysqli_num_rows($data3);
$data4 = mysqli_query($con, "SELECT * FROM CATEGORY");
$info4 = mysqli_num_rows($data4);
$data5 = mysqli_query($con, "SELECT * FROM ISSUE");
$info5 = mysqli_num_rows($data5);
$data6 = mysqli_query($con, "SELECT * FROM ISSUE WHERE return_status='1' ");
$info6 = mysqli_num_rows($data6);
$data7 = mysqli_query($con, "SELECT * FROM STAFF");
$info7 = mysqli_num_rows($data7);
$data8 = mysqli_query($con, "SELECT * FROM SUGGESTION");
$info8 = mysqli_num_rows($data8);
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css" />
	<link rel="stylesheet" href="CSS/DASHBOARD-STAFF.css">
</head>

<body>
	<div>
		<h2>DASHBOARD</h2>
	</div>

	<div class="flex-container">
		<div>
			<div class="text">
				<a href="staff-manage-ADMIN.php">
					<img src="icon/staff.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info7; ?></div>
			<div>Registered Staffs</div>
		</div>
		<div>
			<div class="text">
				<a href="student-manage-ADMIN.php">
					<img src="icon/registered-user.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info1; ?></div>
			<div>Registered Students</div>
		</div>
		<div>
			<div class="text">
				<a href="issue-manage-ADMIN.php">
					<img src="icon/book-issued.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info5; ?></div>
			<div>Times Book Issued</div>
		</div>

		<div>
			<div class="text">
				<a href="issue-manage-ADMIN.php">
					<img src="icon/book-returned.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info6; ?></div>
			<div>Times Book Returned</div>
		</div>
	</div>

	<div class="flex-container">
		<div>
			<div class="text">
				<a href="category-manage-ADMIN.php">
					<img src="icon/category-listed.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info4; ?></div>
			<div>Listed Categories</div>
		</div>

		<div>
			<div class="text">
				<a href="author-manage-ADMIN.php">
					<img src="icon/author-listed.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info3; ?></div>
			<div>Authors Listed</div>
		</div>

		<div>
			<div class="text">
				<a href="book-manage-ADMIN.php">
					<img src="icon/book-listed.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info2; ?></div>
			<div>Books Listed</div>
		</div>

		<div>
			<div class="text">
				<a href="book-request-ADMIN.php">
					<img src="icon/request.png" class="image">
				</a>
			</div>
			<div class="text"><?php echo $info8; ?></div>
			<div>Requests</div>
		</div>
	</div>

</body>

<style>
	.flex-container>div {
		background-color: #BD61A2;
	}

	.redButton {
		background-color: #B33A3A;
	}

	.greenButton {
		background-color: #2E8967;
	}

	.blueButton {
		background-color: #4B4F9F;
		border-radius: 25px;
		transition-duration: 0.4s;
		border: none;
		width: 80px;
		color: white;
		text-align: center;
		padding: 5px 10px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		cursor: pointer;
		font-size: 16px;
	}

	.blueButton:hover {
		background-color: #531d62;
		color: white;
	}


	table {
		background: #BD61A2;
	}

	tr:hover {
		background-color: #974d81;
	}
</style>

</html>