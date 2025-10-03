<?php
include "connection.php";
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

<div class="navbar-container">
	<div class="left">
		<!--home-->
		<div>
			<a href="index.php">
				<button class="navbarButton"><img src="icon/home.png" class="profileImage"></button>
			</a>
		</div>
	</div>

	<div>
		<!--login-->
      	<div class="dropdown">
        		<button class="navbarButton">LOGIN</button>
          		<div class="dropdown-content">
            		<a href="login-student.php">STUDENT</a>
            		<a href="login-staff.php">STAFF</a>
          		</div>
      	</div>
		
		<!--signup-->
      	<div class="dropdown">
			<button class="navbarButton">SIGN UP</button>
          		<div class="dropdown-content">
            		<a href="signup-student.php">STUDENT</a>
          		</div>
      	</div>
    	</div>
</div>
</body>

<style> 

h1 {
	margin-bottom: 20px;
}

.dropdown {
	margin-left: 10px;
}

.navbar-container {
	background-color: #A83AC4;
}

.navbarButton, .dropdown .dropbtn {
	background-color: #752989;
}

.navbarButton:hover, .dropdown-content a:hover {
      background-color: #531d62;
}

.dropdown-content {
	background-color: #752989;
	width: 150px;
	margin-top: 1px;
}

</style>
</html>