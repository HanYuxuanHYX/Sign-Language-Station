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
$updateCreditCardQuery = "REPLACE INTO creditCardInfo (cardNumber, cardType, cardOwnerName, expiryDate , securityCode) values (?,?,?,?,?);";
if($stmt = mysqli_prepare($link, $updateCreditCardQuery))
{
	mysqli_stmt_bind_param($stmt, "isssi", $cardNumber, $cardType,  $nameOfCard , $expiryDate, $secuirtyCode);
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_close($stmt);
	
	
	$updatePaymentQuery = "INSERT INTO payment (email, planId, paymentPrice, cardNumber ,paymentTime ) values (?,?,?,?, NOW());";
	if($stmt2 = mysqli_prepare($link, $updatePaymentQuery))
	{
		mysqli_stmt_bind_param($stmt2, "ssds", $_COOKIE["email"], $planID, $price , $cardNumber );
	
		mysqli_stmt_execute($stmt2);
	   
		mysqli_stmt_close($stmt2);
		
		$selectMonth = "SELECT month FROM subscriptionplan WHERE planId=? ;";
		if($stmt3 = mysqli_prepare($link, $selectMonth))
		{
	
			mysqli_stmt_bind_param($stmt3, 's', $planID );
	
			mysqli_stmt_execute($stmt3);
	
			mysqli_stmt_bind_result($stmt3, $month);
	
			while (mysqli_stmt_fetch($stmt3)) {
				$planMonth = $month;
			}
	
			mysqli_stmt_close($stmt3);
			
			
			$newTimeLeft = intval($planMonth) * 31;
			
			$updateTimeLeftQuery = "UPDATE member SET daysLeft=daysLeft+? WHERE email=? ;";
			if($stmt4 = mysqli_prepare($link, $updateTimeLeftQuery))
			{
		
				mysqli_stmt_bind_param($stmt4,"is",$newTimeLeft, $_COOKIE["email"]);
	
				mysqli_stmt_execute($stmt4);
	
				mysqli_stmt_close($stmt4);
				$updateTitle= "UPDATE member SET title='subscribedUser' WHERE email=? AND title='visitor';";
				if($stmt5 = mysqli_prepare($link, $updateTitle)){
					mysqli_stmt_bind_param($stmt5, 's', $_COOKIE["email"] );
					mysqli_stmt_execute($stmt5);
					mysqli_stmt_close($stmt5);
					//if visitor pay, it becomes subscribedUser
				}
			
				
				
				echo "<script>alert('Your payment record is created. Enjory Learning Sign Language.')</script>";
	
			}else 
			{
				echo "Server Error, Please contact with our administrator. ";
			}
				
	
		}else 
		{
			echo "Server Error, Please contact with our administrator. ";
		}
	
	}else
	{
		echo "There is a server error. Please try it again.";
	}
	
	
}else 
{
echo "The server cannot process your payment.\nPlease try it again or connect with our administrator. ";
}
mysqli_close($link);
require("index.php");
?>