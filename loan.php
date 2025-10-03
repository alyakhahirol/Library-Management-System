<?php

include "connection.php";
include 'navbar-student.php';

$STUDENTID = $_SESSION['student_id'];
$ISBN = $_GET['ISBN'];

date_default_timezone_set('Asia/Kuala_Lumpur');

$queryBook = "SELECT BOOK.filename, BOOK.title, BOOK.ISBN, AUTHOR.author_name
    	FROM BOOK
    	JOIN AUTHOR ON BOOK.author_id= AUTHOR.author_id
    	WHERE ISBN='$ISBN' ";
$dataBook = mysqli_query($con, $queryBook);

// Set the checkout date
$checkoutDate = date('d-m-Y h:i:s');

// Calculate the due date by adding 14 days
$dueDate = date('d-m-Y 23:59:59', strtotime($checkoutDate . ' +14 days'));

$info = mysqli_fetch_array($dataBook);
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/book-detail.css">
</head>

<body>
	<div class="content-container">
		<!-- Text Section -->
		<div>
			<h2><?php echo $info['title']; ?></h2>
		</div>

		<!-- Image Section -->
		<div>
			<h3>Author: <?php echo $info['author_name']; ?></h3>
		</div>

		<div>
			<img src="book/<?php echo $info['filename']; ?>" alt="Book Image">
		</div>

		<div class="date-container">
			<!-- Checkout Date -->
			<div class="date-box">
				<div>
					<p><strong>Check out date:</strong>
				</div>
				<div class="timestamp-container">
					<?php echo $checkoutDate; ?>
				</div>
			</div>

			<!-- Due Date -->
			<div class="date-box">
				<div>
					<p><strong>Due date:</strong></p>
				</div>
				<div class="timestamp-container">
					<?php echo $dueDate; ?>
				</div>
			</div>
		</div>

		<!-- Button Section -->
		<div class="button-container">
			<!-- Check Out Button -->
			<div>
				<a href="loan-successful.php?ISBN=<?php echo $info['ISBN']; ?>">
					<button class="greenButton">CHECK OUT</button>
			</div>

			<!-- Cancel Button -->
			<div>
				<a href="catalogue.php">
					<button class="redButton" onclick="history.back()">CANCEL</button>
				</a>
			</div>
		</div>
	</div>
</body>

<style>
	.center {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.popup {
		width: 350px;
		height: 280px;
		padding: 30px 20px;
		background: #f5f5f5;
		border-radius: 10px;
		box-sizing: border-box;
		z-index: 200;
		text-align: center;
		opacity: 0;
		top: -200%;
		transform: translate(-50%, -50%) scale(0.5);
		transition: opacity 300ms ease-in-out,
			top 1000ms ease-in-out,
			transform 1000ms ease-in-out;
	}

	.popup.active {
		opacity: 1;
		top: 50%;
		transform: translate(-50%, -50%) scale(1);
		transition: transform 300ms cubic-bezier(0, 18, 0, 89, 0.43, 1, 19);
	}

	.popup.icon {
		margin: 5px 0px;
		width: 50px;
		height: 50px;
		border: 2px solid #34f234;
		text-align: center;
		display: inline-block;
		border-radius: 50%;
		line-height: 60px;
	}

	.popup .icon i.fa {
		font-size: 30px;
		color: #34f234;
	}

	.popup .title {
		margin: 5px 0px;
		font-size: 30px;
		font-weight: 600;
	}

	.popup .description {
		color: 222;
		font-size: 15px;
		padding: 5px;
	}

	.popup .dismiss-btn {
		margin-top: 15px;
	}

	.popup .dismiss-btn button {
		padding: 10px 20px;
		background: #111;
		color: #f5f5f5;
		border: 2px solid #111;
		font-size: 16px;
		font-weight: 600;
		outline: none;
		border-radius: 10px;
		cursor: pointer;
		transition: all 300ms ease-in-out;
	}

	.popup .dismiss-btn button:hover {
		color: #111;
		background: #f5f5f5;
	}

	.popup>div {
		position: relative;
		top: 10px;
		opacity: 0;
	}

	.popup.active>div {
		top: 0px;
		opacity: 1;
	}

	.popup.active.icon {
		transition: all 300ms ease-in-out 250ms;
	}

	.popup.active.title {
		transition: all 300ms ease-in-out 300ms;
	}

	.popup.active.description {
		transition: all 300ms ease-in-out 350ms;
	}

	.popup.active.dismiss-btn {
		transition: all 300ms ease-in-out 400ms;
	}

	h2 {
		margin-bottom: 10px;
	}

	h3 {
		font-size: 20px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		text-transform: uppercase;
		margin-top: 0px;
	}

	.timestamp-container {
		display: flex;
		align-items: center;
		width: 180px;
		height: 35px;
		color: black;
		border: solid 2px #FFFFFF;
		background-color: #FFFFFF;
		text-align: left;
		padding-left: 10px;
	}

	.check-image {
		width: 100px;
	}





	body {
		background-color: #090830;
		font-family: "Overpass Mono", monospace;
	}

	.content-container {
		display: flex;
		margin-top: 60px;
		margin-left: 100px;
		margin-right: 100px;
		align-items: center;
		flex-direction: column;

	}

	.content-container h1 {
		font-family: "Overpass Mono", monospace;
	}

	.content-container img {
		width: 280px;
		height: 322px;

	}

	.date-container {
		margin-top: 20px;
		display: flex;
		flex-direction: column;

	}

	.timestamp-container {
		display: flex;
		color: #000000;
		border: solid 2px #FFFFFF;
		background-color: #FFFFFF;

	}

	.date-box {
		display: flex;
		align-items: center;
		flex-direction: row;
		justify-content: space-between;
		width: 370px;
	}

	.date-box>div {
		display: flex;
		align-items: center;
		flex-direction: row;
	}

	.box-contaniner {
		display: flex;

	}

	.button-container {
		display: flex;
		margin-top: 20px;
		justify-content: space-between;
	}

	.button-container>div {
		display: flex;
		margin: 10px;
	}

	.redButton {
		background-color: #BE5858;
		border-radius: 25px;
		transition-duration: 0.4s;
		border: 2px solid #BE5858;
		width: 170px;
		height: 50px;
		color: white;
		text-align: center;
		padding: 5px 10px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		cursor: pointer;
		font-size: 16px;
	}

	.redButton:hover {
		background-color: #984646;
		color: white;
	}

	.greenButton {
		background-color: #6A9C89;
		border-radius: 25px;
		transition-duration: 0.4s;
		border: 2px solid #6A9C89;
		width: 170px;
		height: 50px;

		color: white;
		text-align: center;
		padding: 5px 10px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		font-size: 16px;

		cursor: pointer;
	}

	.greenButton:hover {
		background-color: #547c6d;
		color: white;
	}
</style>

</html>