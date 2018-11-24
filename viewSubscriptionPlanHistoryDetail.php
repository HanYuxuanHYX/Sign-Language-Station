<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$(".dropDown").click(function(){
    	$(".dropDownContent").slideToggle("slow");
    });
})
</script>
<style>
.paymentTable table {
	margin: auto;
    border-collapse: collapse;
    width: 80%;
}
.paymentTable th, .paymentTable td {
    text-align: center;
    padding: 8px;
}
.paymentTable tr:nth-child(odd){background-color: #f2f2f2}
.paymentTable th {
    background-color: #888888;
    color: white;
}
</style>
</head>
<body>
<?php 
session_start();
require_once 'connect_db.php';
if(!isset($_POST['smonth']) && !isset($_POST['splanid'])  )
		header("Location: login.php");
	
$smonth = $_POST['smonth'];
$smonethEnd = $smonth . "-31";
$smonethStart = $smonth ."-01";
$splanid = $_POST['splanid'];
try
{
	$insertCreditCardRecord = "SELECT paymentId, email, planId, paymentTime, paymentPrice FROM  payment WHERE planId = ? AND paymentTime <= ? AND paymentTime >= ? ;";
	
	if($stmt = mysqli_prepare($link, $insertCreditCardRecord))
	{
		mysqli_stmt_bind_param($stmt, "sss", $splanid  ,  $smonethEnd  , $smonethStart);
		
		 mysqli_stmt_bind_result($stmt, $paymentId, $email, $planId, $paymentTime, $paymentPrice);
	
		mysqli_stmt_execute($stmt);
		
		mysqli_stmt_store_result($stmt);
		
		if(mysqli_stmt_num_rows($stmt) > 0)
		{
			echo "<div class='paymentTable'><table border='1'><thead><tr><th>Payment ID</th><th>User's Email</th><th>Plan ID </th><th>Payment Price </th><th>Payment Time </th></tr></thead><tbody></div>";
		
		
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>
				<td>$paymentId</td>
				<td>$email</td>
				<td>$planId</td>
				<td>$paymentTime</td>
				<td>$paymentPrice</td>
				</tr>";
			 }
	
			echo "</tbody></table>";
		}else
		{
			echo "<div class='paymentTable'><table border='1'><thead><tr><th>There is no payment record about  '".$smonethStart. "'  To  '" .$smonethEnd. "'  of Plan ID: " .$splanid . "  </th></th></tr></thead><tbody></div>";
		}
		
		mysqli_stmt_close($stmt);
	}else
	{
		throw new Exception();
	}
	
	
} catch(Exception $e) {
	echo "The server cannot process your advance search.\n";
	mysqli_rollback($link);
}
mysqli_close($link);
?>
</body>
</html>