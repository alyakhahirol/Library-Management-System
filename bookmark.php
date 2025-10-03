<?php
include 'connection.php';
include 'navbar-student.php';

$student_id = $_SESSION['student_id'];

$data = mysqli_query($con, "SELECT * FROM bookmark
INNER JOIN book ON book.ISBN=bookmark.ISBN
INNER JOIN author on author.author_id=book.author_id
WHERE bookmark.student_id='$student_id'
ORDER BY bookmark_id ASC");

$count = mysqli_num_rows($data);

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>
	<h2>BOOKMARK(S)</h2>

	<div class="table-container">
		<?php
		if ($count != 0) { ?>
			<table>
				<?php
				while ($info = mysqli_fetch_array($data)) { ?>
					<tr>
						<td style="text-align: center;"> <img src="book/<?php echo $info['filename']; ?>" class="bookImage"> </td>
						<td>
							<a href="book-detail.php?ISBN=<?php echo $info['ISBN']; ?>">
								<p class="titletext"><?php echo $info['title']; ?> </p>
							</a><br>
							<p class="authortext"><?php echo $info['author_name']; ?> </p><br><br><br><br>
							<a href="bookmark-delete.php?bookmark_id=<?php echo $info['bookmark_id']; ?>">
								<button class="redButton">REMOVE BOOKMARK</button>
							</a>
						</td>
					</tr>
				<?php
				} ?>
			</table>
		<?php
		} else { ?>
			<p>NO BOOKS BOOKMARKED</p> <?php ;
		} ?>
</body>

</html>
<style>

	table,
	td,
	th {
		background-color: #090830;
		border: 1px solid #A83AC4;
		border-radius: 10px;
		padding: 25px;
		min-height: 300px;
		min-width: 180px;
	}

	.bookImage {
		width: 180px;
		height: 220px;
	}

	.redButton {
		font-size: 16px;
		width: 250px;
	}

	.authortext {
		font-size: 14px;
		margin: 0px;
	}

	.titletext {
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		font-size: 20px;
		margin: 0px;
		text-transform: uppercase;
		letter-spacing: 1px;
	}

	.titletext:hover {
		color: lightgray;
		text-decoration: underline;
	}
</style>

</html>