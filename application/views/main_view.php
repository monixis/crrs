		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 	
		<script type="text/javascript" src="./js/dashboard.js"></script> 
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="http://library.marist.edu/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
  		$(document).ready(function(){
   			$("a[rel^='prettyPhoto']").prettyPhoto();
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
			
			foreach ($hours as $row1) {
					$stime = $row1 -> starttime;
					$totalhrs = $row1 -> totalhrs;
			} ?>
			
			<table id="resTable">
  				<tr>
  					<th>Time</th>
  					  
  				<?php 
  				// $formatDate = date("mdY"); 
  				 $formatDate = $date;
  				 $totalrooms = 0;
				 $cnt = 0;
				 $a_rooms = array();
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
  				
  				<?php 
  				$currtime = $stime;
				$y = 0;
				$slotclass = "slots";
				//$time = "am";
  				while ($y < $totalhrs){
  					if ($y == 0){
  						$currtime = $stime;
  					}else{
  						$currtime = $currtime + 1 ;
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
  						
  				    </tr>
  				<?php }	?>  				
			
			</table>
			
		</div>	