
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>CRRS Reports</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="./js/jquery-1.6.1.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/dashboard.js"></script> 
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script>
    		$(document).ready(function(){
    			$("#reportDatePicker").datepicker({
    			//	minDate : "+0"
    			});
    			$("#reportDatePicker").datepicker( "setDate", new Date());
    			$("#reportDatePicker").empty();
    			var date = $('input#reportDatePicker').val();
    			var url = "http://localhost/crrs/?c=crr&m=getPatronCount&date="+date;
	$('#report_view').empty();
	$('#report_view').load(url);
				
    		})
    	</script>
		
		<style>
			#reportDatePicker{
				position: relative;
				font-size: 18px;
				color: #b31b1b;
				font-weight: bold;
			}
			
			#report_view{
				width: 500px;
				height: 600px;
				border: 1px solid white;
				margin-left:auto;
				margin-right:auto;
				overflow-y: auto;
			}
			
		</style>
	</head>
	<body>

		<div id="headerContainer">
			<a href="<?php echo base_url(); ?>" target="_self"> <div id="header"></div> </a>
		</div>
		<div id="menu">
			<div id="menuItems">

			</div>

		</div>
		<h1 style="color: #b31b1b; text-align: center;">Patron Count Report</h1>
		<div style="width: 1000px; margin-left:auto; margin-right: auto;">
  			<p id="pickDate">Select a date: <input type="text" name="viewDate" id="reportDatePicker" value="" /></p>
 			
 		</div>
		
		<div id="report_view">
			
		
		</div>
				
			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://localhost/crrs/?c=crr&m=ack" target="_blank" >Acknowledgement</a> 
				</p>

			</div>
			<script type="text/javascript" src="./js/dashboard.js"></script> 
			
	</body>
	<script>
	$('#reportDatePicker').change(function() {
	var date = $('input#reportDatePicker').val();
	var url = "http://localhost/crrs/?c=crr&m=getPatronCount&date="+date;
	$('#report_view').empty();
	$('#report_view').load(url);
	});
	</script>
</html>
