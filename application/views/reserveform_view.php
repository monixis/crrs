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
			<div id="details">
					<h1 class="page_head">Room Reserve Form</h1>
					<?php
						$resDate = substr($resId, 0, 2) . "/" . substr($resId, 2, 2) . "/" . substr($resId, 4, 4);
						if (substr($resId, 11, 1) == "A" || substr($resId, 11, 1) == "B" || substr($resId, 11, 1) == "C" || substr($resId, 11, 1) == "D") {
							$roomNum = substr($resId, 8, 4);
							$time = substr($resId, 12);
						} else {
							$roomNum = substr($resId, 8, 3);
							$time = substr($resId, 11);
						}
					?>
					<FORM NAME="theForm" ID="theForm" ACTION="#" METHOD="POST">	
								<TABLE width="700px">
									<TR>
										<TD class="label">Room #:</TD>
										<td class ="ask_input" colspan="3">
										<input type="text" name="roomNum" disabled="true" value="<?php echo $roomNum ?>"/>
										</TD>
									</TR>
									<TR>
										<TD class="label">Reserve Date:</TD>
										<td class ="ask_input" colspan+"3">
										<INPUT TYPE="text" disabled="true" NAME="resDate" value="<?php echo $resDate?>" SIZE="13" class="ask_text_input" />
									</TR>
									<TR>
										<TD class="label">Reservation Start Time:</TD>
										<td class="ask_input">
										<input type="text" disabled="true" name ="timeStart" value="<?php echo $time . ":00" ?>">
										<label class="label">for </label>
										<select name ="numHours" value="<?php echo set_value('numHours'); ?>" SIZE="1">
											<option value="<?php echo $time + 1; ?>">1 hour</option>
											<option value="<?php echo $time + 2; ?>">2 hours</option>
											<option value="<?php echo $time + 3; ?>">3 hours</option>
										</select>
									</TR>
									<TR>
										<TD class="label">Booking Type:</TD>
										<td class="ask_input">
										<select name ="bookType" value="<?php echo set_value('bookType'); ?>" SIZE="1">
											<option value="person">In Person</option>
											<option value="phone">By Phone</option>
										</select>
										</br><div style="color:RED"><?php echo form_error('bookType'); ?></div>
										</TD>
									</TR>
									<TR>
										<TD class="label">Primary Patron Email:</TD>
										<td class="ask_input">
										<INPUT TYPE="text" NAME="primEmail" value="<?php echo set_value('primEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('primEmail'); ?></div>
									</TR>	
									<TR>
										<TD>
										</TD>
										<td colspan="3">
											<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
										</td>
									</TR>
									<TR>
										<TD class="label">Secondary Patron Email:</TD>
										<td class="ask_input">
										<INPUT TYPE="text" NAME="secEmail" value="<?php echo set_value('secEmail'); ?>" SIZE="60" class="ask_text_input" /></br><div style="color:RED"><?php echo form_error('secEmail'); ?></div>
									</TR>
									<TR>
										<TD>
										</TD>
										<td colspan='3'>
											<input type="checkbox" required>Check to verify that this patron has a Marist CWID.
										</td>
									</TR>
									<TR>
										<TD class="label"> Comments (optional):
										<br>
										</TD>
										<td class ="ask_input" colspan="3">							<textarea NAME="Comments" ROWS="10" COLS="43" ></textarea></TD>
									</TR>
						</table>			
						<!--table width="600px">
						<tr>
							<td>
							<center>
								<p>

									<INPUT name="submit" value="Submit" id="submit" TYPE="submit">
									<INPUT name="reset" TYPE="reset" id="reset">
						
								</p>
							</center></td>
						</tr>
					</table-->
					<input name="submit" value="Reserve the Room" id="submit" type="submit" class="btn" style="margin-left:56px; margin-top:5px;"/>
					<input name="reset" type="reset" id="reset" class="btn" />
					</form>
					</div>
					
			