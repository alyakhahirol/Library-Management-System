<?php

include "connection.php";
session_start();
include "navbar-admin.php";

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
</head>

<body>
	<div class="manage-box">
		<div>
			<h2>BOOK REQUEST(S)</h2>
		</div>
	</div>
	<div class="table-container">
		<table>
			<tr>
				<!--table header-->
				<th class="th-center">#</th>
				<th>STUDENT ID</th>
				<th>STUDENT NAME</th>
				<th>BOOK TITLE</th>
				<th>AUTHOR NAME</th>
				<th>REQUEST DATE</th>
				<th>ACTION</th>
			</tr>

			<?php
			//connect to author table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM suggestion
			INNER JOIN STUDENT ON suggestion.student_id=student.student_id
			ORDER BY suggestion.updation_date DESC");

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display data-->
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['student_id']; ?> </td>
					<td> <?php echo $info['name']; ?> </td>
					<td> <?php echo $info['book_title']; ?> </td>
					<td> <?php echo $info['author_name']; ?> </td>
					<td> <?php echo $info['updation_date']; ?> </td>

					<!--delete button-->
					<td>
						<a href="book-request-delete.php?suggestion_id=<?php echo $info['suggestion_id']; ?>"
							onclick="return confirm('Dismiss request?');">
							<button class="redButton">DISMISS</button>
						</a>
					</td>
				</tr>
			<?php
				$no++;
			} ?>
		</table>
	</div>
</body>

<style>
	.form-container {
		padding-bottom: 30px;
		background-color: #BD61A2;
	}

	.pinkButton {
		background-color: #713a61;
		border-radius: 25px;
		transition-duration: 0.4s;
		border: none;
		width: 430px;
		color: white;
		text-align: center;
		padding: 8px 10px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		cursor: pointer;
		font-size: 16px;
	}

	.pinkButton:hover {
		background-color: #974d81;
		color: white;
	}
</style>

</html>