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
			<div id="shadowBox"><iframe id="shadowFrame"></iframe><div style="width:36px; height:26px; float:right; margin-top:3px;"><img id="close" src="./icons/close.png"/></div></div>
			
			<?php 
			$reservedslots = array();			
			$cnt1 = 0;
			//$detailsLink = "";
			
			foreach ($slots as $row2){
				$reservedslots[$cnt1][0] = $row2 -> resId;
				$reservedslots[$cnt1][1] = $row2 -> status;
				$cnt1 = $cnt1 +1;
				}
			//print_r(sizeof($reservedslots));
			?>
			<div id="rTable">
			<table id="resTable">
				<thead>
					<tr>
  					<th>Time</th>
  					  
  				<?php 
  				// $formatDate = date("mdY"); 
  				 $formatDate = $date;
  				 $totalrooms = 0;
				 $cnt = 0;
				 $a_rooms = array();
				 $slotclass = "slots";
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
  					$displayHours = $row1 -> displayhrs;
					$operationHours = $row1 -> hours;
					$operationHours1 = str_replace(":", "", $operationHours);
					$isAvailable = $row1 -> isAvailable;
					if($isAvailable == 0){
						$hourclass = "blocked"; 
					}else{
						$hourclass = "active";
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
											//print_r($slotid);
											break;
										}else{
											$slotclass = "slots";
										}
									}						
							 
						?>
						<td class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"></td>
						
						<?php
							}					  						
  						?>
				</tr>
				<?php } ?>
				</tbody>
  				<!--?php 
  				$currtime = $stime;
				$y = 0;
				$slotclass = "slots";
				//$time = "am";
  				while ($y < $totalhrs){
  					if ($y == 0){
  						$currtime = $stime;
  					}else{
  						$currtime = $currtime + 1;
  					}
  									
					/*if ($currtime == 25)
					{
						$currtime = 1;
						if ($time == "am"){
							$time = "pm";
						}else{
							$time = "am";
						}
						
					}*/
					
					if ($currtime == 25){
						$currtime = 1;
							}
					
					$y = $y + 1;
					$currtime1 = $currtime . ":" . "00";
				/*	$currtime = (string)$currtime;
					if(strrpos($currtime, ".") == -1){
						$currtime1 = $currtime;
					}else{
						$currtime1 = $currtime . ":" . "30";
					}*/
  				?>	<tr>
  						<td id="time"><?php echo $currtime1; ?></td>

 						<?php 
							for ($i =0; $i < $totalrooms ; $i++){
							$slotid = $formatDate.$a_rooms[$i].$currtime;
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
											//print_r($slotid);
											break;
										}else{
											$slotclass = "slots";
										}
									}						
							 
						?>
						<td class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"></td>
						<?php
							}					  						
  						?>
  						
  				    </tr-->
  			  				
			</table>
			</div>
		</div>	
		