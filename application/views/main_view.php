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
		   		});
		</script>
		<div id="dashboard">
			<div id="optionmenu" style="width:1010px; height: 25px; border: 1px solid #ffffff; margin-bottom: 5px; "><img id="refresh" style="width: 25px; float:left;" src="./icons/refresh.png" /><img id="print" style="width: 25px; float:right;" src="./icons/print.png" /><img id="addNotes" class="addNotes" style="width: 25px; float:right; margin-right: 5px;" src="./icons/addNotes.png" /><img id="reports" class="addNotes" style="width: 25px; float:right; margin-right: 5px;" src="./icons/reports.png" /></div>
			<div id="shadowBox"><iframe id="shadowFrame"></iframe><div style="width:36px; height:26px; float:right; margin-top:3px;"><img id="close" src="./icons/close.png"/></div></div>
			
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
			?>
			<div id="rTable">
			<table id="resTable">
				
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
  				foreach ($rooms as $row) {
					  $roomNum = $row -> roomNum;
					  $totalrooms =  $totalrooms +1; 
				?>
				<th id="<?php echo $cnt; ?>" class="roomno"><?php echo $roomNum; ?></th>
				 <?php  
					$a_rooms[$cnt] = $roomNum;
					$cnt= $cnt +1; 
				} ?>
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
										}else{
											$slotclass = "slots";
											$slotrid = "";
										}
									}						
							 
						?>
						<td class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"><?php echo $slotrid; ?></td>
						<?php
							}					  						
  						?>
				</tr>
				<?php } ?>
  				
  				</tbody>
  				
  				
  			  				
			</table>
			
		</div>	
		</div>