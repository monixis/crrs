
<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/dashboard.js"></script>
<script type="text/javascript" src="./js/freezeheader.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("#resTable").freezeHeader({'height': '600px'});
		var currHour = new Date().getHours();
		var element = document.getElementsByName(currHour)[0];
		element.scrollIntoView();
		var date;
		date = new Date();
		date.setMinutes(date.getMinutes() -15);
		date = date.getFullYear() + '-' +
			('00' + (date.getMonth()+1)).slice(-2) + '-' +
			('00' + date.getDate()).slice(-2) + '|' +
			('00' + date.getHours()).slice(-2) + ':' +
			('00' + date.getMinutes()).slice(-2) + ':' +
			('00' + date.getSeconds()).slice(-2);

		localStorage.setItem("timestamp", date);
		var blocked = [];
		localStorage.setItem("blocked", JSON.stringify(blocked));
	});

</script>
<script>

	$('#close').click(function() {
		$('#shadowBox').css('visibility','hidden');
		var timestamp =localStorage.getItem("timestamp");
		var slotId = localStorage.getItem("slotId");
		var date = $('input#datepicker').val();
		var baseUrl = "<?php echo base_url() ;?>";
		var tentative =  localStorage.getItem("tentative");
		var blockedSlots = JSON.parse(localStorage.getItem("blocked"));

		for (var blockedSlot in  blockedSlots){

			var blockedSlotId = blockedSlots[blockedSlot];
			if(document.getElementById(blockedSlotId)!= null) {

				document.getElementById(blockedSlotId).style.visibility = "visible";
			}

		}
		if(tentative == 1) {
			$.ajax({
				type: "GET",
				url: baseUrl.concat("?c=crr&m=refreshReservations&time=" + timestamp + "&date=" + date + "&slotId=" +slotId),
				data: $(this).serialize(),
				success: function (data) {
					var res = $.parseJSON(data);
					var tentativeslots = res.tentativeSlots;
					var blocked = [];
					for (var tentativeslot in tentativeslots) {
						//slotclass = "tentative";
						var tentativeSlotId = tentativeslots[tentativeslot];
						//document.getElementById(tentativeSlotId).className = slotclass;
						if(document.getElementById(tentativeSlotId)!= null) {
							document.getElementById(tentativeSlotId).style.visibility = "hidden";
						}
						blocked.push(tentativeSlotId);
					}
					localStorage.setItem("blocked", JSON.stringify(blocked));
					var slots = res.slots;
					var rId = 0;
					for (var slot in slots) {
						var resId = slots[slot].resId;
						if(	document.getElementById(resId) != null) {

							if (rId == slots[slot].rId) {

							} else {

								document.getElementById(resId).innerHTML = slots[slot].rId;
								var rId = slots[slot].rId;
							}
							if (slots[slot].status == 1) {
								var slotclass = "reserved";

							} else if (slots[slot].status == 2) {

								var slotclass = "unverified";

							} else if (slots[slot].status == 4) {

								var slotclass = "transactionComplete";
							}
							else{
								var slotclass = "slots";
								document.getElementById(resId).innerHTML = "";
							}
							document.getElementById(resId).className = slotclass;
						}
					}
				}
			});
		} else {
			$.ajax({
				type: "GET",
				url: baseUrl.concat("?c=crr&m=getNewReservations&time=" + timestamp + "&date=" + date),
				data: $(this).serialize(),
				success: function (data) {
					var res = $.parseJSON(data);
					var tentativeslots = res.tentativeSlots;
					var blocked = [];
					for (var tentativeslot in tentativeslots) {
						//slotclass = "tentative";
						var tentativeSlotId = tentativeslots[tentativeslot];
						//document.getElementById(tentativeSlotId).className = slotclass;
						if(document.getElementById(tentativeSlotId)!= null) {
							document.getElementById(tentativeSlotId).style.visibility = "hidden";
						}
						blocked.push(tentativeSlotId);
					}
					localStorage.setItem("blocked", JSON.stringify(blocked));

					var slots = res.slots;
					var rId = 0;
					for (var slot in slots) {
						var resId = slots[slot].resId;
						if(	document.getElementById(resId) != null) {

							if (rId == slots[slot].rId) {

							} else {
								document.getElementById(resId).innerHTML = slots[slot].rId;
								var rId = slots[slot].rId;
							}
							if (slots[slot].status == 1) {
								var slotclass = "reserved";

							} else if (slots[slot].status == 2) {

								var slotclass = "unverified";

							} else if (slots[slot].status == 4) {

								var slotclass = "transactionComplete";

							}
							else{
								var slotclass = "slots";
								document.getElementById(resId).innerHTML = "";
							}
							document.getElementById(resId).className = slotclass;
						}
					}
				}
			});

		}
		var date;
		date = new Date();
		date.setMinutes(date.getMinutes() -15);
		date = date.getFullYear() + '-' +
			('00' + (date.getMonth()+1)).slice(-2) + '-' +
			('00' + date.getDate()).slice(-2) + '|' +
			('00' + date.getHours()).slice(-2) + ':' +
			('00' + date.getMinutes()).slice(-2) + ':' +
			('00' + date.getSeconds()).slice(-2);

		localStorage.setItem("timestamp", date);
	});

</script>
<script>

	$('#refresh').click(function(){

		var date = $('input#datepicker').val();
		var timestamp =localStorage.getItem("timestamp");
		var blockedSlots = JSON.parse(localStorage.getItem("blocked"));
		for (var blockedSlot in  blockedSlots){

			var blockedSlotId = blockedSlots[blockedSlot];
			if(document.getElementById(blockedSlotId)!= null) {

				document.getElementById(blockedSlotId).style.visibility = "visible";
			}
		}
		$.ajax({
			type: "GET",
			url: baseUrl.concat("?c=crr&m=getNewReservations&time=" + timestamp + "&date=" + date),
			data: $(this).serialize(),
			success: function (data) {
				var res = $.parseJSON(data);
				var tentativeslots = res.tentativeSlots;
				var blocked = [];
				for (var tentativeslot in tentativeslots) {
					//	slotclass = "tentative";
					var tentativeSlotId = tentativeslots[tentativeslot];
					//	document.getElementById(tentativeSlotId).className = slotclass;
					if(document.getElementById(tentativeSlotId)!= null) {
						document.getElementById(tentativeSlotId).style.visibility = "hidden";
					}
					blocked.push(tentativeSlotId);
				}
				localStorage.setItem("blocked", JSON.stringify(blocked));

				var slots = res.slots;
				var rId = 0;
				for (var slot in slots) {
					var resId = slots[slot].resId;
					if(	document.getElementById(resId) != null) {

						if (rId == slots[slot].rId) {

						} else {
							document.getElementById(resId).innerHTML = slots[slot].rId;
							var rId = slots[slot].rId;
						}
						if (slots[slot].status == 1) {
							var slotclass = "reserved";

						} else if (slots[slot].status == 2) {

							var slotclass = "unverified";

						} else if (slots[slot].status == 4) {

							var slotclass = "transactionComplete";

						}else{
							var slotclass = "slots";
							document.getElementById(resId).innerHTML = "";
						}
						document.getElementById(resId).className = slotclass;
					}
				}
			}
		});
		var date;
		date = new Date();
		date.setMinutes(date.getMinutes() -15);
		date = date.getFullYear() + '-' +
			('00' + (date.getMonth()+1)).slice(-2) + '-' +
			('00' + date.getDate()).slice(-2) + '|' +
			('00' + date.getHours()).slice(-2) + ':' +
			('00' + date.getMinutes()).slice(-2) + ':' +
			('00' + date.getSeconds()).slice(-2);

		localStorage.setItem("timestamp", date);
	});

</script>

<div id="dashboard">
	<div id="optionmenu" style="width:1010px; height: 25px; border: 1px solid #ffffff; margin-bottom: 5px; "><img id="refresh" style="width: 25px; float:left;" src="./icons/refresh.png" /><img id="print" style="width: 25px; float:right;" src="./icons/print.png" /><img id="addNotes" class="addNotes" style="width: 25px; float:right; margin-right: 5px;" src="./icons/addNotes.png" /><img id="reports" class="addNotes" style="width: 25px; float:right; margin-right: 5px;" src="./icons/reports.png" /></div>
	<div id="shadowBox"><iframe id="shadowFrame"></iframe><div style="width:36px; height:26px; float:right; margin-top:3px;"><img id="close"  src="./icons/close.png"/>
		</div></div>
	<?php

	$reservedslots = array();
	$cnt1 = 0;
	$cnt2 = 0;
	$cnt3 = 0;
	$slotsRid = array();
	$slotrid = "";
	foreach($blockedHours as $row3){
		$blockedHours[$cnt2] = $row3 -> hourId;
		$cnt2 = $cnt2 + 1;
	}

	foreach ($slots as $row2){
		$reservedslots[$cnt1][0] = $row2 -> resId;
		$reservedslots[$cnt1][1] = $row2 -> status;
		$reservedslots[$cnt1][2] = $row2 -> rId;

		if (in_array($reservedslots[$cnt1][2],$slotsRid)){
			$reservedslots[$cnt1][2] = "";
		}else{
			$slotsRid[$cnt3] = $reservedslots[$cnt1][2];
			$cnt3 = $cnt3 + 1;
		}
		$cnt1 = $cnt1 + 1;

	}
	/*	if($tentativeSlots!=null){
            //$reservedslots[$cnt1][0] = $row4;
            foreach($tentativeSlots as $row4){
                $reservedslots[$cnt1][0] = $row4;
                $reservedslots[$cnt1][1] = 6;
                $reservedslots[$cnt1][2]  = 11111;
                $cnt1 = $cnt1 + 1;
            }
        }*/
	?>
	<div id="rTable">
		<table id="resTable">
			<script>
				var blocked = [];

			</script>
			<thead>
			<tr>
				<th style="z-index: 1; position:relative">Time</th>

				<?php
				$formatDate = $date;
				$totalrooms = 0;
				$cnt = 0;
				$a_rooms = array();
				$slotclass = "slots";
				$hourclass = "active";
				//$rooms = $_SESSION['rooms'];
				foreach ($rooms as $row) {
					$roomNum = $row -> roomNum;
					$totalrooms =  $totalrooms +1;
					?>

					<th id="<?php echo $cnt; ?>" class="roomno"><?php echo $roomNum; ?></th>
					<?php
					$a_rooms[$cnt] = $roomNum;
					$cnt= $cnt +1;
				}
				$_SESSION['totalrooms'] = $totalrooms;
				$_SESSION['arooms'] = $a_rooms;
				?>
			</tr>

			</thead>

			<tbody>
			<?php

			foreach ($hours as $row1) {
				$hoursid = $row1 -> id;
				$displayHours = $row1 -> displayhrs;
				$operationHours = $row1 -> hours;
				$operationHours1 = str_replace(":", "", $operationHours);
				$isAvailable = $row1 -> isAvailable;
				/*if($isAvailable == 0){
                    $hourclass = "blocked";
                }else{
                    $hourclass = "active";
                }
                */
				for($k = 0 ; $k < sizeof($blockedHours); $k++){
					if($hoursid == $blockedHours[$k]){
						$hourclass = "blocked";
						break;
					}else{
						$hourclass = "active";
					}
				}
				?>
				<tr class ="<?php echo $hourclass; ?>" name="<?php echo $operationHours; ?>">
					<td class="time" style="width:45px;"><?php echo $displayHours; ?></td>
					<?php
					for ($i =0; $i < $totalrooms ; $i++){
						$slotid = $formatDate.$a_rooms[$i].$operationHours1;
						$slotid= (string)$slotid;
						for ($j= 0; $j < sizeof($reservedslots); $j++){
							if ($slotid == $reservedslots[$j][0]){
								if($reservedslots[$j][1] == 1){
									$slotclass = "reserved";
								}elseif($reservedslots[$j][1] == 2){
									$slotclass = "unverified";
								}
								elseif($reservedslots[$j][1] == 4){
									$slotclass = "transactionComplete";
								}

								$slotrid = $reservedslots[$j][2];
								break;
							}

							else{
								$slotclass = "slots";
								$slotrid = "";
							}
						}
						?>
						<?php if ($tentativeSlots!= null && in_array($slotid, $tentativeSlots)){?>

							<td style="visibility:hidden" class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"><?php echo $slotrid; ?></td>
							<script>
								blocked.push("<?php echo $slotid;?>")
								localStorage.setItem("blocked", JSON.stringify(blocked));
							</script>
						<?php  }else{ ?>


							<td class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"><?php echo $slotrid; ?></td>
							<script>
								document.getElementById("<?php echo $slotid ?>").style.visibility = "visible";
							</script>
						<?php }?>


						<?php
					}
					?>

				</tr>
			<?php } ?>


			</tbody>

		</table>

	</div>
</div>