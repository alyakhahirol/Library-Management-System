<?php
require 'connection.php';
session_start();
include 'navbar-admin.php';

//GET ID FROM URL 
$search = $_POST['search'];

if ($search == NULL) {
	echo "<script> alert('Please enter student/book name')
	window.location = 'issue-manage-ADMIN.php' </script>";
}

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
</head>

<body>
	<div class="manage-box">
		<div class="left">
			<div>
				<!--back button-->
				<a href="issue-manage-ADMIN.php" class="circle-button">
					<img src="icon/back-button.png" class="image">
				</a>
			</div>

			<div>
				<h2>Search Results for '<?php echo $search ?>' </h2>
			</div>
		</div>

		<div class="rightBox">
			<!--search bar-->
			<div class="search-container">
				<form name="searchForm" method="POST" action="issue-search-ADMIN.php" class="search-bar">
					<input type="text" name="search" size="30">
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</form>
			</div>
		</div>
	</div>

	<div class="table-container">
		<table>
			<tr>
				<!--table header-->
				<th class="th-center">#</th>
				<th>STUDENT NAME</th>
				<th>ISBN</th>
				<th>BOOK TITLE</th>
				<th>ISSUED DATE</th>
				<th>RETURN DATE</th>
				<th>STATUS</th>
			</tr>

			<?php
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM issue
			INNER JOIN STUDENT ON issue.student_id=student.student_id
        		INNER JOIN book ON issue.ISBN = book.ISBN

			WHERE student.name like '%$search%' OR
			student.student_id like '%$search%' OR
			book.title LIKE '%$search%' OR
			book.ISBN LIKE '%$search%'
			ORDER BY due_date DESC");

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
	.manage-box {
		display: flex;
		align-items: center;
		flex-direction: row;
		justify-content: space-between;
		padding-left: 135px;
		padding-right: 135px;
	}

	.manage-box>div {
		display: flex;
	}

	.manage-box>.add {
		margin-left: 15px;
	}

	.leftBox {
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.leftBox>div {
		display: left;
	}


	.rightBox {
		display: flex;
		justify-content: flex-end;
		flex-direction: column;

		margin-top: 35px;
		margin-bottom: 10px;
	}

	.rightBox>div {
		display: flex;
		justify-content: flex-end;

	}

	h2 {
		text-transform: uppercase;
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