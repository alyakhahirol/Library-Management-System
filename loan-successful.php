<?php

include 'connection.php';
include 'navbar-student.php';

$IDSTUDENT = $_SESSION['student_id'];
$ISBN = $_GET['ISBN'];

// Set timezone to Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');

// Set the checkout and due dates
$issued_date = date("Y-m-d H:i:s");
$due_date = date("Y-m-d 23:59:59", strtotime("+14 days"));

// Insert record into table
$insertData = "INSERT INTO issue (student_id, ISBN, issued_date, due_date, return_status)
VALUES ('$IDSTUDENT', '$ISBN', '$issued_date', '$due_date', '0')";

$data2 = mysqli_query($con, $insertData);

// Retrieve issue ID
$ISSUEID = "SELECT issue_id FROM issue WHERE student_id='$IDSTUDENT' AND ISBN='$ISBN'";
$issue_result = mysqli_query($con, $ISSUEID);
$issue_row = mysqli_fetch_assoc($issue_result);
$issue_id = $issue_row['issue_id'];

// Display current book checkout
$data = mysqli_query($con, "SELECT * FROM issue
INNER JOIN student ON student.student_id=issue.student_id
INNER JOIN book ON book.ISBN=issue.ISBN
WHERE issue.issue_id='$issue_id'");

$dataName = "SELECT * FROM student WHERE student_id='$IDSTUDENT'";
$infoName = mysqli_query($con, $dataName);
$Name = mysqli_fetch_assoc($infoName);


?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="manage.css" />
</head>

<body>
	<div class="receipt-box">
		<div class="receipt-container">
			<div class="receipt-header">
				Name: <?php echo $Name['name']; ?><br>
				Check out date: <?php echo $issued_date; ?>
			</div>

			<div class="receipt-info">
				<table>
					<th>ISBN</th>
					<th>Title</th>
					<th>Due Date</th>

					<?php
					while ($info = mysqli_fetch_array($data)) { ?>
						<tr>
							<td> <?php echo $info['ISBN']; ?> </td>
							<td> <?php echo $info['title']; ?> </td>
							<td> <?php echo $due_date; ?> </td>
						</tr>
					<?php
					} ?>
				</table>
			</div>

			<div class="note">Please retain receipt for reference</div>
		</div>

		<div>
			<a href="javascript:window.print()"> <u>Print</u> </a>
		</div>

		<div>
			<a href='catalogue.php'> <u>Back to catalogue</u></a>
		</div>
	</div>
		<!-- Popup Section -->
		<div class="popup center " id="loanPopup">
			<div class="icon"> <!--success icon-->
				<img src = "icon/checked.png" class="check-image">
			</div>
			
			<div class="title">
				SUCCESS!!
			</div>
			
			<div class ="description">
				PLEASE PRINT YOUR RECEIPT
			</div>

			<div class="dismiss-btn">
					<button id="dismiss-popup-btn">DISMISS</button>
			</div>
		</div>

		<script>
            // Automatically show the popup after the page loads
            window.onload = function() {
                document.getElementById("loanPopup").classList.add("active");
            };

            // Dismiss popup when the dismiss button is clicked
            document.getElementById("dismiss-popup-btn").addEventListener("click", function() {
                document.getElementById("loanPopup").classList.remove("active");
            });
        </script>

</body>



<style>

.check-image {
    width: 100px;
}
    body{
        background: #090830;
        font-family:"Raleway";
        color: black;
    }
    .center{
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
    .popup {
        width:350px;
        height:280px;
        padding:30px 20px;
        background:#f5f5f5;
        border-radius:10px;
        box-sizing:border-box;
        z-index: 200;
        text-align:center;
        opacity:0;
        top:-200%;
        transform:translate(-50%,-50%) scale(0.5);
        transition: opacity 300ms ease-in-out,
        top 1000ms ease-in-out,
        transform 1000ms ease-in-out;
    }
    .popup.active{
     opacity:1;
     top:50%;
     transform:translate(-50%,-50%) scale(1);
     transition:transform 300ms cubic-bezier(0,18,0,89,0.43,1,19);
    }
    .popup.icon{
        margin:5px 0px;
        width:50px;
        height:50px;
        border:2px solid #34f234;
        text-align: center;
        display: inline-block;
        border-radius:50%;
        line-height:60px;
    }
    .popup .icon i.fa{
        font-size:30px;
        color:#34f234;
    }
    .popup .title{
        margin:5px 0px;
        font-size:30px;
        font-weight:600;
    }
    .popup .description{
        color:222;
        font-size:15px;
        padding:5px;
    }
    .popup .dismiss-btn{
        margin-top:15px;
    }
    .popup .dismiss-btn button{
        padding:10px 20px;
        background:#111;
        color:#f5f5f5;
        border:2px solid #111;
        font-size:16px;
        font-weight:600;
        outline:none;
        border-radius:10px;
        cursor:pointer;
        transition:all 300ms ease-in-out;
    }
.popup .dismiss-btn button:hover{
    color:#111;
    background:#f5f5f5;
}
.popup > div{
    position:relative;
    top:10px;
    opacity:0;
}
.popup.active > div{
    top:0px;
    opacity:1;
}
.popup.active.icon{
    transition:all 300ms ease-in-out 250ms;
}
.popup.active.title{
    transition:all 300ms ease-in-out 300ms;
}
.popup.active.description{
    transition:all 300ms ease-in-out 350ms;
}
.popup.active.dismiss-btn{
    transition:all 300ms ease-in-out 400ms;
}
</style>

<style>	

	.receipt-box {
		display: flex;
		flex-direction: column;
		align-items: center;
		color: black;

	}

	.receipt-box>div {
		display: flex;
		margin-bottom: 20px;
		color: black;

	}

	.receipt-container {
		background-color: #1c1c2e;
		padding: 20px;
		border: 2px dashed black;
		width: 700px;
		display: flex;
		justify-content: center;
		flex-direction: column;
		background-color: white;
		margin-top: 110px;
	}

	.receipt-container>div {
		display: flex;
	}

	.receipt-header {
		font-size: 16px;
		margin-bottom: 10px;
	}

	.receipt-info {
		margin-bottom: 20px;
		color: black;

	}

	table {
		width: 100%;
		border-collapse: collapse;
		color: black;
	}

	table th,
	table td {
		padding: 20px 10;
		font-size: 14px;
		border-bottom: 2px dashed black;
	}

	table th {
		text-align: left;
	}

	.greenButton,
	.redButton,
	.printButton,
	.whiteButton {
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		font-size: 16px;

		border-radius: 25px;
		border: none;
		width: 100px;
		padding: 5px 10px;

		transition-duration: 0.4s;
		cursor: pointer;
	}

	.whiteButton {
		background-color: white;
		color: black;
		width: 200px;
	}

	.whiteButton:hover {
		background: lightgray;
		color: black;
	}



	.note {
		display: flex;
		margin-top: 20px;
		font-size: 14px;
	}
</style>

</html>