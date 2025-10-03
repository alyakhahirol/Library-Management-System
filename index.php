<?php

include 'connection.php';
include 'navbar-index.php';

$data = mysqli_query($con, "SELECT * FROM book");
?>

<html>

<head>
	<link rel='stylesheet' href='/CSS/general.css'>
</head>

<body>
	<div class="flex-container">

		<!--right divider-->
		<div class="catbook-container">
			<div class="title">
				<h2>POPULAR BOOKS</h2>
			</div>
			<div class="book">
				<?php
				$tableBook = mysqli_query($con, "SELECT BOOK.title, BOOK.filename, AUTHOR.author_name, BOOK.ISBN
									FROM BOOK
									INNER JOIN AUTHOR ON BOOK.author_id = AUTHOR.author_id
									INNER JOIN ISSUE ON BOOK.ISBN = ISSUE.ISBN
									GROUP BY BOOK.ISBN
									ORDER BY COUNT(ISSUE.ISBN) DESC
									LIMIT 3");

				$bookCount = 0;
				// loop to display books in rows of 3
				while ($bookCount < 3) { ?>
					<div class="four-book-container">
						<?php
						$max = 0;
						while ($max < 3 && $bookCount < 3) {
							// fetch book data
							$displayBookInfo = mysqli_fetch_array($tableBook);
						?>
							<!-- display each book -->
							<div class="book-container">
								<div class="image-box">
									<a href="book-detail.php?ISBN=<?php echo $displayBookInfo['ISBN']; ?>">
										<img src="book/<?php echo $displayBookInfo['filename']; ?>" class="book-image" alt="book image">
									</a>
								</div>

								<div class="title-box">
									<a href="book-detail.php?ISBN=<?php echo $displayBookInfo['ISBN']; ?>">
										<?php echo $displayBookInfo['title']; ?>
									</a>
								</div>

								<div class="author-box">
									<?php echo $displayBookInfo['author_name']; ?>
								</div>
							</div>
						<?php
							$bookCount++;
							$max++;
						} ?>
					</div>
				<?php
				}
				?>
			</div>
		</div>

		<div class="text">
			<p>OPENING HOURS: MONDAY - SUNDAY 8AM - 8PM<br></p>
			<p>Please Help Us Keep the Library a Wonderful Place for Everyone</p>
			1) Quiet, Please: <br>Keep noise levels low and phones on silent.<br>
			2) Respect Borrowing Rules: <br>Return books on time to avoid fines.<br>
			3) Handle Books with Care: <br>Keep books clean and undamaged.<br>
			4) Return books on time: <br>Or you will be fined RM1 per day.<br>
			5) No Food or Open Drinks: <br>Only spill-proof drinks allowed.<br>
			6) Be Considerate: <br>Avoid disruptive behavior; respect others.<br>
			7) Library Computers Are for Learning: <br>Use responsibly and respect time limits.<br>
			8) Clean Up After Yourself: <br>Leave spaces tidy for others.<br>
			9) Follow Staff Instructions: <br>They're here to help!<br>
			10) Emergency Procedures: <br>Follow safety instructions and exit calmly.<br>
		</div>
	</div>

	<!-- Footer -->
	<div class="footer">
		<h3>Contact Us</h3>
		<p>Ask Us Helpdesk: 604 9414461<br>
			Access Service Desk: 604 9414462<br>
			Whatsapp: +6019 389 5402<br>
			Email us at: library@example.com<br><br>
			Website developed by Nurul Alya, Nur Batrisyia, Siti Hawa</p>
	</div>


</body>
<!--
 -->
<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("dot");
		if (n > slides.length) {
			slideIndex = 1
		}
		if (n < 1) {
			slideIndex = slides.length
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " active";
	}
</script>

<style>
	body {
		height: 1000px;
	}

	* {
		box-sizing: border-box
	}

	/* Slideshow container */
	.slideshow-container {
		max-width: 400px;
		position: relative;
		margin: auto;
		padding-left: 20px;

	}

	/* Hide the images by default */
	.mySlides {
		display: none;
	}

	/* Next & previous buttons */
	.prev,
	.next {
		cursor: pointer;
		position: absolute;
		top: 50%;
		width: auto;
		margin-top: -22px;
		padding: 16px;
		color: white;
		font-weight: bold;
		font-size: 18px;
		transition: 0.6s ease;
		border-radius: 0 3px 3px 0;
		user-select: none;
	}

	/* Position the "next button" to the right */
	.next {
		right: 0;
		border-radius: 3px 0 0 3px;
	}

	/* On hover, add a black background color with a little bit see-through */
	.prev:hover,
	.next:hover {
		background-color: rgba(0, 0, 0, 0.8);
	}

	.active {
		background-color: #717171;
	}

	/* Fading animation */
	.fade {
		animation-name: fade;
		animation-duration: 1.5s;
	}

	@keyframes fade {
		from {
			opacity: .4
		}

		to {
			opacity: 1
		}
	}

	.picture {
		width: 1000px;
	}

	.image {
		width: 300px;
		margin-left: 43px;
	}

	/* Footer */
	.footer {
		padding: 2px;
		text-align: center;
		line-height: 1.3;
		background: #ddd;
		margin-top: 70px;
		background-color: #2f2d79;
		color: white;
		font-size: 14px;
	}

	/* Centered text */
	h2 {
		font-size: 36px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		letter-spacing: 5px;
	}

	/* Flex container for centering items */
	.flex-container {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.flex-container>div {
		display: flex;
	}



	/* Container for image and button */
	.image-button-container {
		display: flex;
		flex-direction: row;
		/* Row layout to place items beside each other */
		align-items: center;
		justify-content: center;
		margin-top: 20px;
	}



	/* Gallery image */
	.gallery {
		border-radius: 40px;
		background: #A83AC4;
		display: flex;
		justify-content: center;
		align-items: center;
		z-index: 600;
	}

	.gallery img {
		width: 70px;
		height: 72px;
		border-radius: 50%;
		/* Make image round */
	}

	/* Button */
	.startButton {
		width: 300px;
		height: 70px;
		border-radius: 35px;
		background-color: #A83AC4;
		border: none;
		margin-left: -15px;
		font-size: 20px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		text-decoration: uppercase;
		letter-spacing: 0px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.startButton:hover {
		background-color: #78298c;
		letter-spacing: 2px;

	}

	/* Columns */
	.leftcolumn {
		float: left;
		width: 75%;
	}

	.rightcolumn {
		float: left;
		width: 25%;
		background-color: #752989;
		padding-left: 0px;
	}

	/* Card design */
	.card {
		background-color: #090830;
		padding: 5px;
		margin-top: 20px;
		color: white;
	}

	.card p {
		font-family: Arial, sans-serif;

	}

	.row::after {
		content: "";
		display: table;
		clear: both;
	}


	/* Responsive layout */
	@media screen and (max-width: 800px) {

		.leftcolumn,
		.rightcolumn {
			width: 100%;
			padding: 0;
		}
	}

	@media screen and (max-width: 400px) {
		.topnav a {
			float: none;
			width: 100%;
		}
	}

	/* The hero image */
	.hero-image {
		/* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */
		background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("picture/7.jpg");
		height: 300px;
		/* Set a specific height */

		/* Position and center the image to scale nicely on all screens */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		position: relative;
	}

	/* Place text in the middle of the image */
	.hero-text {
		text-align: center;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		color: white;
	}

	/* Footer */
	.footer {
		padding: 2px;
		text-align: center;
		line-height: 1.3;
		background: #ddd;
		margin-top: 70px;
		background-color: #2f2d79;
		color: white;
		font-size: 14px;
	}

	body {
		background-color: #090830;
	}

	/* Centered text */
	h2 {
		font-size: 36px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		letter-spacing: 5px;
	}

	/* Flex container for centering items */
	.center-container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.flex-container>div {
		display: flex;
	}

	.title {
		margin-top: 70px;
	}

	.text {
		width: 800px;
		flex-direction: column;
		padding-right: 30px;
	}

	/* Container for image and button */
	.image-button-container {
		display: flex;
		flex-direction: row;
		/* Row layout to place items beside each other */
		align-items: center;
		justify-content: center;
		margin-top: 20px;
	}

	/* Gallery image */
	.gallery {
		border-radius: 40px;
		background: #A83AC4;
		display: flex;
		justify-content: center;
		align-items: center;
		z-index: 600;
	}

	.gallery img {
		width: 70px;
		height: 72px;
		border-radius: 50%;
		/* Make image round */
	}

	/* Button */
	.startButton {
		width: 300px;
		height: 70px;
		border-radius: 35px;
		background-color: #A83AC4;
		border: none;
		margin-left: -15px;
		font-size: 20px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-align: center;
		text-decoration: uppercase;
		letter-spacing: 0px;
		transition-duration: 0.4s;
		cursor: pointer;
	}

	.startButton:hover {
		background-color: #78298c;
		letter-spacing: 2px;

	}

	#myBtn {
		display: none;
		/* Hidden by default */
		position: fixed;
		/* Fixed/sticky position */
		bottom: 20px;
		/* Place the button at the bottom of the page */
		right: 30px;
		/* Place the button 30px from the right */
		z-index: 99;
		/* Make sure it does not overlap */
		border: none;
		/* Remove borders */
		outline: none;
		/* Remove outline */
		background-color: #CC3838;
		/* Set a background color */
		color: white;
		/* Text color */
		cursor: pointer;
		/* Add a mouse pointer on hover */
		padding: 15px;
		/* Some padding */
		border-radius: 10px;
		/* Rounded corners */
		font-size: 18px;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
	}

	#myBtn:hover {
		background-color: #555;
	}


	body {
		background-color: #090830;
		color: white;
		font-family: "Overpass Mono", monospace;
		font-optical-sizing: auto;
		font-style: normal;
		font-size: 14px;
	}



	html {
		scroll-behavior: smooth;
	}



	a {
		color: white;
		cursor: pointer;
		text-transform: capitalize;
		text-decoration: none;
	}

	a:hover {
		color: lightgray;
	}

	.flex-container {
		display: flex;
		flex-direction: row;
		justify-content: center;
	}

	.title {
		display: flex;
		justify-content: center;
	}



	.category-list-box {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding-left: 210px;
		padding-right: 210px;
		margin-bottom: 100px;
		margin-top: 25px;
		flex-wrap: wrap;

	}

	.category-list-box>div {
		display: flex;
		margin-bottom: 20px;
	}

	.categoryButton {
		margin: 0;
		overflow: hidden;
		display: block;
		background-color: #752989;
		border-radius: 75px;
		transition-duration: 0.4s;
		border: none;
		width: 160px;
		height: 70px;
		margin: 0;
		padding: 0;
		list-style-type: none;
		overflow: hidden;
		text-align: center;
		float: left;
		cursor: pointer;
		text-transform: uppercase;

		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		font-size: 18px;
		letter-spacing: 1px;
		color: white;

	}

	.categoryButton:hover {
		background-color: #A83AC4;
		letter-spacing: 2px;
	}



	.catbook-container {
		display: flex;
		flex-direction: column;
		justify-content: center;


	}

	.book {
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		justify-content: space-between;
		margin-bottom: 30px;
		width: 1000px;
	}

	.category-box {
		width: 1100px;
		text-align: left;
		margin-bottom: 10px;
	}

	.four-book-container {
		display: flex;
		justify-content: left;
		align-items: center;
		flex-direction: row;
		margin-bottom: 20px;
	}



	.circle-button {
		margin: 0;
		overflow: hidden;
		display: block;
		background-color: #752989;
		border-radius: 25px;
		transition-duration: 0.4s;
		border: 2px solid #A83AC4;
		width: 80px;
		height: 50px;
		margin: 0;
		padding: 0;
		list-style-type: none;
		overflow: hidden;
		text-align: center;
		float: left;
		cursor: pointer;
		text-transform: uppercase;
	}

	.circle-button:hover {
		background-color: #090830;
		border-radius: 50px;
	}

	.image {
		height: 40px;
	}


	.book-container {
		display: flex;
		align-items: center;
		flex-direction: column;
		margin-right: 30px;
		width: 250px;
		height: 425px;
	}

	.book-container>div {
		display: flex;
	}

	.book-container a:hover {
		text-decoration: underline;
	}

	.image-box {
		height: 300px;
		width: 225px;
		margin-bottom: 15px;
	}

	.book-image {
		height: 300px;
		width: 225px;
		transition: 0.5s ease;
	}

	.book-image:hover {
		box-shadow: 0 0 50px white;
	}

	.title-box {
		width: 225px;
		margin-bottom: 10px;

	}

	.author-box {
		width: 225px;
		margin-bottom: 10px;
		text-transform: capitalize;
	}

	h2 {
		font-size: 42px;
		font-family: "Unica One", sans-serif;
		font-weight: 400;
		font-style: normal;
		color: white;
		text-transform: UPPERCASE;
		margin: 10px;
		margin-top: 20px;
	}

	.title {
		margin-top: 0px;
		margin-bottom: 20px;
	}
</style>

</html>