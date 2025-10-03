<?php
require 'connection.php';
session_start();
include "navbar-admin.php";

//get 'search' data
$search = $_POST['search'];

if ($search == NULL) {
	echo "<script> alert ('Please enter author name');
	window.location = 'author-manage-ADMIN.php' </script>";
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
				<a href="author-manage-ADMIN.php" class="circle-button">
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
				<form name="searchForm" method="POST" action="author-search-ADMIN.php" class="search-bar">
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
				<th></th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			//connect to author table
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM AUTHOR WHERE author_name like '%$search%' ORDER BY author_name ASC");

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display data-->
					<td class="text-center"> <?php echo $no; ?> </td>
					<td> <?php echo $info['author_name']; ?> </td>
					<td> <?php echo $info['creation_date']; ?> </td>
					<td> <?php echo $info['updation_date']; ?> </td>
					<td> <?php
						if ($info['is_deleted'] == 1) { ?>
							<a href="author-restore.php?author_id=<?php echo $info['author_id']; ?>"
								onclick="return confirm('Restore this author?');">
								<button class='greenButton'>RECOVER</button>
							</a>
						<?php
						} ?>
					</td>
					<?php
					if ($info['is_deleted'] == 1) {
						echo "<td></td>";
					} else { ?>
						<!--edit button-->
						<td class="td-button">
							<a href="author-edit-ADMIN.php?author_id=<?php echo $info['author_id']; ?>">
								<button class="blueButton">EDIT</button>
							</a>
						</td>
					<?php ;
					} ?>

					<!--delete button-->
					<td>
						<a href="author-delete2.php?author_id=<?php echo $info['author_id']; ?>"
							onclick="return confirm('Permanently delete this author?');">
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

</html>