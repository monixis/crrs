
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>CRRS Reports</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="./js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<script type="text/javascript" src="./js/dashboard.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script>
    		$(document).ready(function(){
    			$("#reportDatePicker").datepicker({
    				minDate : -30,
						maxDate : 0
    			});
    			$("#reportDatePicker").datepicker( "setDate", new Date());
    			$("#reportDatePicker").empty();
    			var date = $('input#reportDatePicker').val();
				var url = "<?php echo base_url("?c=crr&m=getPatronCount&date=")?>"+date;
    			//var url = "http://localhost:9090/crrs/?c=crr&m=getPatronCount&date="+date;
	$('#report_view').empty();
	$('#report_view').load(url);

    		})
    	</script>

		<style>
			#reportDatePicker{
				position: relative;
				font-size: 18px;
				color: #b31b1b;
				font-weight: bold;
			}

			#report_view{
				width: 500px;
				height: 600px;
				border: 1px solid white;
				margin-left:auto;
				margin-right:auto;
				overflow-y: auto;
			}

		</style>
	</head>
	<body>

		<div id="headerContainer">
			<a href="<?php echo base_url(); ?>" target="_self"> <div id="header"></div> </a>
		</div>
		<div id="menu">
			<div id="menuItems">

			</div>

		</div>
		<div id="generateReport" style="border-bottom: 1px solid black;border-top: 1px solid black" align="center">
			<h1 style="color: #b31b1b; text-align: center;">Reservation Report</h1>
			<div id="admin-authentication" style="border: 1px solid grey; width: 360px; margin-left: auto; margin-right: auto; padding: 12px; ">
				<strong>ADMIN PASSCODE: </strong><input type="password" name="Apcode" id="Apasscode" />
				<button type="button" class="btn" id="adminsubmit" style="margin-left:37%; margin-top:5px;">Submit</button>
			</div>
			<label class="label">From: <input type="text" name="fromDate" id="fromDatePicker" value=""/></label>
			<label class="label">To: <input type="text" name="toDate" id="toDatePicker" value="" /></label>
			<button type="button" class="btn" id="getReport" style="margin-left:10px; margin-top:21px;">Download</button></br></br>
		</div>
		<br/>
		<h1 style="color: #b31b1b; text-align: center;">Patron Count Report</h1>
		<div style="width: 1000px; margin-left:auto; margin-right: auto;">
  			<p id="pickDate">Select a date: <input type="text" name="viewDate" id="reportDatePicker" value="" /></p>

 		</div>

		<div id="report_view">


		</div><br/>

			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://localhost:9090/crrs/?c=crr&m=ack" target="_blank" >Acknowledgement</a>
				</p>

			</div>
			<script type="text/javascript" src="./js/dashboard.js"></script>

	</body>

	<script>
	$('#reportDatePicker').change(function() {
	var date = $('input#reportDatePicker').val();
	var url = "<?php echo base_url("?c=crr&m=getPatronCount&date=")?>"+date;
	$('#report_view').empty();
	$('#report_view').load(url);
	});
	/*$("#fromDatePicker").datepicker({
		onClose: function (selectedDate) {
			$("#toDatePicker").datepicker("option", "minDate", selectedDate);
		}

	});*/
	$('#getReport').click(function() {
		if ($('input#fromDatePicker').val() && $('input#toDatePicker').val()) {

			$("#admin-authentication").toggle();
			$("#adminsubmit").click(function () {
				var Apcode = $("#Apasscode").val();

				$.post("<?php echo base_url("?c=crr&m=admin_verify&pass=");?>" + Apcode, {}).done(function (authorized) {
					if (authorized == 1) {
						if ($('input#fromDatePicker').val() && $('input#toDatePicker').val()) {
							//	document.getElementById("admin-authentication").style.visibility='visible';

							var fromDate = $('input#fromDatePicker').val();
							var fromDateValue = Date.parse(fromDate);
							var toDate = $('input#toDatePicker').val();
							var toDateValue = Date.parse(toDate);


							if (toDateValue < fromDateValue) {
								alert('To-Date should be greater than From-Date value');
							} else {
								$.get("<?php echo base_url("?c=crr&m=verifyReservationDateRange&fromDate="); ?>" + fromDate + "&toDate=" + toDate).done(function (data) {
									if (data == 1) {
										var r = confirm("Would you like to download the report?");
										if (r == true) {
											document.location = "<?php echo base_url("?c=crr&m=getReservationsReport&fromDate="); ?>" + fromDate + "&toDate=" + toDate;
											$("#admin-authentication").hide();
										} else {
											$("#admin-authentication").hide();

										}
									} else {
										$("#admin-authentication").hide();
										alert('Error in generating report');
									}
								});
							}

						} else {
							alert("Please select a valid date range");
						}
					} else {
						$("#Apasscode").css('border', '3px solid red');
						setTimeout(function () {
							$("#Apasscode").css('border', '1px solid grey');
						}, 2000)
					}
				});
			});
			$('#Apasscode').keypress(function (e) {
				var key = e.which;
				if (key == 13) {
					var Apcode = $("#Apasscode").val();

					$.post("<?php echo base_url("?c=crr&m=admin_verify&pass=");?>" + Apcode, {}).done(function (authorized) {
						if (authorized == 1) {
							if ($('input#fromDatePicker').val() && $('input#toDatePicker').val()) {
								//	document.getElementById("admin-authentication").style.visibility='visible';

								var fromDate = $('input#fromDatePicker').val();
								var fromDateValue = Date.parse(fromDate);
								var toDate = $('input#toDatePicker').val();
								var toDateValue = Date.parse(toDate);

								if (toDateValue < fromDateValue) {
									alert('To-Date should be greater than From-Date value');
								} else {
									$.get("<?php echo base_url("?c=crr&m=verifyReservationDateRange&fromDate="); ?>" + fromDate + "&toDate=" + toDate).done(function (data) {
										if (data == 1) {
											var r = confirm("Would you like to download the report?");
											if (r == true) {
												document.location = "<?php echo base_url("?c=crr&m=getReservationsReport&fromDate="); ?>" + fromDate + "&toDate=" + toDate;
												$("#admin-authentication").hide();
											} else {
												$("#admin-authentication").hide();

											}
										} else {
											$("#admin-authentication").hide();
											alert('Error in generating report');
										}
									});
								}

							} else {
								alert("Please select a valid date range");
							}
						} else {
							$("#Apasscode").css('border', '3px solid red');
							setTimeout(function () {
								$("#Apasscode").css('border', '1px solid grey');
							}, 2000)
						}
					});
				}
			});
		}else{
			alert("Please select a valid date range");

		}
	});

	$(document).ready(function(){

		$("#fromDatePicker").datepicker({minDate: '08/01/2017', maxDate: -1
		});
		$("#toDatePicker").datepicker({minDate: '08/02/2017', maxDate: 0
		});
		$("#admin-authentication").hide();
	});
	</script>
</html>
