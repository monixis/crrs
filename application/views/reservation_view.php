<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 
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
		$totalHours = $row -> totalHours;
	}
?>
<title><?php echo $resId; ?></title>	
<script>
	$(document).ready(function(){
		if(<?php echo $statusId; ?> == 1){
			$("#color").addClass("reserved");
		}else if (<?php echo $statusId; ?> == 2){
			$("#color").addClass("unverified");
		}else if (<?php echo $statusId; ?> == 4){
			$("#color").addClass("transactionComplete");
		}
	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 350px; float:left; ">
		</div>
		<div style="float:right; width:440px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">#<?php echo $resId; ?></p>
		</div>
	</div>
	
	<p class="resDet"><label class="label">Room No: </label><?php echo $roomNum; ?></p>
	<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
	<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?></p>
	<p class="resDet"><label class="label">Reserved By:</label><?php echo $resEmail; ?></p>
	<p class="resDet"><label class="label">Status:</label><?php echo $status; ?></p>
	<?php if ($status == 'Reserved'){?>
		<button type="button" class="btn" id="returned" style="margin-left:56px; margin-top:5px;">Keys Returned</button>
	<?php } else if ($status == 'Unverified'){?>
		<button type="button" class="btn" id="verify" style="margin-left:56px; margin-top:5px;">Verify and Reserve</button>
	<?php } ?>
	
	<button type="button" class="btn" id="canceled" style="margin-left:56px; margin-top:5px;">Cancel Reservation</button>
</div>
<script type="text/javascript">
$('#returned').click(function(){
	var resId = $('#resId').text();
	resId= resId.replace('#','');
	var status = 4;	
	//var totalHours = <?php echo $totalHours ;?>;
	//for(var i=0; i<totalHours; i++){
		//var resId1 = parseInt(resId);
	//	resId1 = resId1 + i;
		$.post("<?php echo base_url("?c=crr&m=updateStatus"); ?>",{resId: resId, status: status}).done(function(data){
							if (data == 1){
									$('#confirmations').append("<img src='./icons/tick.png'/>");
							}else{
									$('#confirmations').append("<img src='./icons/error.png'/>");	alert(data);
								}
		});
	
	//}
});

$('#canceled').click(function(){
	var resId = $('#resId').text();
	resId= resId.replace('#','');
	var status = 3;	
	$.post("<?php echo base_url("?c=crr&m=updateStatus"); ?>",{resId: resId, status: status}).done(function(data){
							if (data == 1){
									$('#confirmations').append("<img src='./icons/tick.png'/>")
							}else{
									$('#confirmations').append("<img src='./icons/error.png'/>");
									}
	});
	
});

$('#verify').click(function(){
	var resId = $('#resId').text();
	resId= resId.replace('#','');
	var status = 1;	
	$.post("<?php echo base_url("?c=crr&m=updateStatus"); ?>",{resId: resId, status: status}).done(function(data){
							if (data == 1){
									$('#confirmations').append("<img src='./icons/tick.png'/>")
							}else{
									$('#confirmations').append("<img src='./icons/error.png'/>");
									}
	});
	
});
</script>

