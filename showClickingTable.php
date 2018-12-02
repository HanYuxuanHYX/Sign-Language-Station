<?php
		require('header.php');
		if(!isset($_COOKIE["email"])){
		header("Location: login.php");
		exit;
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
         google.charts.load('current', {packages: ['table']});     
		 google.charts.load('current', {packages: ['corechart','line']});
		 google.charts.load('current', {'packages':['corechart', 'controls']});
		 google.charts.load('current', {'packages':['corechart']});
      </script>
      </script>
   </head>
   
   <body>
      <div id="dashboard_div"  style = "width: 550px; height: 400px; margin: 60 auto">
			<div id='vocab_filter'  ></div>
			<div id = "vocab_table" ></div>
	  </div>
      <script language = "JavaScript">
         function drawChart() {
			 
			 var data = google.visualization.arrayToDataTable([
					['Vocabulary ID', 'Vocabulary Name' , 'Check Total'],
			
			<?php
					session_start();
					require_once 'connect_db.php';
					if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
							header("Location: login.php");
							
					$sql1 = "SELECT * FROM permission WHERE title='" . $_COOKIE["title"] . "'";
					$result1 = mysqli_query($link,$sql1) or die("SQL error!<br>");
					$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	
					if($row1["statistics"]==0){
								mysqli_close($link);
								echo "<script>alert('You do not have the authority to do this!');
								window.location.href='adminFunctions.php';</script>";
								exit;
					}
	
					$findVocab = "SELECT vocabId, vocabName, checkTotal FROM vocabulary;";
					
					if($stmt = mysqli_prepare($link, $findVocab))
					{
						mysqli_stmt_execute($stmt);
						
						 mysqli_stmt_bind_result($stmt, $vocabId, $vocabName, $checkTotal);
						 
						 while(mysqli_stmt_fetch($stmt)){
								echo "['".$vocabId."', '".$vocabName."',".$checkTotal."],";
							}
						mysqli_stmt_close($stmt);
						
						mysqli_close($link);
					}else
					{
						echo "Cannot obtain the vocabulary information. Please connect to the IT department.";
					}
                ?>]);
				
			var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));
			 
			var stringFilter = new google.visualization.ControlWrapper({
						'controlType': 'StringFilter',
						'containerId': 'vocab_filter',
						'options': {
							'matchType': 'prefix',
							'filterColumnIndex': '1',
							'ui':
							{
								'label': 'Search Vocabulary: ',
							}
							}
				});
				
			var vocabTable = new google.visualization.ChartWrapper({
						'chartType': 'Table',
						'containerId': 'vocab_table',
						'options': {
								'width': '100%',
								'height': '100%',
								'pageSize': '5',
								'showRowNumber': 'true',
				}
			});

			 dashboard.bind(stringFilter, vocabTable);
						
			function selectHandler() {
			var selectedItem = vocabTable.getChart().getSelection()[0];
			if (selectedItem) {
				var vocabId = vocabTable.getDataTable().getFormattedValue(selectedItem.row,0);
				$(function(){
				$.ajax({
						type: "POST",
						url: 'showClickingTableDetail.php',
						data: {
							"vocabId": vocabId,
						},
						success: function(data) {
							 $("#displayVocabDetail").html(data);
							 drawLineChart();
					   }
				});
			});
				}
			}
			
			
            google.visualization.events.addListener(vocabTable, 'select', selectHandler);       
            dashboard.draw(data);
         
		 
			  }
			google.charts.setOnLoadCallback(drawChart);
		
      </script>
	  
	  <div id='displayVocabDetail'></div>
	 
	 <?php require('footer.php');?>
   </body>
</html>
