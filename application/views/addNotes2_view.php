<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 

<div id="details" style="width: 375px;">
	<div id="detailsType" style="margin-bottom: 15px;">
		<div style="float:right; width:375px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">Add Notes</p>
		</div>
	</div>
	<label class="label" style="margin-left:5px;">Email:</label><!--input type="text"/-->
	<div id="tfheader" style="width: 375px; height: 42px;">
	<input type="text" id="tfq" class="tftextinput2" name="q" value="<?php echo $email;?>" readonly />
	</div>	
	<label class="label" style="margin-top:10px; margin-left: 5px;">Notes:</label>
	<textarea id="notes" rows="5" cols="50" style="margin-left:5px; margin-bottom:5px;"></textarea>
	<button type="button" class="btn" id="add" style="margin-top:5px;">Add a Note</button>
</div>

<style>
	.tftextinput2{
		width:365px;
		margin-left:10px;	
	}
	#search{
		visibility: hidden;
	}
</style>
<script type="text/javascript">
$('#add').click(function(){
	var email = $('input.tftextinput2').val();
	var notes = $('textarea#notes').val();
	$.post("<?php echo base_url("?c=crr&m=addANote"); ?>",{email: email, notes: notes}).done(function(data){
							if (data == 1){
									$('#confirmations').append("<img src='./icons/tick.png'/>");
								    $('#add').prop("disabled", true);
							}else{
									$('#confirmations').append("<img src='./icons/error.png'/>");	
							}
	});
});
</script>
