<?php
include "connection.php";
session_start();
include 'navbar-admin.php';
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
</head>

<body>
	<div class="manage-box">
		<!--subheader-->
		<div class="left">
			<div>
				<h2>MANAGE ISSUED BOOKS</h2>
			</div>
		</div>

		<div class="rightBox">
			<!--search box-->
			<div class="search-container">
				<form name="searchForm" method="POST" action="issue-search-ADMIN.php" class="search-bar">
					<input type="text" name="search" size="30">
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</form>
			</div>

			<div>
				<!--print button-->
				<a href="issue-print.php">
					<button class="printButton">PRINT</button>
				</a>
			</div>
		</div>
	</div>

	<div class="table-container">
		<table>
			<tr>
				<!-- Table Header -->
				<th class="th-center">#</th>
				<th>STUDENT NAME</th>
				<th>ISBN</th>
				<th>BOOK TITLE</th>
				<th>ISSUED DATE</th>
				<th>RETURN DATE</th>
				<th>STATUS</th>

			</tr>

			<?php
			// Connect to student table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM issue
                INNER JOIN student ON issue.student_id = student.student_id
                INNER JOIN book ON issue.ISBN = book.ISBN
                ORDER BY due_date DESC");

			// Get data from table
			while ($info = mysqli_fetch_array($data)) {
			?>
				<tr>
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['name']; ?> </td>
					<td> <?php echo $info['ISBN']; ?> </td>
					<td> <?php echo $info['title']; ?> </td>
					<td> <?php echo $info['issued_date']; ?> </td>
					<td> <?php echo $info['due_date']; ?> </td>
					<td>
						<?php
						if ($info['return_status'] == 0) { ?>
							<a href="issue-return-ADMIN.php?issue_id=<?php echo $info['issue_id']; ?>">
								<button class="redButton">NOT RETURNED</button>
							</a>
						<?php ;
						} else { ?>
							<button class="greenButton">RETURNED</button>
						<?php ;
						} ?>
					</td>
				</tr>
			<?php
				$no++;
			} ?>
		</table>
	</div>
</body>
<style> 

.redButton {
	width: 100px;
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