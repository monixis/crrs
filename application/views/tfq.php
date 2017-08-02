<?php


?>

<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="./js/jquery-ui.js"></script>

<script>
    $(document).ready(function(){
    	var availableTags = [];
		<?php 
		foreach($emails as $row){
		?>
		availableTags.push('<?php echo $row -> email;?>');
		<?php }	?>
    	$( "#tfq" ).autocomplete({
    	source: availableTags
	    });
   	})
</script>

<input type="text" id="tfq" class="tftextinput2" name="q"/><img id="search" style="margin-left:5px;" src="./icons/search.png"/>

<script type="text/javascript" src="./js/dashboard.js"></script>