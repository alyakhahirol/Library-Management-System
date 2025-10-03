<?php
include "connection.php";
session_start();
include "navbar-admin.php";
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
				<h2>MANAGE BOOKS</h2>
			</div>

			<div class="add">
				<!--add button-->
				<a href="book-add-ADMIN.php" class="circle-button">
					<img src="icon/add.png" class="addImage">
				</a>
			</div>
		</div>

		<!--search box-->
		<div class="rightBox">
			<div>
				<form name="searchForm" method="POST" action="book-search-ADMIN.php" class="search-bar">
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
				<th></th>
				<th>ACTION</th>
				<th></th>
			</tr>

			<?php
			$no = 1;
			$data = mysqli_query(
				$con,
				"SELECT * FROM book
				INNER JOIN category ON book.category_id=category.category_id
				INNER JOIN author ON book.author_id=author.author_id
				ORDER BY book.title ASC"
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
					<td> <?php
						if ($info['is_deleted'] == 1) { ?>
							<a href="book-restore.php?ISBN=<?php echo $info['ISBN']; ?>"
								onclick="return confirm('Restore this book?');">
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
						<td>
							<a href="book-edit-ADMIN.php?ISBN=<?php echo $info['ISBN']; ?>">
								<button class="blueButton">EDIT</button>
							</a>
						</td>
						<?php ;
					} ?>

					<!--delete button-->
					<td>
						<a href="book-delete2.php?ISBN=<?php echo $info['ISBN']; ?>"
							onclick="return confirm('Permanently delete this book?');">
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