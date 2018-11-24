<?php
		require('header.php');
		if(!isset($_COOKIE["username"])){
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
      </script>
      </script>
   </head>
   
   <body>
      <div id = "container" style = "width: 550px; height: 400px; margin: 60 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Vocabulary ID ');
            data.addColumn('string', 'Vocabulary Name');
            data.addColumn('number', 'Check Total');
            data.addRows([
			<?php
					session_start();
					require_once 'connect_db.php';

					if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
							header("Location: login.php");
	
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

            var options = {
               showRowNumber: true,
               width: '100%', 
               height: '100%',
               pageSize: 5
            };
			
			var chart = new google.visualization.Table(document.getElementById('container'));
			
			function selectHandler() {
			var selectedItem = chart.getSelection()[0];
			if (selectedItem) {
				var vocabId = data.getValue(selectedItem.row,0);
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
			
			
            google.visualization.events.addListener(chart, 'select', selectHandler);       
            chart.draw(data, options);
         
		 
			  }
			google.charts.setOnLoadCallback(drawChart);
		
      </script>
	  
	  <div id='displayVocabDetail'></div>
	 
	 <?php require('footer.php');?>
   </body>
</html>