	<header>
	<div class="top">
		<ul>
		  	<li><a href="index.php">Main Page</a></li>
		  	<li><a href="glossary.php">Vocabulary List</a></li>
  			<li><a href="upload.php">Upload Vocabulary</a></li>
  			<li><a href="payment.php">Subscription</a></li>
  			<li><a class="dropDown">Account Functions</a>
  				<div class="dropDownContent" style="display: none;">
  					<ul>
  						<li><a href="profile.php">Personal details</a></li>
  						<li><a href="adminFunctions.php">adminFunctions</a></li>
  					</ul>
  				</div></li>
			<?php
			if(isset($_COOKIE["username"]))
				echo "<li><a href='logout.php'>log off " . $_COOKIE["username"] . "</a></li>";
			else
				echo "<li><a href='login.php'>log in</a></li>";
			?>
		</ul>
	</div>
    </header>   
    <hr>
