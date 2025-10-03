<?php
include "connection.php";
?>

<html>

<body>

	<head>
		<link rel="stylesheet" href="CSS/style.css" />
	</head>

	<body>
		<div class="flex-container">
			<h2>ISSUE LIST</h2>
			<a href="javascript:window.print()">
				<button class="whiteButton">PRINT</button>
			</a>
		</div>

		<div class="table-container">
			<table width="70%">
				<tr>
					<!-- Table Header -->
					<th class="th-center">#</th>
					<th>STUDENT NAME</th>
					<th>BOOK TITLE</th>
					<th>ISBN</th>
					<th>ISSUED DATE</th>
					<th>RETURN DATE</th>
					<th>STATUS</th>
				</tr>
				<?php
				// Connect to student table
				$no = 1;
				$data = mysqli_query($con, "SELECT * FROM issue
                INNER JOIN student ON issue.student_id = student.student_id
                INNER JOIN book ON issue.ISBN = book.ISBN
                ORDER BY return_status ASC");

				// Check for query error
				if (!$data) {
					die('Query Error: ' . mysqli_error($con));
				}

				// Get data from table
				while ($info = mysqli_fetch_array($data)) {
				?>
					<tr>
						<!--display data-->
						<td class="text-center"> <?php echo $no; ?> </td>
						<td> <?php echo $info['name']; ?> </td>
						<td> <?php echo $info['title']; ?> </td>
						<td> <?php echo $info['ISBN']; ?> </td>
						<td> <?php echo $info['issued_date']; ?> </td>
						<td> <?php echo $info['due_date']; ?> </td>
						<td>
							<?php
							if ($info['return_status'] == 0) {
								echo "NOT RETURNED";
							} else {
								echo "RETURNED";
							} ?>
						</td>
					</tr>
				<?php
					$no++;
				}
				?>
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