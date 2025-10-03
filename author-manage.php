<?php
include "connection.php";

include "navbar-staff.php";

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>
	<div class="manage-box">
		<div class="left">
			<div>
				<h2>MANAGE AUTHORS</h2>
			</div>

			<div class="add">
				<!--add button-->
				<a href="author-add.php" class="circle-button">
					<img src="icon/add.png" class="addImage">
				</a>
			</div>
		</div>

		<!--search box-->
		<div class="rightBox">
			<div>
				<form name="searchForm" method="POST" action="author-search.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Author">
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</form>
			</div>

			<div>
				<!--print button-->
				<a href="author-print.php">
					<button class="printButton">PRINT</button>
				</a>
			</div>
		</div>
	</div>

	<div class="table-container">
		<table>
			<tr>
				<!--table header-->
				<th class="th-center">#</th>
				<th>AUTHOR NAME</th>
				<th>CREATION DATE</th>
				<th>UPDATION DATE</th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			//connect to author table
			$no = 1;
			$data = mysqli_query($con, "SELECT author_id, author_name, creation_date, updation_date FROM AUTHOR  WHERE is_deleted <> 1 ORDER BY author_name ASC");

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display data-->
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['author_name']; ?> </td>
					<td> <?php echo $info['creation_date']; ?> </td>
					<td> <?php echo $info['updation_date']; ?> </td>

					<!--edit button-->
					<td class="td-button">
						<a href="author-edit.php?author_id=<?php echo $info['author_id']; ?>">
						<button class="blueButton">EDIT</button>
						</a>
					</td>

					<!--delete button-->
					<td>
						<a href="author-delete.php?author_id=<?php echo $info['author_id']; ?>"
							onclick="return confirm('Are you sure you want to delete this author?');">
							<button class="redButton">DELETE</button>
						</a>
					</td>
				</tr>
			<?php
				$no++;
			} ?>
		</table>
	</div>
</body>
</html>