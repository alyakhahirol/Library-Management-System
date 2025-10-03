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
		<!--subheader-->
		<div class="left">
			<div>
				<h2>MANAGE BOOKS</h2>
			</div>

			<div class="add">
				<!--add button-->
				<a href="book-add.php" class="circle-button">
					<img src="icon/add.png" class="addImage">
				</a>
			</div>
		</div>

		<!--search box-->
		<div class="rightBox">
			<div>
				<form name="searchForm" method="POST" action="book-search.php" class="search-bar">
					<input type="text" name="search" size="30" placeholder="Search Book">
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</form>
			</div>

			<div>
				<!--print button-->
				<a href="book-print.php">
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
				<th class="th-center"></th>
				<th>ISBN</th>
				<th>BOOK NAME</th>
				<th>AUTHOR</th>
				<th>CATEGORY</th>
				<th>PRICE</th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			$no = 1;
			$data = mysqli_query($con, "SELECT * FROM book AS T1
			INNER JOIN category AS T2 ON T1.category_id=T2.category_id
			INNER JOIN author AS T3 ON T1.author_id=T3.author_id
			WHERE T1.is_deleted <> 1 ORDER BY title ASC"
			);

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display data-->
					<td class="text-center"> <?php echo $no; ?> </td>
					<td>
						<img src="book/<?php echo $info['filename']; ?>" class="bookImage" alt="book image">
					</td>
					<td><?php echo $info['ISBN']; ?> </td>
					<td><?php echo $info['title']; ?> </td>
					<td><?php echo $info['author_name']; ?> </td>
					<td><?php echo $info['category_name']; ?> </td>
					<td>RM <?php echo $info['price']; ?> </td>

					<!--edit button-->
					<td>
						<a href="book-edit.php?ISBN=<?php echo $info['ISBN']; ?>">
						<button class="blueButton">EDIT</button>
						</a>
					</td>

					<!--delete button-->
					<td>
						<a href="book-delete.php?ISBN=<?php echo $info['ISBN']; ?>"
							onclick="return confirm('Are you sure you want to delete this book?');">
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