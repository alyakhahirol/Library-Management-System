<?php
require 'connection.php';
include 'navbar-staff.php';
	
//GET ID FROM URL 
$search = $_POST['search'];
	
if ($search==NULL)
{
	echo "<script> alert('Please enter student name')
	window.location = 'registered-student-manage.php' </script>";
}

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>
<div class="manage-box">
	<div class="left">
		<div>
			<!--back button-->
			<a href="student-manage.php" class="circle-button">
				<img src="icon/back-button.png" class="image">
			</a>
		</div>

		<div>
			<h2>Search Results for '<?php echo $search ?>' </h2>
		</div>
	</div>

	<div class="rightBox">
		<!--search bar-->
		<div class="search-container">
			<form name="searchForm" method="POST" action="student-search.php" class="search-bar">
				<input type="text" name="search" size="30" placeholder="Search Student">
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
			<th>MATRIX NUMBER</th>
			<th>STUDENT NAME</th>		
			<th>EMAIL</th>
			<th>PHONE NUMBER</th>
			<th>REGISTER DATE</th>
		</tr>
		
		<?php
		//connect to student table
		$no = 1;
		$data = mysqli_query ($con, "SELECT * FROM student WHERE
		name LIKE '%$search%' OR
		student_id LIKE '%$search%' OR
		student_email LIKE '%$search%' OR
		phone_number LIKE '%$search%'
		ORDER BY name ASC");
		
		//get data from table
		while ($info=mysqli_fetch_array($data))
		{
		?>
			<tr>  
				<!--display searched data-->
				<td class="text-center"> <?php echo $no; ?> </td>
				<td> <?php echo $info['student_id']; ?> </td>
				<td> <?php echo $info['name']; ?> </td>
				<td> <?php echo $info['student_email']; ?> </td>
				<td> <?php echo $info['phone_number']; ?> </td>
				<td> <?php echo $info['register_date']; ?> </td>
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

tr:hover {
	background-color: #7c77cd;
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