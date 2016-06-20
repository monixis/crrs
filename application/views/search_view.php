<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/timeline.js"></script>
<script type="text/javascript" src="./js/dashboard.js"></script> 
<link href="./styles/timeline.css" rel="stylesheet" type="text/css">

<title>Search Results</title>	

<div id="details" style="padding-bottom: 30px; padding-left: 20px; width: 700px;">
	<div id="detailsType" style="border: none;">
		<div style="float:right; width:800px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<p id="resId"><?php echo $email;?></p>
		</div>
	</div>

	<div id="invalid" hidden>

	</div>
	<div style="width: 700px; height: 40px;">
		<p style="font-size: 20px; width: 300px; float: left;">Reservations</p>
		<p style="font-size: 20px; width: 370px; float: right">Notes</p>		
	</div>
	
	<div id="element" style="width: 300px; border-right: 1px solid #ccc; margin-top: 10px;float: left;">
	
	</div>
	<div id="notes" style="width:392px; float: right;">
		<ul>
			<?php 
				foreach($notes as $row1){ 
					$notes = $row1 -> notes;	
					$date = $row1 -> date;
			?>
					<li style="border-bottom: 1px solid #dee5e7; padding: 5px;"><?php echo $notes;?> -- <?php echo $date; ?></li><br/>
			<?php }	?>
		</ul>
	</div>
</div>
<script>
			$(function() {
				$("#element").timeline({
					data: []
				});
					
				<?php 
					foreach($details as $row){
						$status = $row -> status;
						$statusId = $row -> statusId;
						$class = 'status'.$statusId; 
						$rId = $row -> rId;
						$resDate = $row -> resDate;
				?>		
						$("#element").timeline("add",
							[
								{	time: new Date(),
									css: '<?php echo $class;?>',
									content: '<?php echo $rId ;?>',
									date: '<?php echo $resDate;?>'}
							]
						 );
				<?php	}
				?>	
			});
</script>
<script>
$(document).ready(function(){
	$('.rcontents').click(function(){
			var rId = $(this).text();
			var link = "<?php echo base_url("?c=crr&m=reservationDetails1&rId="+$rId);?>";//http://localhost/crrs/?c=crr&m=reservationDetails1&rId="
			$('#details').load(link);
					
	
	});	
});
</script>