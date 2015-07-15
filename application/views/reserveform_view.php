<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
    	<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 
		
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		
		<link rel="stylesheet" type="text/css" href="./styles/bootstrap-datepicker.css" />
    	
    	
		
		<script>
		$(document).ready(function() {
			$("#dateStart").datepicker({
				minDate : "+0"
			});
		})
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

		

		</div>

		

		
				
					<h1 style="color: #b31b1b; text-align: center;"><?php echo $title;?></h1>
				
				
		
					
				
				<div align="center">
				<div style="width:36px; height:26px; float:right; margin-top:-65px;"><img  id="close" src="./icons/close.png"/></div>

					<h1 class="page_head">Room Reserve Form</h1>
					<?php 
						$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
						if(substr($resId,11,1) == "A" || substr($resId,11,1) == "B"|| substr($resId,11,1) == "C" || substr($resId,11,1) == "D"){
							$roomNum = substr($resId,8,4);
							$time = substr($resId,12);
						}
						else {
							$roomNum = substr($resId,8,3);
							$time = substr($resId,11);
						}
						
					?>
					<table style="height: 70%; width:50%;">
						<tr>
							<td width="100%" align="left">
							<FORM NAME="theForm" ID="theForm" ACTION="#" METHOD="POST">
								<TABLE width="700px">
									<TR>
										<TD class="formLabel">Room #:</TD>
										<td class ="ask_input" colspan="3">
										<input type="text" name="roomNum" disabled="true" value="<?php echo $roomNum ?>"/>
										</TD>
									</TR>
									<TR>
										<TD class="formLabel">Reserve Date:</TD>
										<td class ="ask_input" colspan+"3">
										<INPUT TYPE="text" disabled="true" NAME="resDate" value="<?php echo $resDate?>" SIZE="13" class="ask_text_input" />
									</TR>
									<TR>
										<TD class="formLabel">Reservation Start Time:</TD>
										<td class="ask_input">
										<input type="text" disabled="true" name ="timeStart" value="<?php echo $time . ":00" ?>">
										<label class="formLabel">for </label>
										<select name ="numHours" value="<?php echo set_value('numHours'); ?>" SIZE="1">
											<option value="<?php echo $time + 1; ?>">1 hour</option>
											<option value="<?php echo $time + 2; ?>">2 hours</option>
											<option value="<?php echo $time + 3; ?>">3 hours</option>
										</select>
									</TR>
									<TR>
										<TD class="formLabel">Booking Type:</TD>
										<td class="ask_input">
										<select name ="bookType" value="<?php echo set_value('bookType'); ?>" SIZE="1">
											<option value="person">In Person</option>
											<option value="phone">By Phone</option>
										</select>
										</br><div style="color:RED"><?php echo form_error('bookType'); ?></div>
										</TD>
									</TR>
									<TR>
										<TD class="formLabel">Primary Patron Email:</TD>
										<td class="ask_input">
										<INPUT TYPE="text" NAME="primEmail" value="<?php echo set_value('primEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('primEmail'); ?></div>
									</TR>	
									<TR>
										<TD>
										</TD>
										<td colspan="3">
											<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
										</td>
									</TR>
									<TR>
										<TD class="formLabel">Secondary Patron Email:</TD>
										<td class="ask_input">
										<INPUT TYPE="text" NAME="secEmail" value="<?php echo set_value('secEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('secEmail'); ?></div>
									</TR>
									<TR>
										<TD>
										</TD>
										<td colspan='3'>
											<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
										</td>
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
								<p>

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
