<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 
<?php 
	foreach($details as $row){
		$roomNum = $row -> roomNum;
		$seats = $row -> seats;
		$computers = $row -> computers;
		$windows = $row -> windows;
		$whiteboards = $row -> whiteboards;
	}
?>	
<script>
	$(document).ready(function(){
			$("#color").addClass("details");
	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height:440px; float:left; ">
		</div>
		<div style="float:right; width:530px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">Room # <?php echo $roomNum; ?></p>
		</div>
	</div>
	
	<p class="resDet"><label class="label">Seats: </label><?php echo $seats; ?></p>
	<p class="resDet"><label class="label">Computers: </label><?php echo $computers; ?></p>
	<p class="resDet"><label class="label">Windows: </label><?php echo $windows; ?></p>
	<p class="resDet"><label class="label">Whiteboards: </label><?php echo $whiteboards; ?></p>
	
</div>