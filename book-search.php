<?php
require 'connection.php';
include 'navbar-staff.php';
	
//get 'search' data
$search = $_POST['search'];
	
if ($search==NULL) {
	echo "<script> alert ('Please enter book title');
	window.location = 'book-manage.php' </script>";
}

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>
<div class="manage-box">
	<div class="leftBox">
		<div>
			<!--back button-->
			<a href="book-manage.php" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div>
			<h2>Search Results for '<?php echo $search ?>' </h2>
		</div>
	</div>
	
	<!--search bar-->
	<div class="rightBox">
		<!--search bar-->
		<div class="search-container">
			<form name="searchForm" method="POST" action="book-search.php" class="search-bar">
				<input type="text" name="search" size="30" placeholder="Search Book">
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
		$data = mysqli_query($con, "SELECT *
			FROM BOOK 
			INNER JOIN AUTHOR ON BOOK.author_id = AUTHOR.author_id
			INNER JOIN CATEGORY ON BOOK.category_id = CATEGORY.category_id
			WHERE
			BOOK.is_deleted <> 1 AND
			BOOK.title LIKE '%$search%' OR
			AUTHOR.author_name LIKE '%$search%' OR
			CATEGORY.category_name LIKE '%$search%' OR
			BOOK.ISBN LIKE '%$search%'
			ORDER BY BOOK.title ASC");
		//get data from table
		while ($info = mysqli_fetch_array($data))
		{ ?>
			<tr>
				<!--display data-->
				<td class="text-center"> <?php echo $no; ?> </td>
				<td>
					<img src="book/<?php echo $info['filename']; ?>" class="bookImage" alt="book image">
				</td>
				<td> <?php echo $info['ISBN']; ?> </td>
				<td> <?php echo $info['title']; ?> </td>
				<td> <?php echo $info['author_name']; ?> </td>
				<td> <?php echo $info['category_name']; ?> </td>
                    	<td> RM <?php echo $info['price']; ?> </td>
                    
				<!--edit button-->
				<td>
					<a href = "book-edit.php?ISBN=<?php echo $info['ISBN'];?>">
					<button class="blueButton">EDIT</button>
					</a>
				</td>

				<!--delete button-->
				<td>
					<a href="book-delete.php?ISBN=<?php echo $info['ISBN'];?>"
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


<style> 

.manage-box {
      display: flex;
	align-items: center;
	flex-direction: row;
	justify-content: space-between;
	padding-left: 135px;
	padding-right: 135px;
}

.manage-box > div {
      display: flex;
}

.manage-box > .add {
	margin-left: 15px;
}

.leftBox {
	display: flex;
	flex-direction: row;
	align-items: center;
}

.leftBox > div {
	display: left;
}


.rightBox {
	display: flex;
	justify-content: flex-end;
	flex-direction: column;

	margin-top: 35px;
	margin-bottom: 10px;
}

.rightBox > div {
	display: flex;
	justify-content: flex-end;

}

h2 {
	margin: 0px;
}
</style>

</html>