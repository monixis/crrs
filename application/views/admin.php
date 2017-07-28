<!--
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

	</head>-->

<!--		<div id="headerContainer">
			<a href="<!--?php /*echo base_url(); */?>" target="_self">
				<div id="header"></div>
			</a>	
		</div>
		
		<div id="menu">
			<div id="menuItems">

			</div>
		</div>-->

		<div class = "container_home">
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
				<div id="rooms" style="float: left; width: 300px; height: 540px; border-bottom: 1px solid black;">
					<p><label class="label">Select Rooms to update booking requirements: </label></p>
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
					</table></br>
						<label>Category:
						<select id="cat_drop">
							<?php foreach ($categories as $category){  if($category -> catg_id == 1){?>
                              <?php } else {?>
								<option value="<?php echo $category -> catg_id?>"><?php echo $category -> catg_name?></option>
							<?php }}?>

						</select>
						</label></br></br>
						<label>Patron:

						<select id="pat_drop">
							<?php foreach ($patrons as $patron){ if($patron ->  patr_id== 1) {?>
							<?php } else {?>
								<option value="<?php echo $patron -> patr_id?>"><?php echo $patron -> patr_name;?></option>
							<?php }}?>
						</select>
						</label></br></br>

					<label>Patron Required(Min.)<input type="text" name="patrons_required" id="patron_count" value=""/></label>

					<button type="button" class="btn" id="add" style="margin-left:56px; margin-top: 21px;">Add</button>


				</div>

				<div id="bookingRequirements" style="float: right; width: 494px; height: 540px; border-bottom: 1px solid black;">
					<p><label class="label">Booking Requirements: </label></p>
					<table style="margin-left: 10px; width: 475px;">
						<tbody style="height:400px; overflow-y:scroll; display:block;">
						<tr>
							<th></th>
							<th>Room</th>
							<th>Patron</th>
							<th>Category</th>
							<th>Patron Required</th>

						</tr>
						<?php
						foreach($bookingRequirements as $row){
							?>
							<tr>
								<td><input type="checkbox" name="requirements" value="<?php echo $row -> id?>" /></td>
								<td><?php echo $row -> roomNum ?></td>
								<td><?php echo $row -> patr_name ?></td>
								<td><?php echo $row -> catg_name ?></td>
								<td><?php echo $row -> patr_req ?></td>

							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<button type="button" class="btn" id="deleteReqs" style="margin-left:10px; margin-top:21px;">Remove Requirements</button>
				</div>
			</div> <!-- adminSelection ends -->

		</div><br/>
		<div align='center' id='tentative'>

			<button type="button" class="btn" id="resetTenative" style="margin-left:10px; margin-top:21px;">Reset Tentative Slots</button>

		</div></br>



	<script type="text/javascript">

	var returnval = 0;
	var cnt = 0;
	var hoursId = [];
	var iidArray = [];
	var idArray = [];
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
						var pass = "<?php echo $pass ?>";
						$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
						//location.reload();
					}else{
						alert('Error in setting the instructions');
					}
			});
	});
	$('#resetTenative').click(function() {

		$.get("<?php echo base_url("?c=crr&m=clearini"); ?>").done(function(data){
			if (data == 1){
				alert("Reset Successful");
				var pass = "<?php echo $pass ?>";
				$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
				//location.reload();
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
						var pass = "<?php echo $pass ?>";
						$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
						//location.reload();
					}else{
						alert('Error in removing the instructions');
					}
			});

	});

	$('#deleteReqs').click(function(){
		$("input[name=requirements]:checked").each(function(){
			var id = $(this).attr('value');
			idArray.push(id);
		});

		$.post("<?php echo base_url("?c=crr&m=removeBookingRequirements"); ?>",{idArray: idArray}).done(function(data){
				if (data == 1){
					alert("requirements removed successfully");
					var pass = "<?php echo $pass ?>";
					$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
					//location.reload();
				}else{

					alert('Error in removing the requirements');
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
				var pass = "<?php echo $pass ?>";
				$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
				//location.reload();
			}else{
				alert('Error in setting the instructions');
			}
		});
	});
	$('#add').click(function(){
		$("input[name=rooms]:checked").each(function(){
			var roomNum = $(this).attr('value');
			roomNo.push(roomNum);

		});
		var patr_req = $('input#patron_count').val();
		var c = document.getElementById("cat_drop");
		var category_type = c.options[c.selectedIndex].value;

		var p = document.getElementById("pat_drop");
		var patron_type = p.options[p.selectedIndex].value;
		$.post("<?php echo base_url("?c=crr&m=addBookingRequirements"); ?>",{roomNo: roomNo,category_type:category_type,patron_type:patron_type, patr_req: patr_req  }).done(function(data){
			if (data == 1){
				alert("Requirements added successfully");
				var pass = "<?php echo $pass ?>";
				$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);
				//location.reload();
			}else{
				alert('Error in setting the Requirements');
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
						var pass = "<?php echo $pass ?>";
						$('#admin_dashboard').load("<?php echo base_url("?c=crr&m=admin_verify1&pass=");?>"+pass);//http://localhost/crrs/?c=crr&m=todayReservation

						//location.reload();
					}else{
						alert('Error in setting the instructions');
					}
			});
	});
	$(document).ready(function(){
		$("#datepicker").datepicker({
			minDate : "+0"
		});
		$("#datepicker1").datepicker({
			minDate : "+0"
		});
	});
	</script>
