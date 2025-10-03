<?php
require 'connection.php';


?>

<html>

<head>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="flex-container">
		<h2>BOOK LIST</h2>
		<a href="javascript:window.print()">
			<button class="whiteButton">PRINT</button>
		</a>
	</div>

	<div class="table-container">
		<table>
			<tr>
				<!--table header-->
				<th class="th-center">#</th>
				<th></th>
				<th>ISBN</th>
				<th>BOOK NAME</th>
				<th>AUTHOR</th>
				<th>CATEGORY</th>
				<th>PRICE</th>
			</tr>

			<?php
			$no = 1;
			$data = mysqli_query(
				$con,
				"SELECT * FROM book AS T1
			INNER JOIN category AS T2 ON T1.category_id=T2.category_id
			INNER JOIN author AS T3 ON T1.author_id=T3.author_id
			WHERE T1.is_deleted <> 1
			
			ORDER BY title ASC"
			);

			//get data from table
			while ($info = mysqli_fetch_array($data)) { ?>
				<tr>
					<!--display data-->
					<td class="text-center"> <?php echo $no; ?> </td>
					<td>
						<img src="book/<?php echo $info['filename']; ?>" class="bookImage" alt="book image">
					</td>
					<td> <?php echo $info['ISBN']; ?> </td>
					<td> <?php echo $info['title']; ?> </td>
					<td> <?php echo $info['author_name']; ?> </td>
					<td> <?php echo $info['category_name']; ?> </td>
					<td>RM <?php echo $info['price']; ?> </td>


				</tr>
			<?php
				$no++;
			}
			?>
		</table>
	</div>
</body>

<style>
	.bookImage {
		width: 30px;
	}

	body {
		background-color: white;
		color: black;
	}

	.text-center {
		text-align: center;
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