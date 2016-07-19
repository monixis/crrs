<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>Admin Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<style>
			td{width: 120px;}
		</style>
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
			<div id="adminSelection" style="margin-bottom: 10px;">
				<div id="hours" style="float: left; width: 300px; height: 500px; border-bottom: 1px solid black;">
					<p><label class="label">Select Hours to Freeze: </label></p>
					<table style="width:250px; margin-left: 27px;">
						<tbody style="height:300px; overflow-y:scroll; display:block;">	  
							<?php 
						foreach($hours as $row){
						?>					
  							<tr>
    							<td><input type="checkbox" name="hours" value="<?php echo $row -> id?>" /></td>
    							<td><?php echo $row -> displayhrs?></td> 
  							</tr>
  							<?php		
							}
						?>
  						</tbody>	
					</table>
					<p><label class="label">From: <input type="text" name="fromDate" id="datepicker" value="" style="width: 140px;"/></label></p>
					<p><label class="label">To: <input type="text" name="toDate" id="datepicker1" value="" style="margin-left: 25px; width: 140px;" /></label></p>
					<button type="button" class="btn" id="freeze" style="margin-left:56px;">Freeze</button>
				</div>
				<div id="frozenhours" style="float: right; width: 494px; height: 500px; border-bottom: 1px solid black;">
						<p><label class="label">Frozen Hours: </label></p>
						<table style="margin-left: 10px; width: 475px;">
							<tbody style="height:300px; overflow-y:scroll; display:block;">	
							<tr>
								<th></th>
								<th>Hours</th>
								<th>Start Date</th>
								<th>End Date</th>
							</tr>  
							<?php 
						foreach($instructions as $row){
						?>					
  							<tr>
    							<td><input type="checkbox" name="instructions" value="<?php echo $row -> iid?>" /></td>
    							<td><?php echo $row -> displayhrs ?></td>
    							<td><?php echo $row -> startDate ?></td>
    							<td><?php echo $row -> endDate ?></td> 
  							</tr>
  							<?php		
							}
						?>
  							</tbody>	
						</table>
						<button type="button" class="btn" id="deleteInst" style="margin-left:10px; margin-top:21px;">Remove Instructions</button>
				</div>
				
				<div id="rooms" style="float: left; width: 300px; height: 440px; border-bottom: 1px solid black;">
					<p><label class="label">Select Rooms to Block: </label></p>
					<table style="width:250px; margin-left: 27px;">
						<tbody style="height:300px; overflow-y:scroll; display:block;">	  
							<?php 
						foreach($rooms as $row){
						?>					
  							<tr>
    							<td><input type="checkbox" name="rooms" value="<?php echo $row -> roomNum ?>" /></td>
    							<td><?php echo $row -> roomNum?></td> 
  							</tr>
  							<?php		
							}
						?>
  						</tbody>	
					</table>
					<button type="button" class="btn" id="block" style="margin-left:56px; margin-top: 21px;">Block</button>
				</div>	
				
				<div id="frozenrooms" style="float: right; width: 494px; height: 440px;border-bottom: 1px solid black;">
					<p><label class="label">Blocked Rooms: </label></p>
						<table style="margin-left: 10px; width: 475px;">
							<tbody style="height:300px; overflow-y:scroll; display:block;">	
							<tr>
								<th></th>
								<th>Rooms</th>
							</tr>  
							<?php 
						foreach($blockedrooms as $row){
						?>					
  							<tr>
    							<td><input type="checkbox" name="blockedrooms" value="<?php echo $row -> roomNum?>" /></td>
    							<td><?php echo $row -> roomNum ?></td>
  							</tr>
  							<?php		
							}
						?>
  							</tbody>	
						</table>
						<button type="button" class="btn" id="unblock" style="margin-left:10px; margin-top:21px;">Unblock</button>
				</div>
			</div> <!-- adminSelection ends -->
			
		</div><br/>
		<div align='center' id='tentative'>

			<button type="button" class="btn" id="resetTenative" style="margin-left:10px; margin-top:21px;">Reset Tentative Slots</button>

		</div></br>

			<div class="bottom">
				<p class = "foot"  style="padding-top: 10px;">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" rel="prettyphoto[iframes]">Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy </a> 
				</p>

			</div>
	
	<script type="text/javascript">

	var returnval = 0;
	var cnt = 0;
	var hoursId = [];
	var iidArray = [];
	var roomNo = [];
	var roomNumArray = [];
	$('#freeze').click(function(){
			var startDate = $('input#datepicker').val();
			var endDate = $('input#datepicker1').val();
			//$("input[name=hours]:checkbox:not(:checked)").each(function(){
			$("input[name=hours]:checked").each(function(){	
				var hourId = $(this).attr('value');
				hoursId.push(hourId);
			});
			$.post("<?php echo base_url("?c=crr&m=setInstructions"); ?>",{startDate: startDate, endDate: endDate, hoursId: hoursId}).done(function(data){
					if (data == 1){
						alert("Instructions set successfully");
						location.reload();
					}else{
						alert('Error in setting the instructions');
					}
			});
	});
	$('#resetTenative').click(function() {

		$.get("<?php echo base_url("?c=crr&m=clearini"); ?>").done(function(data){
			if (data == 1){
				alert("Reset Successful");
				location.reload();
			}else{
				alert('Failed to reset tentative slots');
			}


	    });
	});
		$('#deleteInst').click(function(){
		$("input[name=instructions]:checked").each(function(){
				var iid = $(this).attr('value');
				iidArray.push(iid);
		});
	
		$.post("<?php echo base_url("?c=crr&m=removeInstructions"); ?>",{iidArray: iidArray}).done(function(data){
					if (data == 1){
						alert("Instructions removed successfully");
						location.reload();
					}else{
						alert('Error in removing the instructions');
					}
			});
		
	});
	
	$('#block').click(function(){
			$("input[name=rooms]:checked").each(function(){	
				var roomNum = $(this).attr('value');
				roomNo.push(roomNum);
				
			});
			$.post("<?php echo base_url("?c=crr&m=blockRooms&s=0"); ?>",{roomNo: roomNo}).done(function(data){
					if (data == 1){
						alert("Instructions set successfully");
						location.reload();
					}else{
						alert('Error in setting the instructions');
					}
			});
	});
	
	$('#unblock').click(function(){
			$("input[name=blockedrooms]:checked").each(function(){	
				var roomNum = $(this).attr('value');
				roomNo.push(roomNum);
				
			});
			$.post("<?php echo base_url("?c=crr&m=blockRooms&s=1"); ?>",{roomNo: roomNo}).done(function(data){
					if (data == 1){
						alert("Instructions set successfully");
						location.reload();
					}else{
						alert('Error in setting the instructions');
					}
			});
	});
		
	</script>		
	</body>
		
</html>
