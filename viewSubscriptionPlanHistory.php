<?php
	if(!isset($_COOKIE["username"])){
		header("Location: login.php");
		exit;
	}
	
	$db = mysqli_connect("sdmysql.comp.polyu.edu.hk","18012633x","sqgqcbvd");
	mysqli_select_db($db,"18012633x");
	
	$sql1 = "SELECT * FROM permission 
			WHERE title='" . $_COOKIE["title"] . "'";
	$result1 = mysqli_query($db,$sql1) or die("SQL error!<br>");
	$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	
	if($row1["statistics"]==0){
		echo "<script>alert('You do not have the authority to do this!');
		window.location.href='adminFunctions.php';</script>";
	}
?>
<html>
   <head>
      <title>Sign Language Station</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="css/general.css"/>
	  <script>
				function DropDown(){
					$(".dropDownContent").slideToggle("fast");
				};
	</script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart','line']});  
      </script>
   </head>

   <body>
   	<?php require('header.php');?>
      <div id = "container" style = "width: 1050px; height: 600px; margin: 70 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Plan 1');
            data.addColumn('number', 'Plan 2');
            data.addColumn('number', 'Plan 3');
            data.addRows([
              <?php
					session_start();
					require_once 'connect_db.php';
					if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
							header("Location: login.php");
	
					$findPlanRecord = "SELECT CONCAT(YEAR(paymentTime),'-',MONTH(paymentTime)) AS Month , GROUP_CONCAT(planId order by planId SEPARATOR ';' ) AS PlanIDGroup FROM payment WHERE paymentTime between DATE_SUB(now(), INTERVAL 12 MONTH) and now() GROUP BY YEAR(paymentTime), MONTH(paymentTime);";
					
					if($stmt = mysqli_prepare($link, $findPlanRecord))
					{
						mysqli_stmt_execute($stmt);
						
						 mysqli_stmt_bind_result($stmt, $month, $groupPlanId);
						 
						 while(mysqli_stmt_fetch($stmt)){
								echo "['".$month."', ".substr_count($groupPlanId, '1').", ".substr_count($groupPlanId, '2').", ".substr_count($groupPlanId, '3')."],";
							}
						mysqli_stmt_close($stmt);
						
						mysqli_close($link);
					}else
					{
						echo "Cannot obtain the subscription plan information. Please connect to the IT department.";
					}
                ?>]);
               
            // Set chart options
            var options = {'title' : 'The Purchase Number of each subscription plan',
               hAxis: {
                  title: 'Month'
               },
               vAxis: {
                  title: 'Purchase Number '
               },   
               'width':1050,
               'height':600,
               pointsVisible: true,
			   backgroundColor: 'transparent'
            };
            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('container'));
            
        function selectHandler() {
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
            var month = data.getValue(selectedItem.row,0);
            var planid = data.getColumnLabel(selectedItem.column);
            planid = planid.replace( /^\D+/g, '');
            
			$(function(){
				$.ajax({
						type: "POST",
						url: 'viewSubscriptionPlanHistoryDetail.php',
						data: {
							"smonth": month,
							"splanid": planid
						},
						success: function(data) {
							 $("#displayTable").html(data);
					   }
				});
			});
          }
        }
            google.visualization.events.addListener(chart, 'select', selectHandler);    
            chart.draw(data, options);
            
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
	 
	 <div id='displayTable'></div>
	 
	 <?php require('footer.php');?>
   </body>
</html>