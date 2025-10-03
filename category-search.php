<?php
require 'connection.php';
include 'navbar-staff.php';

//get 'search' data
$search = $_POST['search'];

if ($search == NULL) {
	echo "<script> alert ('Please enter category name');
	window.location = 'category-manage.php' </script>";
}

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>
	<div class="manage-box">
		<div class="left">
			<div>
				<!--back button-->
				<a href="category-manage.php" class="circle-button">
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
				<form name="searchForm" method="POST" action="category-search.php" class="search-bar">
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
			<!--table header-->
			<tr>
				<th>#</th>
				<th>AUTHOR NAME</th>
				<th>CREATION DATE</th>
				<th>UPDATION DATE</th>
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
					<td> <?php echo $no; ?> </td>
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