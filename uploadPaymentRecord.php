<?php require('header.php');?>
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
<?php 
session_start();
require_once 'connect_db.php';

if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
		header("Location: login.php");
	
$planID = $_POST['planId'];
$price = $_POST['price'];
$cardNumber = $_POST['cardnumber'];
$nameOfCard = $_POST['nameoncard'];
$expiryDate = $_POST['expirydate']. "-01" ;
$secuirtyCode = $_POST['secuirtycode'];
$cardType = $_POST['cardtype'];






try
{
	$insertCreditCardRecord = "REPLACE INTO creditCardInfo (cardNumber, cardType, cardOwnerName, expiryDate , securityCode) values (?,?,?,?,?);";
	$submitPayment = "INSERT INTO payment (email, planId, paymentPrice, cardNumber ,paymentTime ) values (?,?,?,?, NOW());";
	$updateDayLeft = "UPDATE member AS m, (SELECT month FROM subscriptionplan WHERE planId = ? ) AS m2  SET m.daysLeft = m.daysLeft + (m2.month * 31)  WHERE m.email = ?; ";
	
	if($stmt = mysqli_prepare($link, $insertCreditCardRecord))
	{
		mysqli_stmt_bind_param($stmt, "isssi", $cardNumber, $cardType,  $nameOfCard , $expiryDate, $secuirtyCode );
	
		mysqli_stmt_execute($stmt);
	
		mysqli_stmt_close($stmt);
	}else
	{
		throw new Exception('Cannot insert or modify credit card information.');
	}
	
	if($stmt = mysqli_prepare($link, $submitPayment))
	{
	mysqli_stmt_bind_param($stmt, "ssss",  $_COOKIE["email"], $planID ,$price, $cardNumber );
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_close($stmt);
	}else
	{
		throw new Exception('Cannot insert new payment record');
	}
	
	if($stmt = mysqli_prepare($link, $updateDayLeft))
	{
		mysqli_stmt_bind_param($stmt, "ss", $planID , $_COOKIE["email"] );
	
		mysqli_stmt_execute($stmt);
	
		mysqli_stmt_close($stmt);
	}else
	{
		throw new Exception('Cannot update day left.');
	}
	
	
	
	
	echo "Your payment record is created. \nEnjory Learning Sign Language.";
	
	
	
} catch(Exception $e) {
	echo "The server cannot process your payment.\nPlease try it again or connect with our administrator. ";
	mysqli_rollback($link);
}


mysqli_close($link);
?>
	<?php require('footer.php');?>
</body>
</html>



