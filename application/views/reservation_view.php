
<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 

</script>
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
	}
?>
<title><?php echo $resId; ?></title>	
<script>
	$(document).ready(function(){
		if(<?php echo $statusId; ?> == 1){
			$("#color").addClass("reserved");
		}else if (<?php echo $statusId; ?> == 2){
			$("#color").addClass("unverified");
		}
	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 350px; float:left; ">
		</div>
		<div style="float:right; width:440px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<p>#<?php echo $resId; ?></p>
		</div>
		
	</div>
	<p class="resDet"><label class="label">Room No: </label><?php echo $roomNum; ?></p>
	<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
	<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?></p>
	<p class="resDet"><label class="label">Reserved By:</label><?php echo $resEmail; ?></p>
	<p class="resDet"><label class="label">Status:</label><?php echo $status; ?></p>
	<button type="button" class="btn" style="margin-left:56px; margin-top:5px;">Keys Returned</button>
	<button type="button" class="btn" style="margin-left:56px; margin-top:5px;">Cancel Reservation</button>
</div>
