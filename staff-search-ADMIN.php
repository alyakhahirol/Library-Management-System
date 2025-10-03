<?php
require 'connection.php';
session_start();
include 'navbar-admin.php';
	
//GET ID FROM URL 
$search = $_POST['search'];
	
if ($search==NULL)
{
	echo "<script> alert('Please enter staff name')
	window.location = 'staff-manage-ADMIN.php' </script>";
}

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
	<link rel="stylesheet" href="CSS/ADMIN.css">
</head>

<body>
<div class="manage-box">
	<div class="left">
		<div>
			<!--back button-->
			<a href="staff-manage-ADMIN.php" class="circle-button">
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
			<form name="searchForm" method="POST" action="staff-search-ADMIN.php" class="search-bar">
				<input type="text" name="search" size="30" placeholder="Search Staff">
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
			<th>STAFF ID</th>
			<th>NAME</th>		
			<th>EMAIL</th>
			<th>GENDER</th>
			<th>PHONE NUMBER</th>
			<th>DATE OF BIRTH</th>
			<th>REGISTER DATE</th>
			<th>ACTION</th>
			<th></th>
		</tr>
		
		<?php
		//connect to student table
		$no = 1;
		$data = mysqli_query ($con, "SELECT * FROM staff WHERE
		staff_id LIKE '%$search%' OR
		name LIKE '%$search%' OR
		staff_email LIKE '%$search%' OR
		gender LIKE '%$search%' OR
		phone_number LIKE '%$search%' OR
		date_of_birth LIKE '%$search%'
		ORDER BY name ASC");
		
		//get data from table
		while ($info=mysqli_fetch_array($data))
		{ ?>
			<tr>
				<!--display data-->
				<td class="text-center"> <?php echo $no; ?> </td>
				<td> <?php echo $info['staff_id']; ?> </td>
				<td> <?php echo $info['name']; ?> </td>
				<td> <?php echo $info['staff_email']; ?> </td>
				<td> <?php echo $info['gender']; ?> </td>
				<td> <?php echo $info['phone_number']; ?> </td>
				<td> <?php echo $info['date_of_birth']; ?> </td>
				<td> <?php echo $info['register_date']; ?> </td>
				<!--edit button-->
				<td class="td-button">
					<a href = "account-detail-staff-ADMIN.php?staff_id=<?php echo $info['staff_id'];?>">
						<button class="blueButton">EDIT</button>
					</a>
				</td>

				<!--delete button-->
				<td>
					<a href="staff-delete2.php?staff_id=<?php echo $info['staff_id'];?>"
						onclick="return confirm('Permanently delete this staff?');">
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
	background: #BD61A2;
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
	background-color: #974d81;
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