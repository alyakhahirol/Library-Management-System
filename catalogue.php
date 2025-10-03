<?php
include "connection.php";
include 'navbar-student.php';
?>

<html>

<body>

	<div class="title">
		<h2>CATEGORY</h2>
	</div>

	<!--left divider-->
	<div class="category-list-box">
		<?php
		// fetch all categories
		$categoryTable = mysqli_query($con, "SELECT * FROM CATEGORY ORDER BY category_name ASC");
		$categoryTotal = mysqli_num_rows($categoryTable);
		$categoryCount = 1;

		//display each category with book image
		while ($display = mysqli_fetch_array($categoryTable)) { ?>
			<div class="categoryBook">
				<a href="#<?php echo $display['category_id']; ?>">
					<button class="categoryButton"><?php echo $display['category_name']; ?></button>
				</a>
			</div>
		<?php } ?>
	</div>


	<div class="flex-container">


		<?php
		// loop through each category to display books
		while ($categoryCount <= $categoryTotal) { ?>
			<!--right divider-->
			<div class="catbook-container">
				<div class="book">
					<?php
					// fetch data for current category
					$categoryTable2 = mysqli_query($con, "SELECT * FROM CATEGORY WHERE category_id='$categoryCount'");
					$display2 = mysqli_fetch_array($categoryTable2);

					// fetch title + author for current category
					$tableBook = mysqli_query($con, "
					SELECT BOOK.title, BOOK.filename, AUTHOR.author_name, BOOK.ISBN
					FROM BOOK 
					INNER JOIN AUTHOR ON BOOK.author_id = AUTHOR.author_id 
					WHERE BOOK.category_id = '$categoryCount'
					ORDER BY BOOK.title ASC");

					// total number of books in current category
					$bookTotal = mysqli_num_rows($tableBook);

					if ($bookTotal > 0) {
						// display category name
					?>
						<div class="category-box">
							<h2 id="<?php echo $display2['category_id']; ?>"> <?php echo $display2['category_name']; ?> </h2>
						</div>

						<!-- display books for current category -->
						<?php
						$bookCount = 0;

						// loop to display books in rows of 4
						while ($bookCount < $bookTotal) { ?>
							<div class="four-book-container">
								<?php
								$max = 0;
								while ($max < 4 && $bookCount < $bookTotal) {
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
					} ?>
				</div>

			<?php
			$categoryCount++;
		} ?>
			</div>
	</div> <!--close main flexbox-->

	<button onclick="topFunction()" id="myBtn" title="Go to top">TOP</button>
	<script>
		// Get the button:
		let mybutton = document.getElementById("myBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0; // For Safari
			document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		}
	</script>

</body>

<style>
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
		width: 1200px;
	}

	.category-box {
		width: 1100px;
		text-align: left;
		margin-bottom: 10px;
	}

	.four-book-container {
		width: 1100px;
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

	/*color*/
	/*
.flex-container {
	background-color: gray;
}

.category-list-box {
	background-color: darkgray;
}

.catbook-container {
	background-color: yellow;
}

.book {
	background-color: lightgray;
}

.category-box {
	background-color: lightcoral;
}

.four-book-container {
	background-color: purple;
}

.book-container {
	background-color: brown;
}

.image-box {
	background-color: greenyellow;
}

.title-box {
	background-color: green;
}

.author-box {
	background-color: gray;
}*/
</style>

</html>