<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<link rel="stylesheet" type="text/css" href="./styles/qtip.css" />
<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/dashboard.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<script type="text/javascript" src="./js/qtip.js"></script>
<?php
$resId =$resId;
$emails = $emails;
foreach($details as $row){
	$resDate = $row -> resDate;
	$startTime = $row -> startTime;
	$resEmail = $row -> resEmail;
	$secEmail = $row ->secEmail;
	$resPhone = $row -> resPhone;
	$resType = $row -> resType;
	$roomNum = $row -> roomNum;
	$status = $row -> status;
	$statusId = $row -> statusId;
	$totalHours = $row -> totalHours;
	$rId = $row -> rId;
	$comments = $row -> comments;
	$numPatrons = $row -> numPatrons;
	$dateAndTime =$row -> createdDttm;
}
//time format converter
$index = strpos($startTime, ":");
$hr = substr($startTime, 0, $index);
$min = substr($startTime, $index+1);
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
$startTime = $hr . ":" . $min . " " . $suffix;
if(!isset($resDate)){
	$notValid = 1;
	$resId = $searchText;
	$resDate = 1;
	$startTime = 1;
	$resEmail = 1;
	$secEmail = 1;
	$resType = 1;
	$roomNum = 1;
	$status = 22;
	$statusId = 22;
	$totalHours = 22;
	$rId = 0;
}
else {
	$notValid = 0;
}
?>
<title><?php echo $rId; ?></title>
<script>
	$(document).ready(function(){

		if(<?php echo $statusId; ?> == 1){
			$("#color").addClass("reserved");
		}else if (<?php echo $statusId; ?> == 2){
			$("#color").addClass("unverified");
		}else if (<?php echo $statusId; ?> == 3){
			$("#color").addClass("canceled");
		}else if (<?php echo $statusId; ?> == 5){
			$("#color").addClass("canceled");
		}else if (<?php echo $statusId; ?> == 4){
			$('img#editReservation').hide();

			$("#color").addClass("transactionComplete");
		}
		if(<?php echo $notValid ?> == 1){
			$("#valid").attr("hidden","true");
			$("#color").addClass("slots");
			$("#invalid").removeAttr("hidden");
		}
		var availableTags = [];
		<?php
		foreach($emails as $row){
		?>
		availableTags.push('<?php echo $row -> email;?>');
		<?php }	?>
		$( "#primEmail, #secEmail" ).autocomplete({
			source: availableTags
		});

	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 570px; float:left; ">
		</div>

		<div id="inf" style="float:right; width:530px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">#<?php echo $rId ; ?><a><img src="./icons/edit-icon.png" id="editReservation" class="shortcutlink" style="width:25px; height:25px; margin-left:10px;"/></a></p>
		</div>

	</div>

	<div id="invalid" hidden>
		<center><p> The resevation ID #<?php $resId; ?> is invalid.</p></center>
	</div>
    <div id="error"></div></br>
	<div id="valid">
		<p class="resDet"><label class="label">Room No: </label><?php echo $roomNum; ?></p>
		<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?><label class="label" style="margin-left: 70px;">Last Updated:</label><?php echo $dateAndTime; ?></p>
		<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?><label class="label" style="margin-left: 70px;">Total Hours:</label><?php echo $totalHours; ?></p>
		<p class="resDet"><label class="label">Reserved By:</label><?php echo $resEmail?></p>
		<?php if($secEmail != ""){?>
		<p class="resDet"><label class="label">Secondary Patron:</label><?php echo $secEmail; ?></p>
		<?php }?>
		<p class="resDet"><label class="label">Phone No:</label><INPUT TYPE="text" SIZE="40" class="ask_text_input" NAME="primPhone" value="<?php echo $resPhone; ?>" hidden/><?php echo $resPhone; ?></p>
		<p class="resDet"><label class="label">Status:</label><?php echo $status; ?><label class="label" style="margin-left: 55px;">No. of Patrons:</label><?php echo $numPatrons; ?></p>
		<p class="resDet"><label class="label">Comments:</label><textarea readonly rows="3" cols="50" style="margin-left:60px; margin-bottom:5px;"><?php echo $comments; ?></textarea></p>
		<!--label class="label">Notes:</label>
        <textarea id="notes" rows="3" cols="50" style="margin-left:60px; margin-bottom:5px;"></textarea-->
		<?php if ($status == 'Reserved'){?>
			<button type="button" class="btn" id="returned" style="margin-left:10%; margin-top:5px;">Keys Returned</button>
			<button type="button" class="btn" id="canceled" style="margin-left:5px; margin-top:5px;">Cancel Reservation</button>
			<?php if($resId > '0'){?>
				<button type="button" class="btn" id="cancelSlot" style="margin-left:5px; margin-top:5px;">Cancel this Slot</button>
			<?php } ?>

		<?php } else if ($status == 'Unverified'){?>
			<button type="button" class="btn" id="verify" style="margin-left:10%; margin-top:5px;">Verify and Reserve</button>
			<button type="button" class="btn" id="canceled" style="margin-left:5px; margin-top:5px;">Cancel Reservation</button>
			<?php if($resId > '0'){?>
				<button type="button" class="btn" id="cancelSlot" style="margin-left:5px; margin-top:5px;">Cancel this Slot</button>
			<?php } ?>

		<?php } else if ($status == 'Transaction Complete'){?>
			<?php if($resId > '0'){?>
				<button type="button" class="btn" id="cancelSlot" style="margin-left:10%; margin-top:5px;">Cancel this Slot</button>
			<?php } ?>
		<?php } ?>

	</div></br>
	<div align="center" id="noshow_check" hidden  ">
		<strong >Is it a No-Show ? </strong><br>
		<button type="button" class="btn" id="yes" style=" margin-top:5px;">Yes</button>
		<button type="button" class="btn" id="no" style=" margin-top:5px;">No</button>
	</div>
	<div align="center" id="verifyKeysReturn" hidden  ">
		<strong >Do you want to return the keys? </strong><br>
		<button type="button" class="btn" id="returnyes" style=" margin-top:5px;">Yes</button>
		<button type="button" class="btn" id="returnno" style=" margin-top:5px;">No</button>
	</div>
	<div align="center" id="admin-authentication" hidden  ">
		<strong >ADMIN PASSCODE: </strong><input type="password" name="Apcode" id="Apasscode" />
		<button type="button" class="btn" id="adminsubmit" style=" margin-top:5px;">Submit</button>
	</div>

<div align="center" id="noshow" hidden  ">
<strong >Is this a no show reservation: </strong></br>
<button type="button" class="btn" id="yes" style=" margin-top:5px;">Yes</button>
<button type="button" class="btn" id="no" style=" margin-top:5px;">No</button>
</div>
	<div id="updateReservation" hidden>
		<p class="resDet"><label class="label">Room No: </label><?php echo $roomNum; ?></p>
		<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
		<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?><label class="label" style="margin-left: 70px;">Total Hours:</label><?php echo $totalHours; ?></p>
		<p class="resDet"><label class="label">Reserved By:</label>	<INPUT TYPE="text" SIZE="40" class="ask_text_input" NAME="secEmail" id="primEmail" placeholder="<?php echo $resEmail; ?>" value="<?php echo set_value('primEmail'); ?>" />
		</p>
		<p class="resDet"><label class="label">Secondary Patron:</label><INPUT TYPE="text" SIZE="40" class="ask_text_input" NAME="secEmail" id="secEmail" placeholder="<?php echo $secEmail; ?>" value="<?php echo set_value('secEmail'); ?>" />
		</p>
		<p class="resDet"><label class="label">Phone No:</label><INPUT TYPE="text" SIZE="40" class="ask_text_input" NAME="primPhone" id="primPhone" placeholder="<?php echo $resPhone ?>" value="<?php echo set_value('primPhone')?>" /></p>
		<p class="resDet"><label class="label">Status:</label><?php echo $status; ?><label class="label" style="margin-left: 55px;">No. of Patrons:</label><INPUT TYPE="text" SIZE="5" class="ask_text_input" NAME="numPatrons" id="numPatrons" placeholder="<?php echo $numPatrons; ?>" value="" /></p>
		<p class="resDet"><label class="label">Comments:</label><textarea  id="comments" rows="3" cols="50" style="margin-left:60px; margin-bottom:5px;"><?php echo $comments; ?></textarea></p>


		<div align="center">
		<button type="button" class="btn" id="update" style="margin-left:10%; margin-top:5px;">Update</button>

        </div>

	</div>

</div>

<script type="text/javascript">
	$('#returned').click(function(){
		$('#valid').hide();
		$('#verifyKeysReturn').show();
		$("#returnyes").click(function(){
			$('#valid').show();
			$('#verifyKeysReturn').hide();
			var rId= "<?php echo $rId ?>";
			var status = 4;
			var date = new Date();
			date = date.getFullYear() + '-' +
				('00' + (date.getMonth()+1)).slice(-2) + '-' +
				('00' + date.getDate()).slice(-2) + '|' +
				('00' + date.getHours()).slice(-2) + ':' +
				('00' + date.getMinutes()).slice(-2) + ':' +
				('00' + date.getSeconds()).slice(-2);
			$.post("<?php echo base_url("?c=crr&m=updateStatus"); ?>",{rId: rId, status: status, time:date}).done(function(data){
				if (data == 1){
					$('#confirmations').append("<img src='./icons/tick.png'/>");
					$("#color").removeClass("reserved");
					$("#color").addClass("transactionComplete");
					$('img#editReservation').hide();
					$('#returned').hide();
					$('#cancelSlot').hide();
					$('#canceled').hide();
				}else{
					$('#confirmations').append("<img src='./icons/error.png'/>");
				}
			});
		});
		$("#returnno").click(function(){
			$('#valid').show();
			$('#verifyKeysReturn').hide();
		});
	});

		$('img#editReservation').click(function () {
			if($('#updateReservation').is(":hidden")) {
				$('#valid').hide();
				$('#admin-authentication').hide();
				$('#updateReservation').show();
				$('#noshow').hide();

			}else{
				$('#valid').show();
				$('#admin-authentication').hide();
				$('#updateReservation').hide();
				$('#noshow').hide();


			}

		});
	$('#update').click(function(){
		var rId= "<?php echo $rId ?>";
		var resEmail = $('#primEmail').val();
		var secEmail = $('#secEmail').val();
		var resPhone = $('#primPhone').val();
		var comments = $('#comments').val();
		var numPatrons = $('#numPatrons').val();
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

       if(resEmail=="" || !re.test(resEmail)){

		   resEmail = "<?php echo $resEmail ?>";
	   }
		if(secEmail =="" || !re.test(secEmail)){
			secEmail = "<?php echo $secEmail ?>";

		}
		if(resPhone == ""){

			resPhone = "<?php echo $resPhone?>";
		}
		if(numPatrons == ""){

			numPatrons = "<?php echo $numPatrons?>";

		}
		//notes = $('textarea#notes').val();
		$.post("<?php echo base_url("?c=crr&m=updateResDetails"); ?>",{rId: rId, resEmail: resEmail,secEmail: secEmail, resPhone: resPhone, numPatrons:numPatrons,comments:comments }).done(function(data){
			if (data == 1){
				$('#confirmations').append("<img src='./icons/tick.png'/>");
				$('#update').prop('disabled', true);

			}else{
				$('#confirmations').append("<img src='./icons/error.png'/>");
			}
		});

	});

	$('#canceled').click(function() {

		$('#valid').hide();
		$('#admin-authentication').show();
		$('img#editReservation').hide();
		$("#adminsubmit").click(function () {
			var rId = '<?php echo $rId ?>';
			var slotStatus = '<?php echo $statusId ?>';
			var status = 3;
			var Apasscode = '<?php echo $Apasscode ?>';
			var Apcode = $("#Apasscode").val();
			if (Apasscode == Apcode) {
				$('#admin-authentication').hide();
				$('#noshow_check').show();
				if(slotStatus == 2) {
					$("#yes").click(function () {
						status = 6;
						$('#noshow_check').hide();
						$.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
							rId: rId,
							status: status
						}).done(function (data) {
							if (data == 1) {
								$('#confirmations').append("<img src='./icons/tick.png'/>");
								$("#color").removeClass("reserved");
								$("#color").removeClass("unverified");
								$("#color").addClass("slots");
								$('#valid').show();
								$('#returned').hide();
								$('#cancelSlot').hide();
								$('#canceled').hide();
								$('#verify').hide();
								$('img#editReservation').hide();
								document.getElementById("cancelSlot").style.display ="none";
								document.getElementById("canceled").style.display ="none";

							} else {
								$('#confirmations').append("<img src='./icons/error.png'/>");
							}
						});

					});
					$("#no").click(function () {
						status = 3;
						$('#noshow_check').hide();
						$.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
							rId: rId,
							status: status
						}).done(function (data) {
							if (data == 1) {
								$('#confirmations').append("<img src='./icons/tick.png'/>");
								$("#color").removeClass("reserved");
								$("#color").removeClass("unverified");
								$("#color").addClass("slots");
								$('#valid').show();
								$('#returned').hide();
								$('#cancelSlot').hide();
								$('#canceled').hide();
								$('#verify').hide();
								$('img#editReservation').hide();
								document.getElementById("cancelSlot").style.display ="none";
								document.getElementById("canceled").style.display ="none";

							} else {
								$('#confirmations').append("<img src='./icons/error.png'/>");
							}
						});

					});
				}else {
					$('#noshow_check').hide();
					$.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
						rId: rId,
						status: status
					}).done(function (data) {
						if (data == 1) {
							$('#confirmations').append("<img src='./icons/tick.png'/>");
							$("#color").removeClass("reserved");
							$("#color").removeClass("unverified");
							$("#color").addClass("slots");
							$('#valid').show();
							$('#returned').hide();
							$('#cancelSlot').hide();
							$('#verify').hide();
							$('img#editReservation').hide();
							document.getElementById("cancelSlot").style.display ="none";
							document.getElementById("canceled").style.display ="none";
						} else {
							$('#confirmations').append("<img src='./icons/error.png'/>");
						}
					});
				}
			} else {
				$("#Apasscode").css('border', '3px solid red');
				setTimeout(function () {
					$("#Apasscode").css('border', '1px solid grey');
				}, 2000)
			}
		});
		$('#Apasscode').keypress(function (e) {
			var rId = '<?php echo $rId ?>';
			var status = 3;
			var slotStatus = '<?php echo $statusId ?>';
			var Apasscode = '<?php echo $Apasscode ?>';
			var Apcode = $("#Apasscode").val();
			if (Apasscode == Apcode) {
				$('#admin-authentication').hide();
               if(slotStatus == 2){
				$('#noshow_check').show();
				$("#yes").click(function () {
					status = 6;
					$('#noshow_check').hide();
					$.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
						rId: rId,
						status: status
					}).done(function (data) {
						if (data == 1) {
							$('#confirmations').append("<img src='./icons/tick.png'/>");
							$("#color").removeClass("reserved");
							$("#color").removeClass("unverified");
							$("#color").addClass("slots");
							$('#valid').show();
							$('#returned').hide();
							$('#cancelSlot').hide();
							$('#canceled').hide();
                            $('#verify').hide();
							$('img#editReservation').hide();
							document.getElementById("cancelSlot").style.display ="none";
							document.getElementById("canceled").style.display ="none";
						} else {
							$('#confirmations').append("<img src='./icons/error.png'/>");
						}
					});

				});
				$("#no").click(function () {
					status = 3;
					$('#noshow_check').hide();
					$.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
						rId: rId,
						status: status
					}).done(function (data) {
						if (data == 1) {
							$('#confirmations').append("<img src='./icons/tick.png'/>");
							$("#color").removeClass("reserved");
							$("#color").removeClass("unverified");
							$("#color").addClass("slots");
							$('#valid').show();
							$('#returned').hide();
							$('#cancelSlot').hide();
							$('#canceled').hide();
							$('#verify').hide();
							$('img#editReservation').hide();
							document.getElementById("cancelSlot").style.display ="none";
							document.getElementById("canceled").style.display ="none";

						} else {
							$('#confirmations').append("<img src='./icons/error.png'/>");
						}
					});

				});
              } else {
				   $('#noshow_check').hide();
				   $.post("<?php echo base_url("?c=crr&m=cancelReservation"); ?>", {
					rId: rId,
					status: status
				}).done(function (data) {
					if (data == 1) {
						$('#confirmations').append("<img src='./icons/tick.png'/>");
						$("#color").removeClass("reserved");
						$("#color").removeClass("unverified");
						$("#color").addClass("slots");
						$('#valid').show();
						$('#returned').hide();
						$('#cancelSlot').hide();
						$('#canceled').hide();
						$('img#editReservation').hide();
						document.getElementById("cancelSlot").style.display ="none";
						document.getElementById("canceled").style.display ="none";

					} else {
						$('#confirmations').append("<img src='./icons/error.png'/>");
					}
				});

				 }
			} else {
				$("#Apasscode").css('border', '3px solid red');
				setTimeout(function () {
					$("#Apasscode").css('border', '1px solid grey');
				}, 2000)
			}
		});
	});

	$('#cancelSlot').click(function(){

		//notes = $('textarea#notes').val();
		$('#valid').hide();
		$('img#editReservation').hide();
		$('#admin-authentication').show();
		$("#adminsubmit").click(function () {
			var rId= '<?php echo $rId ?>';
			var resId = '<?php echo $resId ?>';
			var status = 5;
			var Apasscode = "<?php echo $Apasscode ?>";
				var Apcode = $("#Apasscode").val();
				if (Apasscode == Apcode) {
					$('#admin-authentication').hide();
					$('#valid').show();

						$.post("<?php echo base_url("?c=crr&m=cancelSlot"); ?>", {
							rId: rId,
							resId: resId,
							status: status
						}).done(function (data) {
							if (data == 1) {
								$('#confirmations').append("<img src='./icons/tick.png'/>");
								$("#color").removeClass("reserved");
								$("#color").removeClass("unverified");
								$("#color").removeClass("transactionComplete");
								$("#color").addClass("slots");
								$('#returned').hide();
								$('img#editReservation').hide();
								$('#verify').hide();
								document.getElementById("cancelSlot").style.display ="none";
								document.getElementById("canceled").style.display ="none";
								//document.getElementById("editReservation").style.display ="none";
							} else if(data==0){
								$('#valid').hide();
								$('#error').append("<h3 align='center' style='color:#b31b1b;'>Slot cancellation Failed: <h3 Align='center' style='color:#b31b1b;'>Selected Slot must be the last one from the reservation</h3><h3>")
								$('#confirmations').append("<img src='./icons/error.png'/>");

							} else {
								$('#confirmations').append("<img src='./icons/error.png'/>");
							}
						});

				} else {
					$("#Apasscode").css('border', '3px solid red');
					setTimeout(function () {
						$("#Apasscode").css('border', '1px solid grey');
					}, 2000)
				}

			});
			$('#Apasscode').keypress(function (e) {
				var rId= '<?php echo $rId ?>';
				var resId = '<?php echo $resId ?>';
				var status = 5;
				var key = e.which;
				if (key == 13) {
					var Apasscode = '<?php echo $Apasscode ?>';
					var Apcode = $("input#Apasscode").val();
					if (Apasscode == Apcode) {
						$('#valid').show();
						$('#admin-authentication').hide();
						$.post("<?php echo base_url("?c=crr&m=cancelSlot"); ?>", {
							rId: rId,
							resId: resId,
							status: status
						}).done(function (data) {
							if (data == 1) {
								$('#confirmations').append("<img src='./icons/tick.png'/>");
								$("#color").removeClass("reserved");
								$("#color").removeClass("unverified");
								$("#color").removeClass("transactionComplete");
								$("#color").addClass("slots");
								$('#verify').hide();
								$('#returned').hide();
								document.getElementById("cancelSlot").style.display ="none";
								document.getElementById("canceled").style.display ="none";
							//	document.getElementById("editReservation").style.display ="none";
							} else if(data==0){
								$('#valid').hide();
								$('#error').append("<h3 align='center' style='color:#b31b1b;'>Slot cancellation Failed: <h3 Align='center' style='color:#b31b1b;'>Selected Slot must be the last one from the reservation</h3><h3>")

								$('#confirmations').append("<img src='./icons/error.png'/>");

							} else {

								$('#confirmations').append("<img src='./icons/error.png'/>");
							}
						});
					} else {
						$("#Apasscode").css('border', '3px solid red');
						setTimeout(function () {
							$("#Apasscode").css('border', '1px solid grey');
						}, 2000)
					}
				}
			});

	});

	$('#verify').click(function(){
		var rId= '<?php echo $rId ?>';
		var status = 1;
		$('img#editReservation').hide();
		//notes = $('textarea#notes').val();
		$.post("<?php echo base_url("?c=crr&m=verifyStatus"); ?>",{rId: rId, status: status}).done(function(data){
			if (data == 1){
				$('#confirmations').append("<img src='./icons/tick.png'/>")
				$("#color").removeClass("unverified");
				$("#color").addClass("reserved");
				document.getElementById("cancelSlot").style.display ="none";
				document.getElementById("canceled").style.display ="none";
				document.getElementById("verify").style.display ="none";

			}else{
				$('#confirmations').append("<img src='./icons/error.png'/>");
			}
		});

	});




</script>