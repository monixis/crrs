<?php

?>

		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="./styles/qtip.css" />    	
    	<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/dashboard.js"></script> 
		<script type="text/javascript" src="./js/qtip.js"></script>

		<script>
			$(document).ready(function() {
				$("#dateStart").datepicker({
					minDate : "+0"
				});
			})
		</script>
		<script>
			$(document).ready(function() {

				$("#bookType").change(function(){
								if($(this).find('option:selected').val() == "person"){
									$("#check2").removeAttr('hidden');
									$("#checkbox2").attr('required','true');
									$("#isUnverified2").attr('hidden', 'true');
									$("#check1").removeAttr('hidden');
									$("#checkbox1").attr('required','true');
									$("#isUnverified1").attr('hidden', 'true');
								}
								else{
									$("#check2").attr('hidden','true');
									$("#checkbox2").removeAttr('required');
				   					$("#isUnverified2").removeAttr('hidden');
				   					$("#check1").attr('hidden','true');
				   					$("#checkbox1").removeAttr('required');
				   					$("#isUnverified1").removeAttr('hidden');
				   				}

				});
				
				var availableTags = [];
				<?php
				foreach($emails as $row){
				?>
				availableTags.push('<?php echo $row -> email;?>');
				<?php }	?>
        		$( "#primEmail, #secEmail" ).autocomplete({
      			source: availableTags
			    });
				var date;
				date = new Date();
				date = date.getUTCFullYear() + '-' +
					('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
					('00' + date.getDate()).slice(-2) + '|' +
					('00' + date.getHours()).slice(-2) + ':' +
					('00' + date.getMinutes()).slice(-2) + ':' +
					('00' + date.getSeconds()).slice(-2);
				document.getElementById("timestamp").value = date;
				localStorage.setItem("tentative", 1);

			});
		</script>


<script>
		$(document).ready(function(){
		    $('img.tooltip').each(function() {
        		 $(this).qtip({
            		content: {
                	text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('id') // Use href attribute as URL
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    });
        
                    return 'Loading...'; // Set some initial text
                }
            },
            position: {
                viewport: $(window)
            },
            style: 'qtip-wiki'
         });
     });
			});
		</script>
	
		<div style="width: 750px;">
			
		<div id="detailsType">
				<div id="color" style="width: 60px; height: 640px; float:left; background: green; ">
				</div>
				<div style="float:right; width:690px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
					<p>Room Reserve Form</p>
				</div>
		</div>
					<?php
						$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
						if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
							$roomNum = substr($resId, 8, 4);
							$time = substr($resId, 12);
							if(strlen($time) == 4){
								$time = substr($time, 0, 2) . ":30";
							}
							else if(strlen($time) == 3) {
								$time = substr($time, 0, 1) . ":30";
							}
							else {
								$time = substr($time, 0) . ":00";
							}
						} 
						else {
							$roomNum = substr($resId, 8, 3);
							$time = substr($resId, 11);
							if(strlen($time) == 4){
								$time = substr($time, 0, 2) . ":30";
							}
							else if(strlen($time) == 3) {
								$time = substr($time, 0, 1) . ":30";
							}
							else {
								$time = substr($time, 0) . ":00";
							}
						}
						//time format converter
						$index = strpos($time, ":");		
						$hr = substr($time, 0, $index);
						$min = substr($time, $index+1);
						$suffix = "am";
						if ($hr > 12){
							$hr = $hr - 12;
							$suffix = "pm";
						}
						if($hr == 00){
							$hr = 12;					
						}elseif($hr == 12){
							$suffix = "pm";
						}
						$time = $hr . ":" . $min . " " . $suffix;
					?>
					<FORM NAME="theForm" ID="theForm" ACTION="<?php echo base_url("?c=crr&m=reserveForm&resId=$resId")?>"  METHOD="POST">
						
						<p class="resDet"><label class="label">Room No: </label><input type="text" id="roomNo" name="roomNum" disabled="true" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px; width: 48px;" value="<?php echo $roomNum ?>"/><img src="./icons/expand.png" class="tooltip" id="<?php echo base_url("?c=crr&m=tooltiproomdetails&roomNo=".$roomNum)  ?>" style="width:12px; height:12px;"/></p>
						<p class="resDet"><label class="label">Reserve Date: </label><INPUT TYPE="text" disabled="true" NAME="resDate" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px;" value="<?php echo $resDate?>" SIZE="13" class="ask_text_input" /></p>
						<p class="resDet"><label class="label">Reservation Time: </label><input type="text" disabled="true" name ="timeStart" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px;" value="<?php echo $time; ?>">
										<label class="label" style="margin-left:0px;">for </label>
										<select name ="numHours" id="numHours" value="<?php echo set_value('numHours'); ?>" SIZE="1">
											<?php if($timeAvailalbe==1){?>
											<option value="1">1 hour</option>
											<?php } else if($timeAvailalbe==1.5){?>
												<option value="1">1 hour</option>
												<option value="1.5">1.5 hours</option>
											<?php }else if($timeAvailalbe==2){?>
												<option value="1">1 hour</option>
												<option value="2">2 hours</option>
											<?php } else if($timeAvailalbe==2.5){ ?>
												<option value="1">1 hour</option>
												<option value="2">2 hours</option>
												<option value="2.5">2.5 hours</option>

											<?php }else if($timeAvailalbe==3){?>
											<option value="1">1 hour</option>
											<option value="2">2 hours</option>
											<option value="3">3 hours</option>
											<?php }else{?>
												<option value="1">1 hour</option>
												<option value="2">2 hours</option>
												<option value="3">3 hours</option>
											<?php } ?>
										</select>
						</p>
						<input id="timestamp" name="timestamp" hidden/>

						<p class="resDet"><label class="label">Booking Type:</label><select name ="bookType" id="bookType" value="<?php echo set_value('bookType'); ?>" SIZE="1">
											<option value="person">For Now</option>
											<option value="phone">For Future</option>
										</select>
										</br><div style="color:RED"><?php echo form_error('bookType'); ?></div>
						</p>
						<p class="resDet"><label class="label">Number of Patrons:</label>
										  <SELECT id="numPatrons" NAME="numPatrons" value="<?php echo set_value('numPatrons'); ?>" SIZE="1" class="ask_text_input">
											    <option value="2">2</option>
											    <option value="1">1</option>
											    <option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
											</select>
						</p>
						<p class="resDet"><label class="label">Primary Marist Email:</label><INPUT TYPE="text" NAME="primEmail" id="primEmail" value="<?php echo set_value('primEmail'); ?>" SIZE="40" class="ask_text_input" /><img src="./icons/expand.png" class="viewNotes" id="viewNotes1" style="width:12px; height:12px; margin-left: 10px;"/><img src="./icons/addNotes.png" id="addNotes1" class="addNotes" style="width:14px; height:14px; margin-left: 7px;"/></br><div style="color:RED"><?php echo form_error('primEmail'); ?></div></p>
						<p class="resDet" id="check1"><input type="checkbox" id="checkbox1" style="margin-left:180px;" required>Check to verify that this patron has a Marist CWID.</input></p>
						<p class="resDet"><label class="label">Primary Phone No:</label><INPUT TYPE="text" NAME="primPhone" id="primPhone" value="<?php echo set_value('primPhone');?>" SIZE="15" class="ask_text_input" /></br></p>
						<p class="resDet" id="isUnverified1" hidden style="margin-left:180px;">A Marist ID must be shown when verifying a reservation.</p>
						<p class="resDet" id="secEmailP"><label class="label">Secondary Email:</label><INPUT TYPE="text" NAME="secEmail" id="secEmail" value="<?php echo set_value('secEmail'); ?>" SIZE="40" class="ask_text_input" /><img src="./icons/expand.png" class="viewNotes" id="viewNotes2" style="width:12px; height:12px; margin-left: 10px;"/><img src="./icons/addNotes.png" id="addNotes2" class="addNotes" style="width:14px; height:14px; margin-left: 7px;"/></br><div style="color:RED"><?php echo form_error('secEmail'); ?></div></p>
						<p class="resDet" id="check2"><input type="checkbox" id="checkbox2" style="margin-left:180px;" required>Check to verify that this patron has a Marist CWID.</input></p>
						<p class="resDet" id="isUnverified2" hidden style="margin-left:180px;">A Marist ID must be shown when verifying a reservation.</p>
						<p class="resDet"><label class="label">Comments (Optional): </label><textarea NAME="Comments" ROWS="3" COLS="43" ></textarea></p>
						<input name="timeAvailalbe" id="timeAvailalbe" value="<?php if($timeAvailalbe){ echo $timeAvailalbe; }?>" hidden/>
						<input name="submit" value="Reserve the Room" id="submit" type="submit" class="btn" style="margin-left:56px; margin-top:5px;"/>
					<!--input name="reset" type="reset" id="reset" class="btn" style="margin-left:56px; margin-top:5px;"/-->
					</form>
			<div id="shadowBox"><iframe id="shadowFrame"></iframe><div style="width:25px; height:15px; float:right; margin-top:3px; margin-right: 5px;"><img id="close" src="./icons/close.png" style="width: 25px; height: 25px;"/></div></div>
			
			</div>	
			<script type="text/javascript" src="./js/dashboard.js"></script> 
			<script>
				$('img#viewNotes1').click(function(){
					var email = $("#primEmail").val();
					var link = "<?php echo base_url("?c=crr&m=tooltipNotes&email=") ?>"+email;
					//var link = "http://localhost/crrs/?c=crr&m=tooltipNotes&email=" + email;
					$('#shadowBox').css({'visibility':'visible','width':'410px','height':'340px'});
						$('#shadowFrame').css({'width':'375px','height':'340px'});
						$('#shadowBox').css('left','26%');
						$('#shadowBox').css('top','14%');
						$('iframe').attr('src',link);
				});

				$('img#viewNotes2').click(function(){
					var email = $("#secEmail").val();
					var link = "<?php echo base_url("?c=crr&m=tooltipNotes&email=") ?>"+email;

					//var link = "http://localhost/crrs/?c=crr&m=tooltipNotes&email=" + email;
					$('#shadowBox').css({'visibility':'visible','width':'410px','height':'340px'});
						$('#shadowFrame').css({'width':'375px','height':'340px'});
						$('#shadowBox').css('left','26%');
						$('#shadowBox').css('top','14%');
						$('iframe').attr('src',link);
				});
				$('select#numPatrons').change(function(){
					//var numPatrons = $("select#numPatrons").val();
					var numPatrons = 0;
					$( "select option:selected" ).each(function() {
						numPatrons = $(this).attr('value');
					});
					if(numPatrons == 1){
						$("#check2").attr('hidden','true');
						$("#checkbox2").removeAttr('required');
						$("#secEmail").attr('hidden','true');
						$("#secEmail").removeAttr('required');
						$("p#secEmailP").attr('hidden','true');


					}else{
						$("#check2").removeAttr('hidden');
						$("#checkbox2").attr('required','true');
						$("#secEmail").removeAttr('hidden');
						$("#secEmail").attr('required','true');
						$("p#secEmailP").removeAttr('hidden');

					}

				});
				
				$('img#addNotes1').click(function(){
					//test = 1;
					//alert(test);
					var email = $("#primEmail").val();
					var link = "<?php echo base_url("?c=crr&m=addNotes1&email=") ?>"+email;

					//var link = "http://localhost/crrs/?c=crr&m=addNotes1&email=" + email;
					$('#shadowBox').css({'visibility':'visible','width':'415px','height':'340px'});
						$('#shadowFrame').css({'width':'385px','height':'340px'});
						$('#shadowBox').css('left','26%');
						$('#shadowBox').css('top','14%');
						$('iframe').attr('src',link);
				});
				
				$('img#addNotes2').click(function(){
					var email = $("#secEmail").val();
					var link = "<?php echo base_url("?c=crr&m=addNotes1&email=") ?>"+email;
					//var link = "http://localhost/crrs/?c=crr&m=addNotes1&email=" + email;
					$('#shadowBox').css({'visibility':'visible','width':'415px','height':'340px'});
						$('#shadowFrame').css({'width':'385px','height':'340px'});
						$('#shadowBox').css('left','26%');
						$('#shadowBox').css('top','14%');
						$('iframe').attr('src',link);
				});
/*				$('#numHours').change(function() {

                    var resId = "<!--?php echo $resId?>";
					var totalHours = $(this).val();

					$.post("<!--?php echo base_url("?c=crr&m=checkReservation"); ?>", {
						resId: resId,
						totalHours: totalHours
					}).done(function (data) {


					});
				});*/
			</script>