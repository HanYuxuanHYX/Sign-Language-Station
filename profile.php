<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="top_bottom_list.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
})
</script>
</head>

<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<table width="600" border="0">
	  <tbody>
	    <tr>
	      <td width="180">username</td>
	      <td width="240"><?php echo $_COOKIE["username"]?></td>
        </tr>
	    <tr>
	      <td>email address</td>
	      <td><?php echo $_COOKIE["email"]?></td>
        </tr>
	    <tr>
	      <td>sign up date</td>
	      <td><?php echo $_COOKIE["registerDate"]?></td>
        </tr>
        <tr>
	      <td>remained subscription time</td>
	      <td><?php echo $_COOKIE["daysLeft"]?></td>
	      <td><a href="payment.php">make a subscription</a></td>
        </tr>
	    <tr>
	      <td height="50"><a href="changePassword.php">change password</a></td>
	      <td><a href="logout.php">log out</a></td>
        </tr>
      </tbody>
		</table>  
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
