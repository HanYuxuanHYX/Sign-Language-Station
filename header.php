<div class="top">
	<ul>
		
	  	<li><span><img src = "img/home.png"></span> <a href="index.php">Main Page</a></li>
	  	<li><span><img src = "img/book.png"></span><a href="glossary.php">Vocabulary List</a></li>
 		<li><span><img src = "img/upload.png"></span><a href="upload.php">Upload Vocabulary</a></li>
 		<li><span><img src = "img/money.png"></span><a href="subscriptionPlan.php">Subscription</a></li>
  		<li>
  			<span><img src = "img/Account.png"></span>
           	<div class="dropDown">
           		<a href="javascript:DropDown()">Account Functions</a>
  				<div class="dropDownContent">
  					<a href="profile.php">Personal details</a>
  					<a href="adminFunctions.php">Admin Functions</a>
  				</div>
            </div>
        </li>
        <li><span><img src = "img/login.png"</span>
		<?php
		if(isset($_COOKIE["email"]))
			echo "<a href='logout.php'>log off " . $_COOKIE["email"] . "</a>";
		else
			echo "<a href='login.php'>log in</a>";
		?>
		</li>
	</ul>
</div>
<br /><br /><br />
