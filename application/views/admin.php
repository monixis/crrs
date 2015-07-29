<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>Admin Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
	</head>
	
	<body>
		<div id="headerContainer">
			<a href="<?php echo base_url(); ?>" target="_self"> 
				<div id="header"></div>
			</a>	
		</div>
		
		<div id="menu">
			<div id="menuItems">

			</div>
		</div>

		<div class = "container_home">
				
					<h1 style="color: #b31b1b; text-align: center;">Admin - JAC Collaboration Room Reservation System</h1>
				
				<FORM NAME="theForm" ID="theForm" ACTION="#" METHOD="POST">	
						
						<p class="resDet"><label class="label">Start Time: </label><SELECT name="startTime" value="" size="1">
							<option value="7">7:00</option>
							<option value="8">8:00</option>
							<option value="9">9:00</option>
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
							<option value="19">19:00</option>
							<option value="20">20:00</option>
							<option value="21">21:00</option>
							<option value="22">22:00</option>
							<option value="23">23:00</option>
							<option value="24">24:00</option>
							<option value="1">1:00</option>
							<option value="2">2:00</option>
							<option value="3">3:00</option>
							<option value="4">4:00</option>
							<option value="5">5:00</option>
							<option value="6">6:00</option>
						</select>
						</p>
						<p class="resDet"><label class="label">Hours Open: </label><SELECT NAME="numHrs" value="" SIZE="1">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
						</select>
						</p>
						<p class="resDet"><label class="label">Check any rooms that are unavailable: </label>
						</br>
						<span style="position: relative; left:400px;">
						<input type="checkbox" name="unavailRoom[]" value="110">110</input>
						<input type="checkbox" name="unavailRoom[]" value="111">111</input>
						<input type="checkbox" name="unavailRoom[]" value="112">112</input>
						<input type="checkbox" name="unavailRoom[]" value="300A">300A</input></br>
						<input type="checkbox" name="unavailRoom[]" value="300B">300B</input>
						<input type="checkbox" name="unavailRoom[]" value="300C">300C</input>
						<input type="checkbox" name="unavailRoom[]" value="300D">300D</input>
						<input type="checkbox" name="unavailRoom[]" value="306">306</input></br>
						<input type="checkbox" name="unavailRoom[]" value="312">312</input>
						<input type="checkbox" name="unavailRoom[]" value="313">313</input>
						<input type="checkbox" name="unavailRoom[]" value="314">314</input>
						<input type="checkbox" name="unavailRoom[]" value="315">315</input></br>
						<input type="checkbox" name="unavailRoom[]" value="316">316</input>
						<input type="checkbox" name="unavailRoom[]" value="317">317</input>
						<input type="checkbox" name="unavailRoom[]" value="318">318</input>
						</span>
						</p> 
						
						
								
					<input name="submit" value="Apply Changes" id="submit" type="submit" class="btn" style="margin-left:56px; margin-top:5px;"/>
					<!--input name="reset" type="reset" id="reset" class="btn" style="margin-left:56px; margin-top:5px;"/-->
					</form>
			</div>

			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2014 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" rel="prettyphoto[iframes]">Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy </a> 
				</p>

			</div>
	</body>
</html>
