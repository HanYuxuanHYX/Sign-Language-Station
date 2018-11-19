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
	
$planID = $_SESSION['planId'];
$price = $_SESSION['price'];
$cardNumber = $_POST['cardnumber'];
$nameOfCard = $_POST['nameoncard'];
$expiryDate = $_POST['expirydate']. "-01" ;
$secuirtyCode = $_POST['secuirtycode'];
$cardType = $_POST['cardtype'];

$updatePaymentQuery = "INSERT INTO payment (email, planId, paymentPrice, cardNumber, cardOwnerName, expiryDate, securityCode, cardType, paymentTime ) values (?,?,?,?,?,?,?,?, NOW());";


if($stmt = mysqli_prepare($link, $updatePaymentQuery))
{
	mysqli_stmt_bind_param($stmt, "ssdsssss", $_COOKIE["email"], $planID, $price , $cardNumber ,  $nameOfCard , $expiryDate, $secuirtyCode, $cardType);
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_close($stmt);
	
	echo "Your payment record is created. \nEnjory Learning Sign Language.";
	
}else 
{
	echo "The server cannot process your payment.\nPlease try it again or connect with our administrator. ";
}


$selectMonth = "SELECT month FROM subscriptionplan WHERE planId=? ;";

if($stmt = mysqli_prepare($link, $selectMonth))
{
	
	mysqli_stmt_bind_param($stmt, 's', $planID );
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_bind_result($stmt, $month);
	
	while (mysqli_stmt_fetch($stmt)) {
        $planMonth = $month;
    }
	
	mysqli_stmt_close($stmt);
	
}else 
{
	echo "Server Error, Please connect with our administrator. ";
}

$newTimeLeft = intval($planMonth) * 31;

$updateTimeLeftQuery = "UPDATE member SET daysLeft = daysLeft + ? WHERE email =? ;";
if($stmt = mysqli_prepare($link, $updateTimeLeftQuery))
{
	
	mysqli_stmt_bind_param($stmt, "is",$newTimeLeft, $_COOKIE["email"]);
	
	mysqli_stmt_execute($stmt);
	
	mysqli_stmt_close($stmt);
	
}else 
{
	echo "Server Error, Please connect with our administrator. ";
}
mysqli_close($link);
?>
	<?php require('footer.php');?>
</body>
</html>



