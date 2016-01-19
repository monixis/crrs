<?php 
	foreach($details as $row){
		$roomNum = $row -> roomNum;
		$seats = $row -> seats;
		$computers = $row -> computers;
		$windows = $row -> windows;
		$whiteboards = $row -> whiteboards;
	}
?>	

<div id="details">
	<p style="color: #b31b1b; font-weight: bold; margin-bottom: 10px; margin-top: 10px;">Room # <?php echo $roomNum; ?></p>
	<p><label class="label">Seats: </label><?php echo $seats; ?></p>
	<p><label class="label">Computers: </label><?php echo $computers; ?></p>
	<p><label class="label">Windows: </label><?php echo $windows; ?></p>
	<p><label class="label">Whiteboards: </label><?php echo $whiteboards; ?></p>
	
</div>