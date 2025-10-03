<?php
include "connection.php";
session_start();
include 'navbar-admin.php';
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css" />
	<link rel="stylesheet" href="CSS/ADMIN.css" />
</head>

<body>
	<div class="manage-box">
		<div class="left">
			<div>
				<h2>MANAGE CATEGORIES</h2>
			</div>

			<div class="add">
				<!--add button-->
				<a href="category-add-ADMIN.php" class="circle-button">
					<img src="icon/add.png" class="addImage">
				</a>
			</div>
		</div>

		<!--search box-->
		<div class="rightBox">
			<div>
				<form name="searchForm" method="POST" action="category-search-ADMIN.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Category" autocomplete="">
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
				<th></th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			//connect to category table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM category ORDER BY category_name ASC");

			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['category_name']; ?> </td>
					<td> <?php echo $info['creation_date']; ?> </td>
					<td> <?php echo $info['updation_date']; ?> </td>
					<td>
						<?php
						if ($info['is_deleted'] == 1) { ?>
							<a href="category-restore.php?category_id=<?php echo $info['category_id']; ?>"
								onclick="return confirm('Restore this category?');">
								<button class='greenButton'>RECOVER</button>
							</a>
						<?php ;
						}
						
						if ($info['is_deleted'] == 1) {
							echo "<td></td>";
						} else { ?>
							<!--edit button-->
							<td class="td-button">
								<a href="category-edit-ADMIN.php?category_id=<?php echo $info['category_id']; ?>">
									<button class="blueButton">EDIT</button>
								</a>
							</td>
						<?php ;
						} ?>

				<!--delete button-->
				<td>
					<a href="category-delete2.php?category_id=<?php echo $info['category_id']; ?>"
						onclick="return confirm('Permanently delete this category?');">
						<button class="redButton">DELETE FOREVER</button>
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
	.greenButton {
		width: 150px;
	}
</style>

</html>