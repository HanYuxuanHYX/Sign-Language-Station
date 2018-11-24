<div class="top">
	<ul>
	  	<li><a href="index.php">Main Page</a></li>
	  	<li><a href="glossary.php">Vocabulary List</a></li>
 		<li><a href="upload.php">Upload Vocabulary</a></li>
 		<li><a href="subscriptionPlan.php">Subscription</a></li>
  		<li>
           	<div class="dropDown">
           		<a href="javascript:DropDown()">Account Functions</a>
  				<div class="dropDownContent">
  					<a href="profile.php">Personal details</a>
  					<a href="adminFunctions.php">Admin Functions</a>
  				</div>
            </div>
        </li>
		<?php
		if(isset($_COOKIE["email"]))
			echo "<li><a href='logout.php'>log off " . $_COOKIE["email"] . "</a></li>";
		else
			echo "<li><a href='login.php'>log in</a></li>";
		?>
	</ul>
</div>
<br /><br /><br />
