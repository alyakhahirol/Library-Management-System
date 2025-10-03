<?php
require 'connection.php';
session_start();
include 'navbar-admin.php';

// Set timezone to Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');

$IDISSUE = $_GET['issue_id'];

$dataIssue = mysqli_query($con, "SELECT * FROM issue 
                              INNER JOIN student ON issue.student_id = student.student_id 
					INNER JOIN book ON issue.ISBN = book.ISBN 
					WHERE issue.issue_id='$IDISSUE'");

$infoIssue = mysqli_fetch_array($dataIssue);

//get current date
$current_date = new DateTime();

//get due_date from database
$due_date = new DateTime($infoIssue['due_date']);

$late_days = 0;

//check if student return book early
if ($current_date < $due_date) {
	$fine = 0;
} else { //student return book late
	$late_days = date_diff(($current_date)->setTime(0, 0), ($due_date)->setTime(0, 0))->days;
	$fine = $late_days * 1; //calculate fine
}

//update in database
if (isset($_POST['submit'])) {
	$update = mysqli_query($con, "UPDATE issue SET return_status='1' WHERE issue_id='$IDISSUE'");

	//popup message
	echo "<script> alert ('Book return confirmed with a fine of RM$fine.');
	window.location = 'issue-manage-ADMIN.php' </script>";
}
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/edit.css">
</head>

<body>
	<div class="flex-container">
		<div class="title-container">
			<div>
				<!--back button-->
				<a href="issue-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>CONFIRM BOOK RETURN</h2>
			</div>
		</div>

		<div class="form-container">
			<div>
				<img src="book/<?php echo $infoIssue['filename']; ?>" class="bookImage" alt="book image">
			</div>
			<div>
				<form method="POST">
					<p>Issue ID</p>
					<input type="text" value="<?php echo $infoIssue['issue_id']; ?>" size=4 readonly>

					<p>ISBN</p>
					<input type="text" value="<?php echo $infoIssue['ISBN']; ?>" size=15 readonly>
					
					<p>Book Title</p>
					<input type="text" value="<?php echo $infoIssue['title']; ?>" size=50 readonly>

					<p>Student Name</p>
					<input type="text" value="<?php echo $infoIssue['name']; ?>" size=50 readonly>

					<br><br><br>
					<p class="lefttext">Issue Date</p>
					<input class="lefttext" type="timestamp" value="<?php echo $infoIssue['issued_date']; ?>" size=20 readonly>

					<p class="lefttext">Due Date</p>
					<input class="lefttext" type="timestamp" value="<?php echo $infoIssue['due_date']; ?>" size=20 readonly>

					<p class="lefttext">Days Late</p>
					<input class="lefttext" type="text" value="<?php echo $late_days; ?>" size="3" readonly>

					<p class="lefttext">Calculated Fine</p>
					<input class="lefttext" type="text" value="RM <?php echo $fine; ?>" size="7" readonly>

					<br><br>
					<!-- Confirmation Button -->
					<button name="submit" type="submit" class="pinkButton lefttext changeButton">CONFIRM RETURN</button>
				</form>
			</div>
		</div>
	</div>
</body>

<style>
	.greenButton {
		width: 875px;
	}

	.changeButton {
		height: 35px;
		border: none;
		background-color: #272E6A;
		font-size: 16px;
	}

	.changeButton:hover {
		background-color: #3C46A2;
	}

	.lefttext{
		margin-left: -350px;
	}

	.bookImage {
		width: 300px;
		height: 375px;
	}

	.form-container {
		width: 60%;
		padding-top: 40px;
		flex-direction: row;
		justify-content: flex-start;
		align-items: flex-start;
		padding-left: 90px;
		padding-bottom: 50px;
	}

	.form-container>div {
		display: flex;
		margin-right: 50px;
	}

	input[type=text] {
		padding-right: 15px;
		padding-left: 15px;
	}

	input[type=timestamp] {
		padding: 5px 15px;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
		border-radius: 35px;
		font-size: 16px;
	}

	input:read-only {
		background-color: lightgray;
	}


.form-container {
	background-color: #BD61A2;
	padding-bottom: 30px;
}
.pinkButton {
	background-color: #713a61;
	border-radius: 25px;
	transition-duration: 0.4s;
	border: none;
	color: white;
	text-align: center;
	padding: 8px 10px;
	font-family: "Unica One", sans-serif;
	font-weight: 400;
	font-style: normal;
	cursor: pointer;
	font-size: 16px;
		width: 875px;
}

.pinkButton:hover {
	background-color: #974d81;
	color: white;
}
</style>

</html>