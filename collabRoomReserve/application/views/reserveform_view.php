<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="http://library.marist.edu/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<!-- <script src="./js/jquery.rss.js" type="text/javascript" charset="utf-8"></script> --> 
    	<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 
    	<link rel="stylesheet" href="./styles/captcha.css" type="text/css" />
		<script type="text/javascript" src="./js/jquery.simpleCaptcha-0.2.js"></script>
		
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/jquery.timepicker.min.js"></script> 
		<script type="text/javascript" src="./js/jquery.datepair.js"></script> 
		<script type="text/javascript" src="./js/datepair.js"></script>
		<script type="text/javascript" src="./js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/validate.js"></script>
		<link rel="stylesheet" type="text/css" href="./styles/bootstrap-datepicker.css" />
    	<link rel="stylesheet" href="./styles/jquery.timepicker.css" type="text/css" />
		
		
		
		<script>
		$(document).ready(function() {
			$("#dateStart").datepicker({
				minDate : "+0"
			});
			$("#timeStart").timepicker({
				minTime : "8:00am",
				maxTime : "2:00am",
				step : "60"
			});
			$("#timeEnd").timepicker({
				minTime : "8:00am",
				maxTime : "2:00am",
				step : "60"
			});
	
	
		})
		</script>
		<script type="text/javascript" charset="utf-8">
  		$(document).ready(function(){
   	 		$("a[rel^='prettyPhoto']").prettyPhoto();
  		});
		</script>
		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-55162672-1', 'auto');
			ga('send', 'pageview');

       </script>
       <style>
			@-moz-document url-prefix() {
				#searching {
				margin-left: 270px;
			}
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

		

			
				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" /></div>			
				<div id="crroptions" style="margin-bottom: 5px;">
					

					<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Room Reservation</h1>
					<!--div id="options"><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer?iframe=true&width=47%&height=55%"); ?>" rel="prettyphoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div-->
				<div id="options"><a href="<?php echo base_url(); ?>" title="Home" target="_self"><img class="mainoptions" src="./icons/home.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=crr&m=disclaimer&iframe=true&width=47%&height=55%"); ?>" rel="prettyPhoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div>
				
				</div>
				
		
					
				
				
				<div align="center">

					<h1 class="page_head">Room Reserve Form</h1>

					<table style="height: 70%; width:50%;">
						<tr>
							<td width="75%" align="left">
							<FORM NAME="theForm" ID="theForm" ACTION="#" METHOD="POST">
								<TABLE width="700px">
									<TR>
										<TD class="formLabel">Room #:</TD>
										<td class ="ask_input" colspan="3">
										<INPUT required TYPE="text" NAME="roomNum" SIZE="60" class="ask_text_input" />
										</TD>
									</TR>
									
									<TR>
										<TD class="formLabel">Reserve Date:</TD>
										<td class ="ask_input">
										<INPUT required TYPE="text" NAME="resDate" id="dateStart" SIZE="13" class="ask_text_input" />
										<label class="formLabel">From: </label><INPUT required TYPE="text" NAME="timeStart" id="timeStart" SIZE="13" class="ask_text_input" />
										<label class="formLabel"> to</label> <INPUT required TYPE="text" NAME="timeEnd" id="timeEnd" SIZE="13" class="ask_text_input" />
										
										
									</TR>
									<TR>
										<TD class="formLabel">Booking Type:</TD>
										<td class="ask_input">
										<select name ="bookType" SIZE="1">
											<option value="person">In Person</option>
											<option value="phone">By Phone</option>
										</select>
										</TD>
									</TR>
									<TR>
										<TD class="formLabel">Primary Patron Email:</TD>
										<td class="ask_input">
										<INPUT required TYPE="text" NAME="primEmail" SIZE="60" class="ask_text_input" />
										<br>
										<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
									</TR>
									<TR>
										<TD class="formLabel">Secondary Patron Email:</TD>
										<td class="ask_input">
										<INPUT required TYPE="text" NAME="secEmail" SIZE="60" class="ask_text_input" />
										<br>
										<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
									</TR>
									<TR>
										<TD class="formLabel"> Comments (optional):
										<br>
										</TD>
										<td class ="ask_input" colspan="3">							<textarea NAME="Comments" ROWS="10" COLS="43" ></textarea></TD>
									</TR>
									
						<table width="600px">
						<tr>
							<td>
							<center>
								<div id='captcha1'></div>
								<p style="width: 150px; position:relative; left:50%; margin-left:-350px;">

									<INPUT name="submit" value="Submit" id="submit" TYPE="submit">
									<INPUT name="reset" TYPE="reset" id="reset">
						
								</p>
							</center></td>
						</tr>
					</table>
					</form>
					</div>
					
				
			
				
				
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
