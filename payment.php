<?php
	session_start();
	if(!isset($_COOKIE["email"]))
		header("Location: login.php");
	
	$planId = $_POST['planId'];
	$price = $_POST['price']
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

function checkNumberField(value)
{
	var inputValueCode = value.keyCode;
	if(inputValueCode > 48 && inputValueCode <57  )
	{
		return true;
	}else
	{
		return false;
	}
}

</script>
</head>
<body>
	<?php require('header.php');?>
	
	<div class="mainFrame">
		<?php
		echo "You selected plan " . $planId . ".<br>" . "The price is " . $price . ".<br>"
		?>
		Enter payment information:<br><br>
		Card type:
		<form action="uploadPaymentRecord.php" id="form1" name="form1" method="post">
		    <table class="defaultTable">
			    <tr>
				    <td><label for="cardnumber">Card number</label></td>
					<td><input type="text" required name="cardnumber" id="cardnumber" placeholder="0123456789012345" maxlength='16' minlength='15' onkeypress='return checkNumberField(event)'></td>
				</tr>
				
				<tr>
				    <td><label for="nameoncard">Card Owner</label></td>
					<td><input type="text" required name="nameoncard" id="nameoncard" placeholder="Chan Tai Man" required></td>
				</tr>
				
				<tr>
				    <td><label for="expirydate">Expiry month</label></td>
					<td><input type="month" required name="expirydate" id="expirydate" placeholder="MM" maxlength="2"  min='<?php echo date('Y-m');?>' required></td>
				</tr>
				

				
				<tr>
				    <td><label for="secuirtycode">Secuirty code</label></td>
					<td><input type="text"  name="secuirtycode" id="secuirtycode" placeholder="123" maxlength="3" minlength="3" onkeypress='return checkNumberField(event)'  required></td>
				</tr>
				
				<tr>				    
					<input type="radio" name="cardtype" id="cardtype" value="visa" required> visa<br>
					<input type="radio" name="cardtype" id="cardtype" value="amex"  required> amex<br>
					<input type="radio" name="cardtype" id="cardtype" value="mastercard" required> mastercard<br>
					<input type="radio" name="cardtype" id="cardtype" value="discover" required> discover<br></td>
				</tr>
				
				<tr>
					<td><input type="submit" name="Submit" id="Submit"></td>
				</tr>
				
			</table>
            <input type="hidden" name="planId" value="<?php echo $planId;?>">
            <input type="hidden" name="price" value="<?php echo $price;?>">
		</form>
	</div>
	
	<?php require('footer.php');?>
</body>
</html>