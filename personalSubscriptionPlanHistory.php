<?php
	if(!isset($_COOKIE["email"]))
		header("Location: login.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Language Station</title>
<link rel="stylesheet" type="text/css" href="css/general.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script>
function DropDown(){
	$(".dropDownContent").slideToggle("fast");
};
</script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['table']});     
		 google.charts.load('current', {packages: ['corechart','line']});
		 google.charts.load('current', {'packages':['corechart', 'controls']});
		 google.charts.load('current', {'packages':['corechart']});
      </script>
</head>
<body>
		<?php require('header.php');?>
		 <div id="dashboard_payment"  style = "margin: 60 auto">
					<div id='paymentHistory_filter'  ></div>
					<div id = "paymentHistory_table" ></div>
	     </div>
		<script language = "JavaScript">
		function drawPaymentHistoryChart()
		{
				var data = google.visualization.arrayToDataTable([
									['Subscription Duration (Month)','Payment Date&Time' , 'Payment Price', 'Credit Card Number', 'Credit Card Type', 'Credit Card Owner Name', 'Credit Card Expiry Date'],
			<?php
						session_start();
						require_once 'connect_db.php';
						if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
								header("Location: login.php");
							
	
						$findPersonalPaymentHistory = "SELECT subscriptionplan.month,   payment.paymentTime, payment.paymentPrice, creditCardInfo.cardNumber, creditCardInfo.cardType, creditCardInfo.cardOwnerName, creditCardInfo.expiryDate
						FROM subscriptionplan, payment, creditCardInfo
						WHERE subscriptionplan.planId = payment.planId 
						AND payment.cardNumber = creditCardInfo.cardNumber
						AND payment.email = ?
						ORDER BY paymentTime DESC;";
						
						if($stmt = mysqli_prepare($link, $findPersonalPaymentHistory))
						{
								mysqli_stmt_bind_param($stmt, "s",  $_COOKIE["email"]);
								
								mysqli_stmt_execute($stmt);
						
								mysqli_stmt_bind_result($stmt, $scripMonth, $ppaymentTime, $ppaymentPrice, $pcardNumber, $pcardType, $pcardowner, $pexpiryDate);
						 
								while(mysqli_stmt_fetch($stmt)){
										echo "['".$scripMonth."', new Date('".$ppaymentTime."'),'".$ppaymentPrice."', '".$pcardNumber."', '".$pcardType."', '".$pcardowner."', '".$pexpiryDate."'],";
								}
								mysqli_stmt_close($stmt);
						
								mysqli_close($link);
						}else
						{
								echo "Cannot obtain the vocabulary information. Please connect to the IT department.";
						}
					?>]);
						
					var dashboard_p = new google.visualization.Dashboard(document.getElementById('dashboard_payment'));
					
					var dateRangeFilter = new google.visualization.ControlWrapper({
						'controlType': 'DateRangeFilter',
						'containerId': 'paymentHistory_filter',
						'options': {
							'filterColumnIndex': '1',
							'ui':
							{
								'label': 'Payment Date & Time ',
							}
							}
				    });
						
					var ppaymentTable = new google.visualization.ChartWrapper({
						'chartType': 'Table',
						'containerId': 'paymentHistory_table',
						'options': {
								'width': '100%',
								'height': '100%',
								'pageSize': '10',
								'showRowNumber': 'true',
					}
					});
						
					dashboard_p.bind(dateRangeFilter, ppaymentTable);
						
					dashboard_p.draw(data);

		}
		
		google.charts.setOnLoadCallback(drawPaymentHistoryChart);
		
		
		</script>
		<u><a href='profile.php'>Back to Personal Profile</a></u>
		<?php require('footer.php');?>
</body>
</html>

