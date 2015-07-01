
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
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 
		<script>
    		$(document).ready(function(){
    			$("#datepicker").datepicker({
    				minDate : "+0"
    			});
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
			
			
			<!--table id="keyTable" style="width:100%">
  				<tr>
  					<td style="background-color: GREEN"></td>
  					<td>= Available</td>
  				</tr>
  				<tr>
  					<td style="background-color: YELLOW"></td>
  					<td>= Unverified</td>
  				</tr>
  				<tr>
  					<td style="background-color: RED"></td>
  					<td>= Reserved</td>
  				</tr>
  				<tr>
  					<td style="background-color: ORANGE"></td>
  					<td>= Reservation Expired</td>
  				</tr>
  			</table-->
  			<p id="pickDate">Pick a date to view available rooms: <input type="text" name="viewDate" id="datepicker" value="<?php $date = getdate(); echo($date["mon"]. "/" . $date["mday"]. "/" . $date["year"]); ?>" /></p>
 			<p id="viewDate">Date Being Viewed: 
 				<script type="text/javascript">
 				document.write($("#datepicker").val());
 				$( "#datepicker" ).change(function() {
 					// alert( "Handler for .change() called." );
 					document.getElementById("viewDate").innerHTML = "Date Being Viewed: " + $("#datepicker").val();
				});
 				</script> 
 			</p>
		</div>
		
		<div id="dashboard">
			<?php foreach ($hours as $row1) {
					$stime = $row1 -> starttime;
					$totalhrs = $row1 -> totalhrs;
			} ?>
			
			<table id="resTable">
  			
  				<tr>
  					<th>Time</th>
  					  
  				<?php 
  				 $totalrooms = 0;
  				foreach ($rooms as $row) {
					  $roomNum = $row -> roomNum;
					  $totalrooms =  $totalrooms +1; 
				?>
				<th><?php echo $roomNum; ?></th>
				 <?php  } ?>
  				</tr>
  				
  				<?php 
  				$currtime = $stime;
				$y = 0;
				$time = "am";
  				while ($y < $totalhrs){
  					if ($y == 0){
  						$currtime = $stime;
  					}else{
  						$currtime = $currtime + 1 ;
  					}
  									
					if ($currtime == 13)
					{
						$currtime = 1;
						if ($time == "am"){
							$time = "pm";
						}else{
							$time = "am";
						}
						
					}
					$y = $y + 1;
					$currtime = $currtime . " " . $time;
  				?>	<tr>
  						<td><?php echo $currtime; ?></td>
  						
  						<?php 
							for ($i =0; $i < $totalrooms ; $i++){
								?><td></td>
						<?php
							}					  						
  						?>
  						
  				    </tr>
  				<?php }	?>  				
			
			</table>
			
		</div>	
		
		<!--div>
			<button id="resButton" onclick="location.href='<?php echo base_url("?c=crr&m=reserveform"); ?>'">
     Reserve Form</button>
    	</div-->	
				
			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2014 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> 
				</p>

			</div>
			
	</body>
</html>
