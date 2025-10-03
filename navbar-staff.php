<?php

require 'connection.php';
session_start();
$STAFFID = $_SESSION["staff_id"];

$data = mysqli_query ($con, "SELECT * FROM staff WHERE staff_id='$STAFFID' ");
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
      		<a href="dashboard-staff.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/home.png" class="navbarImage"></button>
					<span class="tooltiptext">Dashboard</span>
				</div>
			</a>
		</div>
      	
		<!--category-->
      	<div>
			<a href="category-manage.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/category-listed.png" class="navbarImage"></button>
					<span class="tooltiptext">Category</span>
				</div>
			</a>
		</div>

		<!--author-->
    		<div>
			<a href="author-manage.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/author-listed.png" class="navbarImage"></button>
					<span class="tooltiptext">Authors</span>
				</div>
			</a>
		</div>

		<!--books-->
    		<div>
			<a href="book-manage.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/book-listed.png" class="navbarImage"></button>
					<span class="tooltiptext">Books</span>
				</div>
			</a>
		</div>

		<!--issue books-->
    		<div>
      		<a href="issue-manage.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/book-issued.png" class="navbarImage"></button>
					<span class="tooltiptext">Issued Books</span>
				</div>
			</a>
    		</div>

		<!--registered students-->
    		<div>
			<a href="student-manage.php">
				<div class="tooltip">
					<button class="navbarImageButton"><img src="icon/registered-user.png" class="navbarImage"></button>
					<span class="tooltiptext">Registered Students</span>
				</div>
			</a>
		</div>
	</div>

	<div class="right">
    		<!--account-->
		<div>
    		<div class="dropdown" style="float:right;">
			<!--icon-->
      		<button class="circleButtonNavbar"><img src="icon/profile.png" class="profileImage"></button>
      		<div class="dropdown-content">
        			<a href="account-detail-staff.php">YOUR ACCOUNT</a>
        			<a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="logoutNavbar">
					LOGOUT
				</a>
      		</div>
    		</div>
		</div>
      </div>
</div>

<style>

.navbar-container {
	background-color: #7c77cd;
}

.navbarImageButton, .dropdown-content, .circleButtonNavbar {
	background-color: #3C46A2;
}

.navbarImageButton:hover, .dropdown-content a:hover, .circleButtonNavbar:hover {
      background-color: #272E6A;
}

.dropdown-content {
	width: 150px;
	margin-left: -100px;
}
</style>
	
</body>
</html>