<link rel="stylesheet" type="text/css" href="./styles/main.css" />
    	<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/dashboard.js"></script> 
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
			});
		</script>
		<div style="width: 750px;">
			
		<div id="detailsType">
				<div id="color" style="width: 60px; height: 550px; float:left; background: green; ">
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
								if(substr($time, 2, 1) == "3"){
									$time = substr($time, 0, 2) . ":30";
								}
								else {
									$time = substr($time, 0, 2) . ":00";
								}
							}
							else {
								if(substr($time, 1, 1) == "3"){
									$time = substr($time, 0, 1) . ":30";
								}
								else {
									$time = substr($time, 0, 1) . ":00";
								}
							}
						} 
						else {
							$roomNum = substr($resId, 8, 3);
							$time = substr($resId, 11);
							if(strlen($time) == 4){
								if(substr($time, 2, 1) == "3"){
									$time = substr($time, 0, 2) . ":30";
								}
								else {
									$time = substr($time, 0, 2) . ":00";
								}
							}
							else {
								if(substr($time, 1, 1) == "3"){
									$time = substr($time, 0, 1) . ":30";
								}
								else {
									$time = substr($time, 0, 1) . ":00";
								}
							}
						}
					?>
					<FORM NAME="theForm" ID="theForm" ACTION="#" METHOD="POST">	
						
						<p class="resDet"><label class="label">Room No: </label><input type="text" name="roomNum" disabled="true" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px;" value="<?php echo $roomNum ?>"/></p>
						<p class="resDet"><label class="label">Reserve Date: </label><INPUT TYPE="text" disabled="true" NAME="resDate" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px;" value="<?php echo $resDate?>" SIZE="13" class="ask_text_input" /></p>
						<p class="resDet"><label class="label">Reservation Time: </label><input type="text" disabled="true" name ="timeStart" style="color: #b31b1b; background: #ffffff; border: 1px solid #ffffff; font-size: 18px;" value="<?php echo $time; ?>">
										<label class="label" style="margin-left:0px;">for </label>
										<select name ="numHours" value="<?php echo set_value('numHours'); ?>" SIZE="1">
											<option value="1">1 hour</option>
											<option value="2">2 hours</option>
											<option value="3">3 hours</option>
										</select>
						</p>
						<p class="resDet"><label class="label">Booking Type:</label><select name ="bookType" id="bookType" value="<?php echo set_value('bookType'); ?>" SIZE="1">
											<option value="person">In Person</option>
											<option value="phone">By Phone</option>
										</select>
										</br><div style="color:RED"><?php echo form_error('bookType'); ?></div>
						</p>
						<p class="resDet"><label class="label">Primary Email:</label><INPUT TYPE="text" NAME="primEmail" value="<?php echo set_value('primEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('primEmail'); ?></div></p>
						<p class="resDet" id="check1"><input type="checkbox" id="checkbox1" style="margin-left:180px;" required>Check to verify that this patron has a Marist CWID.</input></p>
						<p class="resDet" id="isUnverified1" hidden style="margin-left:180px;">A Marist ID must be shown when verifying a reservation.</p>
						<p class="resDet"><label class="label">Secondary Email:</label><INPUT TYPE="text" NAME="secEmail" value="<?php echo set_value('secEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('secEmail'); ?></div></p>
						<p class="resDet" id="check2"><input type="checkbox" id="checkbox2" style="margin-left:180px;" required>Check to verify that this patron has a Marist CWID.</input></p>
						<p class="resDet" id="isUnverified2" hidden style="margin-left:180px;">A Marist ID must be shown when verifying a reservation.</p>
						<p class="resDet"><label class="label">Comments (Optional): </label><textarea NAME="Comments" ROWS="3" COLS="43" ></textarea></p>
						
						
								
					<input name="submit" value="Reserve the Room" id="submit" type="submit" class="btn" style="margin-left:56px; margin-top:5px;"/>
					<!--input name="reset" type="reset" id="reset" class="btn" style="margin-left:56px; margin-top:5px;"/-->
					</form>
	
			</div>		
			