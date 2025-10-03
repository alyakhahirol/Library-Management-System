

<?php
require 'connection.php';

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/style.css"/>
</head>

<body>
<div class="flex-container">
	<h2>CATEGORY LIST</h2>
	<a href = "javascript:window.print()">
		<button class="whiteButton">PRINT</button>
	</a>
</div>

<div class="table-container">
	<table>
		<tr>
			<th>#</th>
			<th>CATEGORY NAME</th>
			<th>CREATION DATE</th>		
			<th>UPDATION DATE</th>
		</tr>
			
		<?php
		$no = 1;
		$data = mysqli_query($con, "SELECT * FROM category WHERE is_deleted <> 1 ORDER BY category_name ASC");
			
		while ($info = mysqli_fetch_array($data)) { ?>
			<tr>
				<td> <?php echo $no; ?> </td>
				<td> <?php echo $info['category_name']; ?> </td>
				<td> <?php echo $info['creation_date']; ?> </td>
				<td> <?php echo $info['updation_date']; ?> </td>
			</tr>
			<?php
			$no++;
		} ?>
	</table>
</div>
</body>

<style>

body {
	background-color: white;
}
.flex-container {
      display: flex;
      justify-content: center;
	align-items: center;
	flex-direction: column;
}

.subheading {
	flex-grow: 2;
}

h2 {
      font-size: 24px;
      font-family: "Unica One", sans-serif;
      font-weight: 400;
      font-style: normal;
      color: black;
      text-align: center;
}

.table-container {
      display: flex;
      justify-content: center;
	align-items: center;
	flex-direction: column;
}

table {
	background-color: white;
	padding-left: 25px;
	border-collapse: collapse;
	border: 1px solid;
	border-color: black;
	width: 90%;
}

th {
	font-size: 14px;
	font-family: "Unica One", sans-serif;
      font-weight: 400;
      font-style: normal;
  	padding: 7px;
  	text-align: left;
	border: 1px solid;
}

tr:hover {
	background-color: lightgray;
}

td {
	font-size: 12px;
      font-family: "Overpass Mono", monospace;
      font-optical-sizing: auto;
      font-style: normal;
	padding: 7px;
  	text-align: left;
	border: 1px solid;
}

.whiteButton {
    background-color: white;
    border-radius: 25px;
    transition-duration: 0.4s;
    border: 1px solid black;
    width: 70px;
    color: black;
    text-align: center;
    padding: 5px 10px;
    font-family: "Unica One", sans-serif;
    font-weight: 400;
    font-style: normal;
    cursor: pointer;
    margin-top: -10px;
    margin-bottom: 20px;
    font-size: 12px;
}
    
.whiteButton:hover {
      background-color: lightgray;
      color: black;
}
</style>
</html>