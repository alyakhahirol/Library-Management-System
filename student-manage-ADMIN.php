<?php
include "connection.php";
session_start();
include 'navbar-admin.php';
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
			<h2>REGISTERED STUDENTS</h2>
		</div>
	</div>

	<div class="rightBox">
		<!--search box-->
		<div class="search-container">
			<form name="searchForm" method="POST" action="student-search-ADMIN.php" class="search-bar">
				<input type="text" name="search" size="30" placeholder="Search Student">
				<button type="submit" name="submit" id="submit" value="CARI" class="searchButton">
					<img src="icon/search.png" class="searchImage">
				</button>
			</form>
		</div>

		<div>
			<!--print button-->
			<a href="student-print.php">
			<button class="printButton">PRINT</button>
			</a>
		</div>
	</div>
</div>

<div class="table-container">
	<table class="bigTable">
		<tr>
			<!--table header-->
			<th class="th-center">#</th>
			<th>MATRIX NUMBER</th>
			<th>STUDENT NAME</th>		
			<th>EMAIL</th>
			<th>PHONE NUMBER</th>
			<th>FACULTY</th>
			<th>GENDER</th>
			<th>DATE OF BIRTH</th>
			<th>REGISTER DATE</th>
			<th>ACTION</th>
			<th></th>
		</tr>
			
		<?php
		//connect to student table
		$no = 1;
		$data = mysqli_query($con, "SELECT * FROM student ORDER BY name ASC");
		
		//get data from table
		while ($info = mysqli_fetch_array($data))
		{ ?>
			<tr>
				<!--display data-->
				<td class="text-center"> <?php echo $no; ?> </td>
				<td> <?php echo $info['student_id']; ?> </td>
				<td> <?php echo $info['name']; ?> </td>
				<td> <?php echo $info['student_email']; ?> </td>
				<td> <?php echo $info['phone_number']; ?> </td>
				<td> <?php echo $info['faculty']; ?> </td>
				<td> <?php echo $info['gender']; ?> </td>
				<td> <?php echo $info['date_of_birth']; ?> </td>
				<td> <?php echo $info['register_date']; ?> </td>

				<!--edit button-->
				<td class="td-button">
						<a href="account-detail-student-ADMIN.php?student_id=<?php echo $info['student_id']; ?>">
							<button class="blueButton">EDIT</button>
						</a>
					</td>

					<!--delete button-->
					<td>
						<a href="student-delete2.php?student_id=<?php echo $info['student_id']; ?>"
							onclick="return confirm('Permanently delete this student?');">
							<button class="redButton">DELETE FOREVER</button>
						</a>
					</td>
			</tr>
			<?php $no++;
		} ?>
	</table>
</div>

</body>


<style> 

.manage-box {
	padding-left: 70px;
	padding-right: 70px;
}

table {
	width: 90%;
}

th {
	font-size: 18px;
	font-family: "Unica One", sans-serif;
      font-weight: 400;
      font-style: normal;
  	padding-left: 7px;
	padding: 7px;
  	text-align: left;
}

.th-center {
	font-size: 18px;
	font-family: "Unica One", sans-serif;
      font-weight: 400;
      font-style: normal;
	padding: 15px;
  	text-align: center;
}

td {
	font-size: 14px;
      font-family: "Overpass Mono", monospace;
      font-optical-sizing: auto;
      font-style: normal;
	padding: 7px;
  	text-align: left;
	max-width: 200px;
	word-wrap: break-word;

}

.td-button {
  	text-align: left;
	width: 70px;
}

</style>

</html>