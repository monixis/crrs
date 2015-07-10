
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="http://library.marist.edu/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="./js/jquery-1.6.1.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/jquery.prettyPhoto.js"></script> 
		<link rel="stylesheet" type="text/css" href="./styles/prettyPhoto.css" />
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script>
    		$(document).ready(function(){
    			$("#datepicker").datepicker({
    				minDate : "+0"
    			});
    			$("#datepicker").datepicker( "setDate", new Date());
+    		$("#datepicker").empty();
+    	    $('#dashboard_view').load('http://localhost/collabRoomReserveSystem/?c=crr&m=todayReservation');
    		})
    	</script>
		<script type="text/javascript" charset="utf-8">
  		$(document).ready(function(){
   			$("a[rel^='prettyPhoto']").prettyPhoto();
  		});
		</script>
		
	</head>
	<body>

		<div id="headerContainer">
			<a href="<?php echo base_url(); ?>" target="_self"> <div id="header"></div> </a>
		</div>
		<div id="menu">
			<div id="menuItems">

			</div>

		</div>
				
					<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Rooms Reservation System</h1>
				
		<div>
			
			
  			<p id="pickDate">Select a date: <input type="text" name="viewDate" id="datepicker" value="" /></p>
 			<!--p id="viewDate">Date Being Viewed: 
 				<script type="text/javascript">
 				document.write($("#datepicker").val());
 				$( "#datepicker" ).change(function() {
 					// alert( "Handler for .change() called." );
 					document.getElementById("viewDate").innerHTML = "Date Being Viewed: " + $("#datepicker").val();
				});
 				</script> 
 			</p-->
		</div>
		
		<div id="dashboard_view">
			
		
		</div>
				
			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2015 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> 
				</p>

			</div>
			<script type="text/javascript" src="./js/dashboard.js"></script> 
	</body>
</html>
