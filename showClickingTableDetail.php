<?php

	session_start();
	require_once 'connect_db.php';

	if(!isset($_COOKIE["username"]) && !isset($_COOKIE["email"]) )
		header("Location: login.php");
	
	if(!isset($_POST["vocabId"]))
	{
		header("Location: showClickingTable.php");
	}
	
	echo "
	  <body>
	  <div id = 'vocabDetailContainer' style = 'width: 700px; height: 400px; margin: 70 auto'></div>
	  <script language = 'JavaScript'>
	  function drawLineChart() {
            var vocabData = new google.visualization.DataTable();
            vocabData.addColumn('string', 'Month');
            vocabData.addColumn('number', 'Vocabulary ID : " .$_POST["vocabId"]. "');
            vocabData.addRows([";
			require_once 'connect_db.php';
					
					$findVocabDetail = "SELECT CONCAT(YEAR(checkTime),'-',MONTH(checkTime)) AS Month, count(vocabId) FROM checkinghistory  WHERE checkTime between DATE_SUB(now(), INTERVAL 12 MONTH) and now() AND vocabId = ? GROUP BY Month ;";
					
					if($stmt = mysqli_prepare($link, $findVocabDetail))
					{
						
						mysqli_stmt_bind_param($stmt, "s",   $_POST["vocabId"]);
						
						mysqli_stmt_execute($stmt);
						
						 mysqli_stmt_bind_result($stmt, $month , $checkTime);
						 
						 while(mysqli_stmt_fetch($stmt)){
								echo "['".$month."', ".$checkTime."],";
							}

						mysqli_stmt_close($stmt);
						
						mysqli_close($link);
					}else
					{
						echo "Cannot obtain the vocabulary information. Please connect to the IT department.";
					}

	echo "]);";
	
	echo "var vocabDetailOptions = {'title' : 'The Checking History of Vocabulary ID : ".$_POST["vocabId"]."',
               hAxis: {
                  title: 'Month'
               },
               vAxis: {
                  title: 'Check Total '
               },   
               'width':700,
               'height':400,
               pointsVisible: true
            };
			
			var detailchart = new google.visualization.LineChart(document.getElementById('vocabDetailContainer'));
		
		
			
			function selectMonthHandler() {
			var selectedMonthItem = detailchart.getSelection()[0];
			var svocabID = vocabData.getColumnLabel(selectedMonthItem.column);
            svocabID = svocabID.replace( /^\D+/g, '');
			
			if (selectedMonthItem) {
				var vocabMonth = vocabData.getValue(selectedMonthItem.row,0);
				$(function(){
				$.ajax({
						type: 'POST',
						url: 'showClickingTableUserDetail.php',
						data: {
							\"vocabMonth\": vocabMonth,
							\"svocabID\" : svocabID
						},
						success: function(data) {
							 $('#displayVocabCheckingUser').html(data);
							 
					   }
				});
			});
				}
			}

            google.visualization.events.addListener(detailchart, 'select', selectMonthHandler);
			
			
            detailchart.draw(vocabData, vocabDetailOptions);
         
			}
			google.charts.setOnLoadCallback(drawLineChart);
			</script>
			<div id='displayVocabCheckingUser'></div>
			</body>";
			
?>
