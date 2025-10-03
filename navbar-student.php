<?php

require 'connection.php';
session_start();

$STUDENTID = $_SESSION["student_id"];

$data = mysqli_query($con, "SELECT * FROM student WHERE student_id='$STUDENTID' ");
$info = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="CSS/NAVBAR.css">
	<link rel="stylesheet" href="stars.css">
</head>

<body>
	<section class="wrapper">
		<div id="stars1"></div>
		<div id="stars2"></div>
		<div id="stars3"></div>
	</section>

	<div class="header">
		<h1>THE BOOK HAVEN</h1>
	</div>

	<div class="name-container">
		<div>
			<?php echo $info["name"]; ?>
		</div>
	</div>

	<div class="navbar-container">
		<div class="left">
			<!--home-->
			<div>
				<a href="dashboard-student.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/home.png" class="navbarImage"></button>
						<span class="tooltiptext">Dashboard</span>
					</div>
				</a>
			</div>

			<!--books-->
			<div>
				<a href="catalogue.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/catalogue.png" class="navbarImage"></button>
						<span class="tooltiptext">Catalogue</span>
					</div>
				</a>
			</div>

			<!--list-->
			<div>
				<div class="dropdown">
					<button class="navbarImageButton"><img src="icon/list.png" class="navbarImage"></button>
					<div class="dropdown-content2">
						<a href="summary.php">SUMMARY</a>
						<a href="bookmark.php">BOOKMARKS</a>
					</div>
				</div>
			</div>

			<!--suggestion-->
			<div>
				<a href="book-request.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/request.png" class="navbarImage"></button>
						<span class="tooltiptext">Request Book</span>
					</div>
				</a>
			</div>
		</div>

		<div class="right">
			<!--search-->
			<div class="search-bar">
				<div>
					<form name="searchForm" method="POST" action="search.php">
						<input type="text" name="search" placeholder="Search for books" size="30">
					</form>
				</div>
				<div>
					<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
						<img src="icon/search.png" class="searchImage">
					</button>
				</div>
			</div>

			<!--account-->
			<div>
				<div class="dropdown">
					<button class="circleButtonNavbar"><img src="icon/profile.png" class="profileImage"></button>
					<div class="dropdown-content">
						<a href="account-detail.php">YOUR ACCOUNT</a>
						<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">
							LOGOUT
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<style>
	.navbar-container {
		background-color: #A83AC4;
	}

	.navbarImageButton,
	.dropdown-content,
	.dropdown-content2,
	.circleButtonNavbar {
		background-color: #752989;
	}

	.navbarImageButton:hover,
	.dropdown-content a:hover,
	.dropdown-content2 a:hover,
	.circleButtonNavbar:hover {
		background-color: #531d62;
	}

	.dropdown-content {
		width: 150px;
		margin-left: -100px;
	}

	.dropdown-content2 {
		width: 150px;
		margin-left: 0px;
	}
</style>

</html>