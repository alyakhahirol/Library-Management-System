<?php
include "connection.php";
include "navbar-staff.php";
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css" />
</head>

<body>
	<div class="manage-box">
		<div class="left">
			<div>
				<h2>MANAGE CATEGORIES</h2>
			</div>

			<div class="add">
				<!--add button-->
				<a href="category-add.php" class="circle-button">
					<img src="icon/add.png" class="addImage">
				</a>
			</div>
		</div>

		<!--search box-->
		<div class="rightBox">
			<div>
				<form name="searchForm" method="POST" action="category-search.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Category">
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</form>
			</div>

			<div>
				<!--print button-->
				<a href="category-print.php">
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
				<th>CATEGORY NAME</th>
				<th>CREATION DATE</th>
				<th>UPDATION DATE</th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			//connect to category table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM category WHERE is_deleted <> 1");

			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['category_name']; ?> </td>
					<td> <?php echo $info['creation_date']; ?> </td>
					<td> <?php echo $info['updation_date']; ?> </td>

					<!--edit button-->
					<td class="td-button">
						<a href="category-edit.php?category_id=<?php echo $info['category_id']; ?>">
							<button class="blueButton">EDIT</button>
						</a>
					</td>

					<!--delete button-->
					<td>
						<a href="category-delete.php?category_id=<?php echo $info['category_id']; ?>"
							onclick="return confirm('Are you sure you want to delete this category?');">
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

<style>

</style>

</html>