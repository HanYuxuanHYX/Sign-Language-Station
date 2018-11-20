<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropDown").click(function(){
        $(".dropDownContent").slideToggle("slow");
    });
})
</script>
<style>
table {
	//background-color: green;
    border-style: dotted;
    padding: 7px;
    border-radius: 10px;
}
td {
    border: 2px solid black;
    padding: 7px;
    border-color: red;
    font: 18px fantasy;
    height: 200px
}
th {
    color: red;
    background-color: yellow;
    font: 40px fantasy;
    text-shadow: 2px 3px green;
    border: 2px solid black;
    padding: 7px
    
}
h1.round{
	border: 2px solid red;
    border-radius: 15px;
    text-shadow: 2px 2px 5px red;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 4px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 2px 4px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.6s;
    cursor: pointer;
}
.button1 {
    background-color: white; 
    color: red; 
    border: 2px solid #f44336;
    font: 40px fantasy;
}
.button1:hover {
    background-color: #f44336;
    color: white;
}
</style>
</head>
<?php

if(!isset($_COOKIE["username"])){
	header("Location: login.php");
	exit;
}

session_start();
$servername = "sdmysql.comp.polyu.edu.hk";
$username = "18012633x";
$password = "sqgqcbvd";
$dbname = "18012633x";
// Create connection
$conn = mysql_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}
mysql_select_db($dbname, $conn);
$sql1 = "SELECT price
FROM subscriptionplan
WHERE planId=1;";
$sql2 = "SELECT price
FROM subscriptionplan
WHERE planId=2;";
$sql3 = "SELECT price
FROM subscriptionplan
WHERE planId=3;";
$result1 = mysql_query($sql1, $conn);
if (mysql_num_rows($result1) > 0) {
    // output data of each row
    while($row = mysql_fetch_assoc($result1)) {
        $price1= $row["price"];
    }
}
$result2 = mysql_query($sql2, $conn);
if (mysql_num_rows($result2) > 0) {
    // output data of each row
    while($row = mysql_fetch_assoc($result2)) {
        $price2= $row["price"];
    }
}
$result3 = mysql_query($sql3, $conn);
if (mysql_num_rows($result3) > 0) {
    // output data of each row
    while($row = mysql_fetch_assoc($result3)) {
        $price3= $row["price"];
    }
}
?>


<body>
<?php require('header.php');?>
<div class="mainFrame">

<h1 class="round"><center>Subscription Plan</center></h1>
<h3><center>Choose Your Own Plan for 30% off.</center></h3>
<p><center>Discont only avalibale for Today!!!</center></p>

<table style="width:100%">
  <tr>
    <th>Plan 1</th>
    <th>Plan 2</th> 
    <th>Plan 3</th>
  </tr>
  <tr>
    <td>Original:<?php echo $price1*1.5;?><br />
	<form action="payment.php" method="post">
		Now:<?php echo $price1;?><br />
        <input class="button button1" type="submit" value="Click Me!" >  
		<input type="hidden" name="planId" value='1'>
		<input type="hidden" name="price" value=<?php echo $price1 ?>>
        </input>
    </td>
	</form>
	<form action="payment.php" method="post">
    <td>Original:<?php echo $price2*1.5;?><br />
	Now:<?php echo $price2;?><br />
        <input class="button button1" type="submit" value="Click Me!" >  
		<input type="hidden" name="planId" value='2'>
		<input type="hidden" name="price" value=<?php echo $price2 ?>>    
        </input>
    </td>
	</form>
	<form action="payment.php" method="post">
    <td>Original:<?php echo $price3*1.5;?><br />
	Now:<?php echo $price3;?><br />
        <input class="button button1" type="submit" value="Click Me!">
        <input type="hidden" name="planId" value='3'>
		<input type="hidden" name="price" value=<?php echo $price3 ?>>    
        </input></a>
    </td>
	</form>
  </tr>

</table>


</div>
    
<?php require('footer.php');?>

</body>
</html>