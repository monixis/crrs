<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 	
<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<style>
			.blocked{
				display: none;
			}
			#resTable{
				min-width: 100%;
			}
			td, th { 
			  padding: 5px; 
			  width: 20px;
			}
		</style>
		
		<div id="dashboard">
			<div id="shadowBox"><iframe id="shadowFrame"></iframe><div style="width:36px; height:26px; float:right; margin-top:3px;"><img id="close" src="./icons/close.png"/></div></div>
			
			<?php 
			$reservedslots = array();			
			$cnt1 = 0;
			$cnt2 = 0;
			//$detailsLink = "";
			foreach($blockedHours as $row3){
				$blockedHours[$cnt2] = $row3 -> hourId;
				$cnt2 = $cnt2 + 1;
			}
			
			foreach ($slots as $row2){
				$reservedslots[$cnt1][0] = $row2 -> resId;
				$reservedslots[$cnt1][1] = $row2 -> status;
				$cnt1 = $cnt1 + 1;
				}
			//print_r(sizeof($reservedslots));
			
		
			?>
			<div id="rTable">
			<table id="resTable">
				
  				<thead>
  					
					<tr>
  					<th style="z-index: 1; position:relative">Time</th>
  					  
  				<?php 
  				// $formatDate = date("mdY"); 
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
											//print_r($slotid);
											break;
										}else{
											$slotclass = "slots";
										}
									}						
							 
						?>
						<td class=<?php echo $slotclass; ?> id="<?php echo $slotid; ?>"><?php if($slotclass == "reserved"){echo "Res";}else if($slotclass == "unverified"){echo "Unver";}else if($slotclass == "transactionComplete"){echo "Comp";}?></td>
						<?php
							}					  						
  						?>
				</tr>
				<?php } ?>
  				
  				</tbody>
  				
  				
  			  				
			</table>
			
		</div>	
		</div>
		<script>
			window.print();
		</script>