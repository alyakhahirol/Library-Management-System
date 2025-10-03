<?php
include "connection.php";
session_start();
include 'navbar-admin.php';

$data1 = mysqli_query($con, "SELECT * FROM BOOK WHERE is_deleted <> 0 AND updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC");
$data5 = mysqli_query($con, "SELECT * FROM BOOK WHERE is_deleted <> 1 AND updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC LIMIT 10");
$data6 = mysqli_query($con, "SELECT * FROM BOOK WHERE is_deleted <> 1 AND register_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY register_date DESC LIMIT 10");

$data2 = mysqli_query($con, "SELECT * FROM AUTHOR WHERE is_deleted <> 0 AND updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC");
$data7 = mysqli_query($con, "SELECT * FROM AUTHOR WHERE is_deleted <> 1 AND creation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY creation_date DESC LIMIT 10");
$data8 = mysqli_query($con, "SELECT * FROM AUTHOR WHERE is_deleted <> 1 AND creation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY creation_date DESC LIMIT 10");

$data3 = mysqli_query($con, "SELECT * FROM CATEGORY WHERE is_deleted <> 0 AND updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC LIMIT 10");
$data9 = mysqli_query($con, "SELECT * FROM CATEGORY WHERE is_deleted <> 1 AND creation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY creation_date DESC LIMIT 10");
$data10 = mysqli_query($con, "SELECT * FROM CATEGORY WHERE is_deleted <> 1 AND creation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY creation_date DESC LIMIT 10");

$data4 = mysqli_query($con, "SELECT * FROM STUDENT WHERE register_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY register_date DESC LIMIT 10");
$data11 = mysqli_query($con, "SELECT * FROM STUDENT WHERE updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC LIMIT 10");

$data13 = mysqli_query($con, "SELECT * FROM STAFF WHERE register_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY register_date DESC LIMIT 10");
$data12 = mysqli_query($con, "SELECT * FROM STAFF WHERE updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC LIMIT 10");

$data14 = mysqli_query($con, "SELECT * FROM BOOKMARK INNER JOIN BOOK ON bookmark.ISBN=book.ISBN  WHERE bookmark.updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY bookmark.updation_date DESC LIMIT 10");

$data15 = mysqli_query($con, "SELECT * FROM ISSUE INNER JOIN BOOK ON issue.ISBN=book.ISBN  WHERE issued_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY issue.issued_date DESC LIMIT 10");
$data16 = mysqli_query($con, "SELECT * FROM ISSUE INNER JOIN BOOK ON issue.ISBN=book.ISBN WHERE issue.due_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY issue.due_date DESC LIMIT 10");

$data17 = mysqli_query($con, "SELECT * FROM SUGGESTION WHERE updation_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY updation_date DESC LIMIT 10");
?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css" />
	<link rel="stylesheet" href="CSS/ADMIN.css" />
</head>

<body>

	<div class="center">
		<div>
			<h2>Book</h2>
		</div>
		<?php
		if (mysqli_num_rows($data1) > 0) {
			while ($row = mysqli_fetch_assoc($data1)) {
				echo "<p class='red'>" . $row['ISBN'] . " " . $row['title'] . " recently DELETED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books deleted recently.</p>";
		}
		if (mysqli_num_rows($data5) > 0) {
			while ($row = mysqli_fetch_assoc($data5)) {
				echo "<p class='blue'>" . $row['ISBN'] . " " . $row['title'] . " recently UPDATED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books updated recently.</p>";
		}
		if (mysqli_num_rows($data6) > 0) {
			while ($row = mysqli_fetch_assoc($data6)) {
				echo "<p class='green'>" . $row['ISBN'] . " " . $row['title'] . " recently REGISTERED at " . $row['register_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books registered recently. </p>";
		}
		?>
		<div>
			<h2>Author</h2>
		</div>
		<?php
		if (mysqli_num_rows($data2) > 0) {
			while ($row = mysqli_fetch_assoc($data2)) {
				echo "<p class='red'>" . $row['author_name'] . " recently DELETED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No authors deleted recently. </p>";
		}
		if (mysqli_num_rows($data7) > 0) {
			while ($row = mysqli_fetch_assoc($data7)) {
				echo "<p class='blue'>" . $row['author_name'] . " recently UPDATED at " . $row['creation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No authors updated recently. </p>";
		}
		if (mysqli_num_rows($data8) > 0) {
			while ($row = mysqli_fetch_assoc($data8)) {
				echo "<p class='green'>" . $row['author_name'] . " recently REGISTERED at " . $row['creation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No authors registered recently. </p>";
		}
		?>
		<div>
			<h2>Category</h2>
		</div>
		<?php
		if (mysqli_num_rows($data3) > 0) {
			while ($row = mysqli_fetch_assoc($data3)) {
				echo "<p class='red'>" . $row['category_name'] . " recently DELETED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No categories deleted recently. </p>";
		}
		if (mysqli_num_rows($data9) > 0) {
			while ($row = mysqli_fetch_assoc($data9)) {
				echo "<p class='blue'>" . $row['category_name'] . " recently UPDATED at " . $row['creation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No categories updated recently.</p>";
		}
		if (mysqli_num_rows($data10) > 0) {
			while ($row = mysqli_fetch_assoc($data10)) {
				echo "<p class='green'>" . $row['category_name'] . " recently REGISTERED at " . $row['creation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No categories registered recently.</p>";
		}
		?>

		<div>
			<h2>Student</h2>
		</div>
		<?php
		if (mysqli_num_rows($data11) > 0) {
			while ($row = mysqli_fetch_assoc($data11)) {
				echo "<p class='blue'>" . $row['name'] . " recently UPDATED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No students updated recently.</p>";
		}
		if (mysqli_num_rows($data4) > 0) {
			while ($row = mysqli_fetch_assoc($data4)) {
				echo "<p class='green'>" . $row['name'] . " recently REGISTERED at " . $row['register_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No students registered recently.</p>";
		}
		?>

		<div>
			<!-- Display BOOKMARK updates -->
			<h2>Staff</h2>
		</div>
		<?php
		if (mysqli_num_rows($data12) > 0) {
			while ($row = mysqli_fetch_assoc($data12)) {
				echo "<p class='blue'>" . $row['name'] . " recently UPDATED at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No staffs updated recently.</p>";
		}
		if (mysqli_num_rows($data13) > 0) {
			while ($row = mysqli_fetch_assoc($data13)) {
				echo "<p class='green'>" . $row['name'] . " recently REGISTERED at " . $row['register_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No staffs registered recently.</p>";
		}
		?>

		<div>
			<h2>Bookmark</h2>
		</div>
		<?php
		if (mysqli_num_rows($data14) > 0) {
			while ($row = mysqli_fetch_assoc($data14)) {
				echo "<p class='green'>" . $row['student_id'] . " recently CREATED bookmark for " . $row['title']. " at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No bookmarks created recently. </p>";
		}
		?>

		<div>
			<h2>Issue</h2>
		</div>
		<?php
		if (mysqli_num_rows($data15) > 0) {
			while ($row = mysqli_fetch_assoc($data15)) {
				echo "<p class='green'>" . $row['student_id'] . " recently ISSUED " . $row['title'] . " at " . $row['issued_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books issued recently. </p>";
		}
		if (mysqli_num_rows($data16) > 0) {
			while ($row = mysqli_fetch_assoc($data16)) {
				echo "<p class='blue'>" . $row['student_id'] . " recently RETURNED " . $row['title'] . " at " . $row['due_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books returned recently.</p>";
		}
		?>

		<div>
			<h2>Book Request</h2>
		</div>
		<?php
		if (mysqli_num_rows($data17) > 0) {
			while ($row = mysqli_fetch_assoc($data17)) {
				echo "<p class='green'>" . $row['student_id'] . " recently REQUESTED " . $row['book_title'] . " by " . $row['author_name'] . " at " . $row['updation_date'] . "</p><br>";
			}
		} else {
			echo "<br><p>No books requested recently. </p>";
		}
		?>
	</div>
</body>

<style>
	.center {
		display: flex;
		justify-content: center;
		flex-direction: column;
		align-items: center;
		padding-bottom: 300px;
	}

	.center>div {
		display: flex;
	}

	p {
		margin: 5px;
	}

	p:hover {
		background-color: #34495e;
	}

	h2 {
		text-transform: uppercase;
		margin: 40px;
	}

	.red {
		color: #e74c3c;
	}

	.blue {
		color: #3498db;
	}

	.green {
		color: #28b463;
	}
</style>

</html>