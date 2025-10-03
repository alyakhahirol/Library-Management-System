<?php
require 'connection.php';
session_start();
include 'navbar-admin.php';

//get 'search' data
$search = $_POST['search'];

if ($search == NULL) {
	echo "<script> alert ('Please enter category name');
	window.location = 'category-manage-ADMIN.php' </script>";
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
				<a href="category-manage-ADMIN.php" class="circle-button">
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
				<form name="searchForm" method="POST" action="category-search-ADMIN.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Category">
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
				<th>CATEGORY NAME</th>
				<th>CREATION DATE</th>
				<th>UPDATION DATE</th>
				<th></th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM category WHERE category_name like '%$search%' ORDER BY category_name ASC");

			while ($info = mysqli_fetch_array($data)) {
			?>
				<tr>
					<!--display searched data-->
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
					} ?>
					</td>
					<!--edit button-->
					<td class="td-button">
						<a href="category-edit-ADMIN.php?category_id=<?php echo $info['category_id']; ?>">
							<button class="blueButton">EDIT</button>
						</a>
					</td>

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
			}
			?>
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
</style>

</html>