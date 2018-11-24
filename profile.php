<?php
	if(!isset($_COOKIE["username"]))
		header("Location: login.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
</head>

<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<table class="defaultTable">
	  <tbody>
	    <tr>
	      <td><strong>username</strong></td>
	      <td><?php echo $_COOKIE["username"]?></td>
          <td><a href="changeUsername.php">change username</a></td>
        </tr>
	    <tr>
	      <td><strong>email address</strong></td>
	      <td><?php echo $_COOKIE["email"]?></td>
          <td><a href="rebindEmail.php">rebind email</a></td>
        </tr>
	    <tr>
	      <td><strong>sign up date</strong></td>
	      <td><?php echo $_COOKIE["registerDate"]?></td>
          <td><a href="changePassword.php">reset password</a></td>
        </tr>
        <tr>
	      <td><strong>remained subscription time</strong></td>
	      <td><?php echo $_COOKIE["daysLeft"]?></td>
	      <td><a href="payment.php">make a subscription</a></td>
        </tr>
	    <tr>
	      <td><a href="logout.php">log out</a></td>
        </tr>
      </tbody>
		</table>  
	</div>
	
	<?php require('footer.php');?>

</body>
</html>
