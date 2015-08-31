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
		<script type="text/javascript" src="./js/jquery-1.6.1.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script>
    		$(document).ready(function(){
    			$("#datepicker").datepicker({
    				minDate : "+0"
    			});
    			$("#datepicker1").datepicker({
    				minDate : "+0"
    			});
    		});
    	</script>
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
			<div id="adminSelection">
				<FORM NAME="freezeForm" ID="freezeForm" ACTION="#" METHOD="POST">	
				<p><label class="label">Deselect Hours to Freeze: </label></p></br>
				<input type="checkbox" name="frozenHrs[]" value="1" checked>12:00AM
				<input type="checkbox" name="frozenHrs[]" value="2" checked>12:30AM
				<input type="checkbox" name="frozenHrs[]" value="3" checked>1:00AM
				<input type="checkbox" name="frozenHrs[]" value="4" checked>1:30AM
				<input type="checkbox" name="frozenHrs[]" value="5" checked>2:00AM
				<input type="checkbox" name="frozenHrs[]" value="6" checked>2:30AM
				<input type="checkbox" name="frozenHrs[]" value="7" checked>3:00AM
				<input type="checkbox" name="frozenHrs[]" value="8" checked>3:30AM
				<input type="checkbox" name="frozenHrs[]" value="9" checked>4:00AM
				<input type="checkbox" name="frozenHrs[]" value="10" checked>4:30AM</br>
				<input type="checkbox" name="frozenHrs[]" value="11" checked>5:00AM
				<input type="checkbox" name="frozenHrs[]" value="12" checked>5:30AM
				<input type="checkbox" name="frozenHrs[]" value="13" checked>6:00AM
				<input type="checkbox" name="frozenHrs[]" value="14" checked>6:30AM
				<input type="checkbox" name="frozenHrs[]" value="15" checked>7:00AM
				<input type="checkbox" name="frozenHrs[]" value="16" checked>7:30AM
				<input type="checkbox" name="frozenHrs[]" value="17" checked>8:00AM
				<input type="checkbox" name="frozenHrs[]" value="18" checked>8:30AM
				<input type="checkbox" name="frozenHrs[]" value="19" checked>9:00AM
				<input type="checkbox" name="frozenHrs[]" value="20" checked>9:30AM</br>
				<input type="checkbox" name="frozenHrs[]" value="21" checked>10:00AM
				<input type="checkbox" name="frozenHrs[]" value="22" checked>10:30AM
				<input type="checkbox" name="frozenHrs[]" value="23" checked>11:00AM
				<input type="checkbox" name="frozenHrs[]" value="24" checked>11:30AM
				<input type="checkbox" name="frozenHrs[]" value="25" checked>12:00PM
				<input type="checkbox" name="frozenHrs[]" value="26" checked>12:30PM
				<input type="checkbox" name="frozenHrs[]" value="27" checked>1:00PM
				<input type="checkbox" name="frozenHrs[]" value="28" checked>1:30PM
				<input type="checkbox" name="frozenHrs[]" value="29" checked>2:00PM
				<input type="checkbox" name="frozenHrs[]" value="30" checked>2:30PM</br>
				<input type="checkbox" name="frozenHrs[]" value="31" checked>3:00PM
				<input type="checkbox" name="frozenHrs[]" value="32" checked>3:30PM
				<input type="checkbox" name="frozenHrs[]" value="33" checked>4:00PM
				<input type="checkbox" name="frozenHrs[]" value="34" checked>4:30PM
				<input type="checkbox" name="frozenHrs[]" value="35" checked>5:00PM
				<input type="checkbox" name="frozenHrs[]" value="36" checked>5:30PM
				<input type="checkbox" name="frozenHrs[]" value="37" checked>6:00PM
				<input type="checkbox" name="frozenHrs[]" value="38" checked>6:30PM
				<input type="checkbox" name="frozenHrs[]" value="39" checked>7:00PM
				<input type="checkbox" name="frozenHrs[]" value="40" checked>7:30PM</br>
				<input type="checkbox" name="frozenHrs[]" value="41" checked>8:00PM
				<input type="checkbox" name="frozenHrs[]" value="42" checked>8:30PM
				<input type="checkbox" name="frozenHrs[]" value="43" checked>9:00PM
				<input type="checkbox" name="frozenHrs[]" value="44" checked>9:30PM
				<input type="checkbox" name="frozenHrs[]" value="45" checked>10:00PM
				<input type="checkbox" name="frozenHrs[]" value="46" checked>10:30PM
				<input type="checkbox" name="frozenHrs[]" value="47" checked>11:00PM
				<input type="checkbox" name="frozenHrs[]" value="48" checked>11:30PM
				<p><label class="label">From: <input type="text" name="fromDate" id="datepicker" value="" /></label></p>
				<p><label class="label">To: <input type="text" name="toDate" id="datepicker1" value="" /></label></p></br>
				Check Any instructions you wish to delete.</br>
				<?php 
					$getHour = array(1 => "12:00AM", 2 => "12:30AM", 3 => "1:00AM", 4 => "1:30AM", 5 => "2:00AM", 6 => "2:30AM", 7 => "3:00AM", 8 => "3:30AM", 9 => "4:00AM",
					 10 => "4:30AM", 11 => "5:00AM",12 => "5:30AM", 13 => "6:00AM", 14 => "6:30AM", 15 => "7:00AM", 16 => "7:30AM", 17 => "8:00AM", 18 => "8:30AM", 
					 19 => "9:00AM", 20 => "9:30AM", 21 => "10:00AM", 22 => "10:30AM", 23 => "11:00AM", 24 => "11:30AM", 25 => "12:00PM", 26 => "12:30PM", 
					 27 => "1:00PM", 28 => "1:30PM", 29 => "2:00PM", 30 => "2:30PM", 31 => "3:00PM", 32 => "3:30PM", 33 => "4:00PM", 34 => "4:30PM", 35 => "5:00PM", 
					 36 => "5:30PM", 37 => "6:00PM", 38 => "6:30PM", 39 => "7:00PM", 40 => "7:30PM", 41 => "8:00PM",42 => "8:30PM", 43 => "9:00PM", 44 => "9:30PM", 
					 45 => "10:00PM", 46 => "10:30PM", 47 => "11:00PM", 48 => "11:30PM");
					 $cnt = 1;
					foreach($details as $row1){
						$startDate = $row1 -> startDate;
						$endDate = $row1 -> endDate;
						$hrId = $row1 -> hourId;
						$id = $row1 -> iid;
						echo "<input type='checkbox' name='instruction[]' value='" . $id . "'>Instruction# " . $cnt . "- Start Date: " . $startDate . " End Date: " . $endDate . " at " . $getHour[$hrId] . "</br>";
						$cnt++;
						 
					}
				?>
				<input name="submit" value="Apply Changes" id="freeze" type="submit" class="btn" style="margin-left:56px; margin-top:5px;"/>
				<!--button type="submit" class="btn" id="freeze" style="margin-left:56px; margin-top:5px;">Freeze</button-->
				</form>
				
			</div>	
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
