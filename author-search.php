<?php
require 'connection.php';
include "navbar-staff.php";


//get 'search' data
$search = $_POST['search'];

if ($search == NULL) {
	echo "<script> alert ('Please enter author name');
	window.location = 'author-manage.php' </script>";
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
				<a href="author-manage.php" class="circle-button">
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
				<form name="searchForm" method="POST" action="author-search.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Author">
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
				<th>AUTHOR NAME</th>
				<th>CREATION DATE</th>
				<th>UPDATION DATE</th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			//connect to author table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM author WHERE author_name like '%$search%' AND is_deleted <> 1 ORDER BY author_name ASC");

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display searched data-->
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
						<a href="author-delete.php?author_id=<?php echo $info['author_id']; ?>">
							<button class="redButton">DELETE</button>
						</a>
					</td>
				</tr>
			<?php $no++;
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
		margin-bottom: 30px;
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
</style>

</html>