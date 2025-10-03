<?php

require 'connection.php';
include "navbar-student.php";

$STUDENTID = $_SESSION['student_id'];
$ISBN = $_GET['ISBN'];

$query = " SELECT 
	BOOK.filename,
	BOOK.title, 
	BOOK.ISBN, 
	BOOK.description, 
	AUTHOR.author_name, 
	CATEGORY.category_name
	FROM BOOK
	JOIN AUTHOR ON BOOK.author_id = AUTHOR.author_id
	JOIN CATEGORY ON BOOK.category_id = CATEGORY.category_id
	WHERE ISBN='$ISBN'
";

$data = mysqli_query($con, $query);

//check if duplicate
$checkdupSQL = "SELECT * FROM issue
WHERE (student_id='$STUDENTID') AND (ISBN='$ISBN') AND (return_status='0') ";

$result = mysqli_query($con, $checkdupSQL);

?>

<html>
<head>
	<link rel="stylesheet" href="CSS/book-detail.css"/>
</head>

<body>

	<?php
	// Fetch and display the data from the result set
	while ($info = mysqli_fetch_assoc($data)) {
	?>
		<div class="content-container">
			<!-- Image Section -->
			<div class="image-container">
				<img src="book/<?php echo $info['filename']; ?>" alt="Book Image">

				<?php
				//message if already have an account	
				if (mysqli_num_rows($result) > 0) { ?>
					<button style="cursor: not-allowed">CHECK OUT</button> <?php ;
				} else { ?>
					<a href="loan.php?ISBN=<?php echo $info['ISBN']; ?>"><button class="checkoutbutton">CHECK OUT</button></a> <?php ;
				} ?>
			</div>
			<!-- Text Section -->
			<div class="text-container">
				<h2><?php echo $info['title']; ?></h2>
				<p><strong>Author(s):</strong> <?php echo $info['author_name']; ?></p>
				<p><strong>Category:</strong> <?php echo $info['category_name']; ?></p>
				<p><strong>ISBN:</strong> <?php echo $info['ISBN']; ?></p>
				<p><strong>Description:</strong> <br><?php echo $info['description']; ?></p>

				<!--add to list-->
				<a href="bookmark-add.php?ISBN=<?php echo $info['ISBN']; ?>">
					<button class="checkoutButton">BOOKMARK</button>
				</a>
			</div>
		</div>
	<?php
	}
	?>
</body>
</html>