<?php

require 'connection.php';

$STAFFID = $_SESSION["staff_id"];

$data = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$STAFFID' ");
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
			<div>
				<!--home-->
				<a href="dashboard-admin.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/home.png" class="navbarImage"></button>
						<span class="tooltiptext">Dashboard</span>
					</div>
				</a>
			</div>

			<!--category-->
			<div>
				<a href="category-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/category-listed.png" class="navbarImage"></button>
						<span class="tooltiptext">Category</span>
					</div>
				</a>
			</div>

			<!--author-->
			<div>
				<a href="author-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/author-listed.png" class="navbarImage"></button>
						<span class="tooltiptext">Authors</span>
					</div>
				</a>
			</div>

			<!--books-->
			<div>
				<a href="book-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/book-listed.png" class="navbarImage"></button>
						<span class="tooltiptext">Books</span>
					</div>
				</a>
			</div>

			<!--issue books-->
			<div>
				<a href="issue-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/book-issued.png" class="navbarImage"></button>
						<span class="tooltiptext">Issued Books</span>
					</div>
				</a>
			</div>

			<!--registered students-->
			<div>
				<a href="student-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/registered-user.png" class="navbarImage"></button>
						<span class="tooltiptext">Registered Students</span>
					</div>
				</a>
			</div>

			<!--staff-->
			<div>
				<a href="staff-manage-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/staff.png" class="navbarImage"></button>
						<span class="tooltiptext">Registered Staff</span>
					</div>
				</a>
			</div>

			<!--suggestion-->
			<div>
				<a href="book-request-ADMIN.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/request.png" class="navbarImage"></button>
						<span class="tooltiptext">Request Book</span>
					</div>
				</a>
			</div>

			<!--history-->
			<div>
				<a href="history.php">
					<div class="tooltip">
						<button class="navbarImageButton"><img src="icon/history.png" class="navbarImage"></button>
						<span class="tooltiptext">History</span>
					</div>
				</a>
			</div>
		</div>

		<div class="right">
			<div>
				<div class="dropdown" style="float:right;">
					<button class="circleButtonNavbar"><img src="icon/profile.png" class="profileImage"></button>
					<div class="dropdown-content">
						<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="logoutNavbar">
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
		background-color: #BD61A2;
	}

	.navbarButton {
		background-color: #974d81;
	}

	.navbarButton:hover {
		background-color: #713a61;
	}

	.dropdown .dropbtn {
		background-color: #974d81;
	}

	.dropdown-content {
		background-color: #CC3838;
	}

	.dropdown-content a:hover {
		background-color: #8e2727;
	}

	.navbarImageButton,
	.dropdown-content,
	.circleButtonNavbar {
		background-color: #974d81;
	}

	.navbarImageButton:hover,
	.dropdown-content a:hover,
	.circleButtonNavbar:hover {
		background-color: #713a61;
	}

	.dropdown-content {
		margin-left: -50px;
	}
</style>

</body>

</html>