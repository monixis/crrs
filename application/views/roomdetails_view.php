<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 
<?php 
	foreach($details as $row){
		$roomNum = $row -> roomNum;
		$seats = $row -> seats;
		$computers = $row -> computers;
		$printers = $row -> printers;
		$scanners = $row -> scanners;
		$whiteboards = $row -> whiteboards;
	}
?>
<title><?php echo $resId; ?></title>	
<script>
	$(document).ready(function(){
			$("#color").addClass("details");
	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 350px; float:left; ">
		</div>
		<div style="float:right; width:440px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">Room # <?php echo $roomNum; ?></p>
		</div>
	</div>
	
	<p class="resDet"><label class="label">Seats: </label><?php echo $seats; ?></p>
	<p class="resDet"><label class="label">Computers: </label><?php echo $computers; ?></p>
	<p class="resDet"><label class="label">Printers: </label><?php echo $printers; ?></p>
	<p class="resDet"><label class="label">Scanners: </label><?php echo $scanners; ?></p>
	<p class="resDet"><label class="label">Whiteboards: </label><?php echo $whiteboards; ?></p>
	
</div>