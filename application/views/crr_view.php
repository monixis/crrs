
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
		 <script type="text/javascript" src="./js/dashboard.js"></script>
		<script>
    		$(document).ready(function(){
    			$("#datepicker").datepicker({
    				minDate : "+0"
    			});
    			$("#datepicker").datepicker( "setDate", new Date());
    		$("#datepicker").empty();
    	 
			var availableTags = [];
				<?php 
				foreach($emails as $row){
				?>
				availableTags.push('<?php echo $row -> email;?>');
				<?php }	?>
				<?php 
				foreach($rooms as $row2){
				?>
				availableTags.push('<?php echo $row2 -> roomNum;?>');
				<?php }	?>
				<?php 
				foreach($resId as $row3){
				?>
				availableTags.push('<?php echo $row3 -> resId;?>');
				<?php }	?>
        		$( "#tfq" ).autocomplete({
      			source: availableTags
			    });		
    		})
    	</script>
		<style type="text/css">
			#tfnewsearch{
				float:center;
				padding:20px;
			}
			.tftextinput2{
				margin: 0;
				padding: 5px 15px;
				font-family: Arial, Helvetica, sans-serif;
				font-size:14px;
				color:#666;
				border:1px solid BLACK; border-right:0px;
				border-top-left-radius: 5px 5px;
				border-bottom-left-radius: 5px 5px;
			}
			.tfbutton2 {
				margin: 0;
				padding: 5px 7px;
				font-family: Arial, Helvetica, sans-serif;
				font-size:14px;
				font-weight:bold;
				outline: none;
				cursor: pointer;
				text-align: center;
				text-decoration: none;
				color: #ffffff;
				border: solid 1px BLACK; border-right:0px;
				background: BLACK;
				background: -webkit-gradient(linear, left top, left bottom, from(#CB1313), to(#CB1313));
				background: -moz-linear-gradient(top,  BLACK,  #CB1313);
				border-top-right-radius: 5px 5px;
				border-bottom-right-radius: 5px 5px;
			}
			.tfbutton2:hover {
				text-decoration: none;
				background: BLACK;
				background: -webkit-gradient(linear, left top, left bottom, from(#970909), to(#970909));
				background: -moz-linear-gradient(top,  #0095cc,  #00678e);
			}
			/* Fixes submit button height problem in Firefox */
			.tfbutton2::-moz-focus-inner {
			  border: 0;
			}
			.tfclear{
				clear:both;
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
				
		<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Room Reservation System</h1>
		<div id="passcode" style="margin-top:0px; margin-left: auto; margin-right: auto; width: 300px; height: 0px;">
 							<strong>PASSCODE: </strong>
							<input type="password" name='passcode' id='passcode' style="height:23px; margin-left: 10px;"></input><br/>
							<input type="button" class="btn" id="submit" value="Submit" style="margin-left:95px; margin-top:10px; width:100px;"></input>
		</div>
				
		<div id="date">
			
				<div id="tfheader">
					
					        <input type="text" id="tfq" class="tftextinput2" name="q" value="Search our website"><input type="submit" value=">" class="tfbutton2"><br>
					        <input type="radio" checked name="searchBy" value="room">Room#
							<input type="radio" name="searchBy" value="resId">Reservation ID
							<input type="radio" name="searchBy" value="email">Email
							<!-- <input type="radio" name="searchBy" value="" -->
					
					<div class="tfclear"></div>
				</div>
					
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
			<script type="text/javascript">
			
				$("input#submit").click(function(){
				var passcode = <?php print_r($passcode);?>;
				var pcode = $("input#passcode").val();
				if (passcode == pcode){
					$("#date, #dashboard_view").css("visibility", "visible");
					$("div#passcode").css("visibility", "hidden");
					$('#dashboard_view').load('http://localhost/collabRoomReserveSystem/?c=crr&m=todayReservation');
				}else{
					$("input#passcode").css('border', '3px solid red');
					setTimeout(function(){
						$("input#passcode").css('border', '1px solid grey');
					}, 2000)
				}	
			});
			
			$('#passcode').keypress(function(e){
				var key = e.which;
				if(key == 13){
				var passcode = <?php print_r($passcode);?>;
				var pcode = $("input#passcode").val();
				if (passcode == pcode){
					$("#date, #dashboard_view").css("visibility", "visible");
					$("div#passcode").css("visibility", "hidden");
					$('#dashboard_view').load('http://localhost/collabRoomReserveSystem/?c=crr&m=todayReservation');
				}else{
					$("input#passcode").css('border', '3px solid red');
					setTimeout(function(){
						$("input#passcode").css('border', '1px solid grey');
					}, 2000)
				}}
			});
			
			</script>
	</body>
</html>
