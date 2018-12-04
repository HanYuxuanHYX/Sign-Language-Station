<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
<style>
table {
	//background-color: green;
    border-style: dotted;
    padding: 7px;
    border-radius: 10px;
	text-align:center;
}
td {
    border: 2px solid black;
    padding: 7px;
    border-color: #09F;
    font: 18px fantasy;
    height: 200px
}
th {
    color: black;
    background-color:#09F;
    font: 40px fantasy;
    text-shadow: 2px 3px green;
    border: 2px solid black;
    padding: 7px
    
}
h1.round{
	border: 2px solid #09F;
    border-radius: 15px;
    text-shadow: 2px 2px 5px #09F;
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
    color: #09F; 
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
if(!isset($_COOKIE["email"])){
	header("Location: login.php");
	exit;
}
session_start();
$servername = "sdmysql.comp.polyu.edu.hk";
$username = "18012633x";
$password = "sqgqcbvd";
$dbname = "18012633x";
// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}
mysqli_select_db($conn, $dbname);
$sql = "SELECT planId, month, price  FROM subscriptionplan";
$array_planId = array();
$array_month = array();
$array_price = array();
$result = mysqli_query( $conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		$array_planId[] = $row["planId"];
		$array_month[] = $row["month"];
		$array_price[] =  $row["price"];
    }
}
mysqli_free_result($result);
mysqli_close($conn);
?>


<body>
<?php require('header.php');?>
<div class="mainFrame" style='padding-top: 60px' >

<h1 class="round"><center>Subscription Plan</center></h1>
<h3><center>Choose Your Own Plan for 30% off.</center></h3>
<p><center>Discount only avalibale for Today!!!</center></p>

<table class="defaultTable" align="center" style='margin: auto'>
  <tr>
	<?php 
	
	$planNum = count($array_planId);
	for($i = 0; $i < $planNum; $i++) {
			echo "<th>Plan ". $array_planId[$i]. "<br>Duration : ". $array_month[$i] . " Month</th>";
			
	}
	?>
  </tr>
  <tr>
	<?php
		for($i = 0; $i < $planNum; $i++) {
				echo "<td>Original:". $array_price[$i] * 1.5 ."<br />";
				echo "<form action='payment.php' method='post'>";
				echo "Now:".$array_price[$i] ."<br />";
				echo "<input class='button button1' type='submit' value='Click Me!' >  ";
				echo "<input type='hidden' name='planId' value='". $array_planId[$i]. "'>";
				echo "<input type='hidden' name='price' value=". $array_price[$i].">";
				echo "</input></td></form>";
		}
		
	?>
  </tr>

</table>


</div>
    
<?php require('footer.php');?>

</body>
</html>