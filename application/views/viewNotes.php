<?php
if(!empty($error)){
	$email ="Please select an email";
}
	else if (sizeof($notes) == 0){
		$email = 'Selected email has not been associated with any notes ';
	}else{
		foreach($notes as $row){
		$email = $row -> email;
		}
	}
	
?>
<div id="details" style="width: 350px;">
<p align="center" style="color: #b31b1b; font-size: 20px; font-weight: bold; margin-bottom: 10px; margin-top: 10px;"><?php echo $email; ?></p>
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