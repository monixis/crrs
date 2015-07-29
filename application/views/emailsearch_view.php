<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</script>

		<div style="float:right; width:440px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<p><?php echo $searchText; ?>'s Reservations</p>
		</div>
		
	
<?php 
	foreach($details as $row){
		$resId = $row -> resId;
		$resDate = $row -> resDate;
		$startTime = $row -> startTime;
		$resEmail = $row -> resEmail;
		$resType = $row -> resType;
		$roomNum = $row -> roomNum;
		$status = $row -> status;
		$statusId = $row -> statusId;
	
?>
<title> <?php echo $resEmail; ?> Reservations</title>	
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 350px; float:left; ">
		</div>
	</div>

	<p class="resDet"><label class="label">Reservation ID: </label><?php echo $resId; ?></p>
	<p class="resDet"><label class="label">Room#:</label><?php echo $roomNum; ?></p>
	<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
	<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?></p>
	<p class="resDet"><label class="label">Status:</label><?php echo $status; ?></p>
</div>

</br>
<?php } ?>