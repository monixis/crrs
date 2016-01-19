<?php 
	if (sizeof($notes) == 0){
		$email = 'Please select an email to view the associated notes';
	}else{
		foreach($notes as $row){
		$email = $row -> email;
		}
	}
	
?>
<div id="details" style="width: 350px;">
<p style="color: #b31b1b; font-size: 20px; font-weight: bold; margin-bottom: 10px; margin-top: 10px;"><?php echo $email; ?></p>
<ul style="width: 300px; font-size: 11pt; line-height:100%; margin-right: 5px; ">
<?php 
	foreach($notes as $row){
		//$email = $row -> email;
		$notes = $row -> notes;
		$date = $row -> date;
	
?>	
		<li style="border-bottom: 1px solid #dee5e7;"><?php echo $notes; ?> -- <?php echo $date; ?></li><br/>
			<?php } ?>
		</ul>
	
</div>