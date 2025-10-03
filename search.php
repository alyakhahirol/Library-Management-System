<?php
include "connection.php";
include 'navbar-student.php';

//get 'search' data
$search = $_POST['search'];?>

<html>
<head>
    <link rel="stylesheet" href="CSS/catalogue.css">
</head>

<body>

<div class="flex-container">
	<div class="catbook-container"> <?php
		// Check if search is set and not empty
		if (!empty($search)) {
			// Fetch books based on search input
			$tableBook = mysqli_query($con, "SELECT BOOK.title, BOOK.filename, AUTHOR.author_name, BOOK.ISBN FROM BOOK 
				INNER JOIN AUTHOR ON BOOK.author_id = AUTHOR.author_id
				INNER JOIN CATEGORY ON BOOK.category_id = CATEGORY.category_id
				WHERE
				BOOK.title LIKE '%$search%' OR
				AUTHOR.author_name LIKE '%$search%' OR
				CATEGORY.category_name LIKE '%$search%' OR
				BOOK.ISBN LIKE '%$search%'
				ORDER BY BOOK.title ASC");

			$bookTotal = mysqli_num_rows($tableBook);

			if ($bookTotal > 0) {
				echo "<div class='category-box'>";
				echo "<h2>Search Results for '$search'</h2>";
				echo "</div>";

				echo '<div class="four-book-container">';

				$bookCount = 0;
				
				while ($displayBookInfo = mysqli_fetch_array($tableBook)) {
				// Start a new row every 4 books
					if ($bookCount % 4 == 0 && $bookCount != 0) {
						echo '</div><div class="four-book-container">';
					}

					// Display each book
					?>
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
				}
		
			echo '</div>'; // Close the last row
			}
			else {
				echo "<h2>No books found for '$search'</h2>";
			}
		}
		else {
			echo "<h2>Please enter a search term to find books.</h2>";
		}
	?>
	</div>
</div>

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> 
<script>
// Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

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
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: #CC3838; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 15px; /* Some padding */
  border-radius: 10px; /* Rounded corners */
  font-size: 18px; /* Increase font size */
}

#myBtn:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}

.flex-container {
      display: flex;
      justify-content: center;
	flex-direction: row;
	margin-top: 50px;
	margin-right: 0px;
}

.book-container {
	display: flex;
	align-items: center;
	flex-direction: column;
	margin-right: 30px;
	width: 250px;
	height: 425px;
}

.category-box {
	width: 1100px;
	text-align: left;
	margin-bottom: 30px;
}
</style>
</html>