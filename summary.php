<?php
include 'connection.php';
include 'navbar-student.php';

$student_id = $_SESSION['student_id'];

$data = mysqli_query($con, "SELECT * FROM issue
INNER JOIN student ON student.student_id=issue.student_id
INNER JOIN book ON book.ISBN=issue.ISBN
INNER JOIN author on author.author_id=book.author_id
WHERE issue.student_id='$student_id'
ORDER BY return_status ASC");

$count = mysqli_num_rows($data);
$current_date = new DateTime();

?>

<html>

<head>
	<link rel="stylesheet" href="CSS/manage.css">
</head>

<body>

	<h2>SUMMARY</h2>

	<div class="table-container">
		<?php
		if ($count != 0) { ?>
			<table>
				<th></th>
				<th>TITLE</th>
				<th>AUTHOR</th>
				<th>DUE DATE</th>
				<th>STATUS</th>
				<th>FINE</th>

				<?php
				if ($count != 0) {

					while ($info = mysqli_fetch_array($data)) {
						// Get the due date from the current record
						$due_date = new DateTime($info['due_date']);
						$late_days = 1;


						// Calculate fine if overdue and not returned
						if ($current_date > $due_date && $info['return_status'] == 0) {
							$late_days = date_diff(($current_date)->setTime(0, 0), ($due_date)->setTime(0, 0))->days;
							$fine = $late_days * 1; // calculate fine per day
						} else {
							$fine = 0;
						}
				?>
						<tr>
							<td> <img src="book/<?php echo $info['filename']; ?>" class="bookImage"> </td>
							<td> <?php echo $info['title']; ?> </td>
							<td> <?php echo $info['author_name']; ?> </td>
							<td> <?php echo $info['due_date']; ?> </td>
							<td> <?php
								if ($info['return_status'] == 0) {
									echo "<button class='redButton'>NOT RETURNED</button>";
								} else {
									echo "<button class='greenButton'>RETURNED</button>";
								} ?>
							</td>
							<td>
								<input class="lefttext" type="text" value="RM <?php echo $fine; ?>" size="7" readonly>
							</td>
						</tr>
					<?php } ?>

				</table>
			<?php }
		}
		else { ?>
		<p>NO BOOKS LOANED/RETURNED</p> <?php ;
		} ?>
	</div>

</body>

<style>
	table,
	td,
	th {
		background-color: #090830;
		border: 1px solid #A83AC4;
		border-radius: 10px;
		padding: 10px;
		min-width: 180px;
	}

	td {
		min-height: 300px;
	}

	.redButton,
	.greenButton {
		width: 150px;
	}
</style>

</html>