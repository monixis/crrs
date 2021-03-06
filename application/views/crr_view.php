<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67370973-1', 'auto');
  ga('send', 'pageview');


</script>

		<style type="text/css">
		#admin1:hover{
			opacity:0.5;
	cursor: pointer;
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

		<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Room Reservation System 4.1</h1>
		<div id="passcode" style="margin-top:0px; margin-left: auto; margin-right: auto; width: 300px; height: 0px;">
 							<strong>PASSCODE: </strong>
							<input type="password" name='passcode' id='passcode' style="height:23px; margin-left: 10px;" autofocus></input><br/>
							<input type="button" class="btn" id="submit" value="Submit" style="margin-left:95px; margin-top:10px; width:100px;"></input>
		</div>

		<div id="date" style="align:center">

				<div id="tfheader">
					        <!--input type="text" id="tfq" class="tftextinput2" name="q" /><img id="search" style="margin-left:5px;" src="./icons/search.png"/><!--input type="submit" value=">" class="tfbutton2"><br-->

				</div>

  			<p id="pickDate">Select a date: <input type="text" name="viewDate" id="datepicker" value="" /><img src="./icons/admin.png" style="width: 20px; height: 20px; margin-left: 5px;" id="admin1"/><!--a href="#" id="admin">Admin</a--></p></br>



 			<!--p id="viewDate">Date Being Viewed:
 				<script type="text/javascript">
 				document.write($("#datepicker").val());
 				$( "#datepicker" ).change(function() {
 					// alert( "Handler for .change() called." );
 					document.getElementById("viewDate").innerHTML = "Date Being Viewed: " + $("#datepicker").val();
				});
 				</script>
 			</p-->
 			<!--div id="admin-authentication" style="border: 1px solid grey; width: 360px; margin-left: auto; margin-right: auto; padding: 12px;">
				Admin Passcode: <input type="text" name="fname" />
 				<input type="submit" value="Submit">
 			</div-->
 		<div id="admin-authentication" style="border: 1px solid grey; width: 360px; margin-left: auto; margin-right: auto; padding: 12px; ">
				<strong>ADMIN PASSCODE: </strong><input type="password" name="Apcode" id="Apasscode" />
 				<button type="button" class="btn" id="adminsubmit" style="margin-left:37%; margin-top:5px;">Submit</button>
 		</div>
			<div id="category" style="width:620px; margin-left:auto; margin-right: auto;">
				<strong>Patron - </strong>
				<select id="pat_drop" style="height: 25px;">
					<?php foreach ($patrons as $patron){?>
						<option value="<?php echo $patron -> patr_id?>"><?php echo $patron -> patr_name;?></option>
					<?php }?>
				</select>

                <label>requesting room for </label>
                <strong>Category - </strong>
				<select id="cat_drop" style="height: 25px;">
					<?php foreach ($categories as $category){?>
						<option value="<?php echo $category -> catg_id?>"><?php echo $category -> catg_name?></option>
					<?php }?>
				</select>
				<button type="button" class="btn" id="filterRooms" style=" margin-top:5px; height: 35px; font-size: 10pt;">Submit</button>
				<p id='currectSelection' style="font-weight: bold; font-style: italic;"></p>
			</div>

<!--			<div id="patronType" style="width:800px; margin:0 auto;align-content: center">

			</div>-->
 		</div>

		<div id="dashboard_view">


		</div>

			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2016 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="<?php echo base_url("?c=crr&m=ack");?>" target="_blank" >Acknowledgement</a>
				</p>

			</div>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<!--script type="text/javascript" src="./js/jquery-1.6.1.min.js"></script-->
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="./js/dashboard.js"></script>
		<script type="text/javascript">

			$(document).ready(function(){
    			$("#datepicker").datepicker({
    				maxDate: "+1w"
    			});
    			$("#datepicker").datepicker( "setDate", new Date());
    			$("#datepicker").empty();
			    $("#tfheader").load('<?php echo base_url("?c=crr&m=tfq");?>');
			    $("#admin-authentication").hide();
			    $('p#currectSelection').html("Current Selection => Patron: " + $('#pat_drop option:selected').text() + " & Category: " + $('#cat_drop option:selected').text());
    		});

			$("input#submit").click(function(){
				var pcode = $("input#passcode").val();
				$.post("<?php echo base_url("?c=crr&m=user_verify&pass=");?>"+pcode, {
				}).done(function (authorized) {
					if (authorized == 1){
						$("#date, #dashboard_view").css("visibility", "visible");
						$("div#passcode").css("visibility", "hidden");
						/* Create date object. */
						$("#dashboard_view").html('<div id="searching" style="margin-top: 155px; text-align: center;"><img src="./icons/page-loader.gif" /><br/><p style="text-align: center;"></p></div>');
						  var url="<?php echo base_url("?c=crr&m=todayRes&cat_type="); ?>"+category_type+"&pat_type="+patron_type;
						//var url="<!--?php echo base_url("?c=crr&m=todayReservation"); ?>";
						// console.log(url);
						setTimeout (function(){

							$('#dashboard_view').load(url);//http://localhost/crrs/?c=crr&m=todayReservation
						}, 1000);
					}else{
						$("input#passcode").css('border', '3px solid red');
						setTimeout(function(){
							$("input#passcode").css('border', '1px solid grey');
						}, 2000)
					}
				});
			});

			$('#passcode').keypress(function(e){
				var key = e.which;
				if(key == 13){
				var pcode = $("input#passcode").val();
					$.post("<?php echo base_url("?c=crr&m=user_verify&pass=");?>"+pcode, {
					}).done(function (authorized) {
				if (authorized == 1){
					$("#date, #dashboard_view").css("visibility", "visible");
					$("div#passcode").css("visibility", "hidden");
					/* Create date object. */
					$("#dashboard_view").html('<div id="searching" style="margin-top: 155px; text-align: center;"><img src="./icons/page-loader.gif" /><br/><p style="text-align: center;"></p></div>');
                   //  var url="<?php echo base_url("?c=crr&m=todayReservation"); ?>";
					 var url="<?php echo base_url("?c=crr&m=todayRes&cat_type=1&pat_type=1"); ?>";
					// console.log(url);
					setTimeout (function(){
						$('#dashboard_view').load(url);//http://localhost/crrs/?c=crr&m=todayReservation
					}, 1000);

				}else{
					$("input#passcode").css('border', '3px solid red');
					setTimeout(function(){
						$("input#passcode").css('border', '1px solid grey');
					}, 2000)
				}
					});
				}
			});

			jQuery(function($){
				$("#adminsubmit").click(function(){
					var Apcode = $("#Apasscode").val();

					$.post("<?php echo base_url("?c=crr&m=admin_verify&pass=");?>"+Apcode, {

					}).done(function (authorized) {
						if (authorized == 1) {
							$("#datepicker").datepicker("option", "maxDate", "+1y");
							$("#admin-authentication").hide();
							$("input#Apasscode").val('');
							$("#hdresTable").css("margin-top", "0px");
						} else {
							$("#Apasscode").css('border', '3px solid red');
							setTimeout(function () {
								$("#Apasscode").css('border', '1px solid grey');
							}, 2000)
						}
					});
				});

				$('#Apasscode').keypress(function(e){
				var key = e.which;
				if(key == 13){
				var Apcode = $("input#Apasscode").val();

					$.post("<?php echo base_url("?c=crr&m=admin_verify&pass=");?>"+Apcode, {

					}).done(function (authorized) {
				if (authorized == 1){
						$("#datepicker").datepicker( "option", "maxDate", "+1y" );
						$("#admin-authentication").hide();
						$("input#Apasscode").val('');
						$("#hdresTable").css("margin-top", "0px");
					}else{
						$("#Apasscode").css('border', '3px solid red');
							setTimeout(function(){
								$("#Apasscode").css('border', '1px solid grey');
							}, 2000)
					}

				});
				}
			});
			});
			jQuery(function($){
				$('#admin1').click(function(){
					$("#admin-authentication").toggle();
					if($("#admin-authentication").is(":visible") == true){
						$("#hdresTable").css("margin-top", "93px");
					}else{
						$("#hdresTable").css("margin-top", "0px");
					};
					//$("#datepicker").datepicker( "option", "maxDate", "+1y" );
				});
			});
/*            $("#cat_drop").change(function () {
                var c = document.getElementById("cat_drop");
                var category_type = c.options[c.selectedIndex].value;

                var p = document.getElementById("pat_drop");
                var patron_type = p.options[p.selectedIndex].value;

                if(category_type > 0){

                    var url="<!--?php echo base_url("?c=crr&m=todayRes&cat_type="); ?>"+category_type+"&pat_type="+patron_type;
                    $('#dashboard_view').load(url);
                }
            });
            $("#pat_drop").change(function () {

                var p = document.getElementById("pat_drop");
                var patron_type = p.options[p.selectedIndex].value;
                var c = document.getElementById("cat_drop");
                var category_type = c.options[c.selectedIndex].value;
                if(patron_type > 0){
                    var url="<!--?php echo base_url("?c=crr&m=todayRes&cat_type="); ?>"+category_type+"&pat_type="+patron_type;
                    $('#dashboard_view').load(url);

                }

                //alert(end);
            });*/
			$("#filterRooms").click(function(){
				var date = $('input#datepicker').val();
				//var c = document.getElementById("cat_drop");
				//var category_type = c.options[c.selectedIndex].value;
				//var p = document.getElementById("pat_drop");
				//var patron_type = p.options[p.selectedIndex].value;
				var category_type = $('#cat_drop').val();
				var patron_type = $('#pat_drop').val();
				var slotId = localStorage.getItem("slotId");
				var url="<?php echo base_url("?c=crr&m=getReservations&date="); ?>"+date+"&slotId="+slotId+"&cat_type="+category_type+"&pat_type="+patron_type;
              // 	var url = ("?c=crr&m=getReservations&date="+date+"&slotId="+slotId+"&cat_type="+category_type+"&pat_type="+patron_type);//http://localhost:9090/crrs/?c=crr&m=getReservations&date="+date
				$('#dashboard_view').empty();
			    $("#dashboard_view").html('<div id="searching" style="margin-top: 155px; text-align: center;"><img src="./icons/page-loader.gif" /><br/><p style="text-align: center;"></p></div>');

            //var url="<!--?php echo base_url("?c=crr&m=todayRes&cat_type="); ?>"+category_type+"&pat_type="+patron_type; !-->
			//	$('#dashboard_view').load(url);
                setTimeout (function(){
                    $('#dashboard_view').load(url);//http://localhost/crrs/?c=crr&m=todayReservation
					$('p#currectSelection').html("Current Selection => Patron: " + $('#pat_drop option:selected').text() + " & Category: " + $('#cat_drop option:selected').text());
                }, 1000);
			});

			</script>
	</body>
</html>
