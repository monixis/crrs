
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./styles/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="http://library.marist.edu/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script src="./js/jquery.rss.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 
		<script type="text/javascript" src="./js/jquery-ui.js"></script>
		<link rel="stylesheet" href="./styles/jquery-ui.css" type="text/css" /> 

    	
    	<script>
    		$(document).ready(function(){
    			$("#datepicker").datepicker({
    				minDate : "+0"
    			});
    		})
    	</script>
		<script type="text/javascript" charset="utf-8">
  		$(document).ready(function(){
   			$("a[rel^='prettyPhoto']").prettyPhoto();
  		});
		</script>
		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o), m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-55162672-1', 'auto');
			ga('send', 'pageview');

       </script>
       <script type="text/javascript">
		(function() {
			var hm = document.createElement('script'); hm.type ='text/javascript'; hm.async = true;
			hm.src = ('++u-heatmap-it+log-js').replace(/[+]/g,'/').replace(/-/g,'.');
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(hm, s);
		})();
		</script>
       <style>
			@-moz-document url-prefix() {
				#searching {
				margin-left: 270px;
			}
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
				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" /></div>			
				<div id="crroptions" style="margin-bottom: 5px;">
					

					<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Rooms Reservation System</h1>
					<!--div id="options"><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer?iframe=true&width=47%&height=55%"); ?>" rel="prettyphoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div-->
				<div id="options"><a href="<?php echo base_url(); ?>" title="Home" target="_self"><img class="mainoptions" src="./icons/home.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=crr&m=disclaimer&iframe=true&width=47%&height=55%"); ?>" rel="prettyPhoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div>
				
				</div>
		<div>
			
			<style>
			#keyTable {
    			position: relative;
    			left: 1000px;
    			top: 10px;
			}
			#pickDate{
				position: relative;
				left: 300px;
				bottom: 20px;
			}
			#resButton{
				position: relative;
				left: 700px;
				bottom: 30px;
			}
			#resTable{
				position: relative;
				bottom: 50px;
			}
			#viewDate{
				position: relative;
				bottom: 50px;
			}
			</style>
			<table id="keyTable" style="width:100%">
  				<tr>
  					<td style="background-color: GREEN"></td>
  					<td>= Available</td>
  				</tr>
  				<tr>
  					<td style="background-color: YELLOW"></td>
  					<td>= Unverified</td>
  				</tr>
  				<tr>
  					<td style="background-color: RED"></td>
  					<td>= Reserved</td>
  				</tr>
  				<tr>
  					<td style="background-color: ORANGE"></td>
  					<td>= Reservation Expired</td>
  				</tr>
  			</table>
  			<p id="pickDate">Pick a date to view available rooms: <input type="text" name="viewDate" id="datepicker" value="<?php $date = getdate(); echo($date["mon"]. "/" . $date["mday"]. "/" . $date["year"]); ?>" /></p>
 			<p id="viewDate">Date Being Viewed: 
 				<script type="text/javascript">
 				document.write($("#datepicker").val());
 				$( "#datepicker" ).change(function() {
 					// alert( "Handler for .change() called." );
 					document.getElementById("viewDate").innerHTML = "Date Being Viewed: " + $("#datepicker").val();
				});
 				</script> 
 			</p>
		</div>
		<div>
			<table id="resTable" border="1" style="width:100%">
  				<tr>
    				<td>Room#</td>	
				    <td>8:00am</td>
				    <td>9:00am</td>
				    <td>10:00am</td>
				    <td>11:00am</td>
				    <td>12:00pm</td>
				    <td>1:00pm</td>
				    <td>2:00pm</td>
				    <td>3:00pm</td>
				    <td>4:00pm</td>
				    <td>5:00pm</td>
				    <td>6:00pm</td>
				    <td>7:00pm</td>
				    <td>8:00pm</td>
				    <td>9:00pm</td>
				    <td>10:00pm</td>
				    <td>11:00pm</td>
				    <td>12:00am</td>
				    <td>1:00am</td>
				    <td>2:00am</td>
				 </tr>
				 <tr>
				    <td>110</td>
				    <td id="1108am" style="background-color: GREEN"></td>		
				    <td id="1109am" style="background-color: GREEN"></td>
				    <td id="11010am" style="background-color: GREEN"></td>
				    <td id="11011am" style="background-color: GREEN"></td>
				    <td id="11012pm" style="background-color: GREEN"></td>
				    <td id="1101pm" style="background-color: GREEN"></td>
				    <td id="1102pm" style="background-color: GREEN"></td>
				    <td id="1103pm" style="background-color: GREEN"></td>
				    <td id="1104pm" style="background-color: GREEN"></td>
				    <td id="1105pm" style="background-color: GREEN"></td>
				    <td id="1106pm" style="background-color: GREEN"></td>
				    <td id="1107pm" style="background-color: GREEN"></td>
				    <td id="1108pm" style="background-color: GREEN"></td>
				    <td id="1109pm" style="background-color: GREEN"></td>
				    <td id="11010pm" style="background-color: GREEN"></td>
				    <td id="11011pm" style="background-color: GREEN"></td>
				    <td id="11012am" style="background-color: GREEN"></td>
				    <td id="1101am" style="background-color: GREEN"></td>
				    <td id="1102am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>111</td>
				    <td id="1118am" style="background-color: GREEN"></td>		
				    <td id="1119am" style="background-color: GREEN"></td>
				    <td id="11110am" style="background-color: GREEN"></td>
				    <td id="11111am" style="background-color: GREEN"></td>
				    <td id="11112pm" style="background-color: GREEN"></td>
				    <td id="1111pm" style="background-color: GREEN"></td>
				    <td id="1112pm" style="background-color: GREEN"></td>
				    <td id="1113pm" style="background-color: GREEN"></td>
				    <td id="1114pm" style="background-color: GREEN"></td>
				    <td id="1115pm" style="background-color: GREEN"></td>
				    <td id="1116pm" style="background-color: GREEN"></td>
				    <td id="1117pm" style="background-color: GREEN"></td>
				    <td id="1118pm" style="background-color: GREEN"></td>
				    <td id="1119pm" style="background-color: GREEN"></td>
				    <td id="11110pm" style="background-color: GREEN"></td>
				    <td id="11111pm" style="background-color: GREEN"></td>
				    <td id="11112am" style="background-color: GREEN"></td>
				    <td id="1111am" style="background-color: GREEN"></td>
				    <td id="1112am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>112</td>
				    <td id="1128am" style="background-color: GREEN"></td>		
				    <td id="1129am" style="background-color: GREEN"></td>
				    <td id="11210am" style="background-color: GREEN"></td>
				    <td id="11211am" style="background-color: GREEN"></td>
				    <td id="11212pm" style="background-color: GREEN"></td>
				    <td id="1121pm" style="background-color: GREEN"></td>
				    <td id="1122pm" style="background-color: GREEN"></td>
				    <td id="1123pm" style="background-color: GREEN"></td>
				    <td id="1124pm" style="background-color: GREEN"></td>
				    <td id="1125pm" style="background-color: GREEN"></td>
				    <td id="1126pm" style="background-color: GREEN"></td>
				    <td id="1127pm" style="background-color: GREEN"></td>
				    <td id="1128pm" style="background-color: GREEN"></td>
				    <td id="1129pm" style="background-color: GREEN"></td>
				    <td id="11210pm" style="background-color: GREEN"></td>
				    <td id="11211pm" style="background-color: GREEN"></td>
				    <td id="11212am" style="background-color: GREEN"></td>
				    <td id="1121am" style="background-color: GREEN"></td>
				    <td id="1122am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>300A</td>
				    <td id="300A8am" style="background-color: GREEN"></td>		
				    <td id="300A9am" style="background-color: GREEN"></td>
				    <td id="300A10am" style="background-color: GREEN"></td>
				    <td id="300A11am" style="background-color: GREEN"></td>
				    <td id="300A12pm" style="background-color: GREEN"></td>
				    <td id="300A1pm" style="background-color: GREEN"></td>
				    <td id="300A2pm" style="background-color: GREEN"></td>
				    <td id="300A3pm" style="background-color: GREEN"></td>
				    <td id="300A4pm" style="background-color: GREEN"></td>
				    <td id="300A5pm" style="background-color: GREEN"></td>
				    <td id="300A6pm" style="background-color: GREEN"></td>
				    <td id="300A7pm" style="background-color: GREEN"></td>
				    <td id="300A8pm" style="background-color: GREEN"></td>
				    <td id="300A9pm" style="background-color: GREEN"></td>
				    <td id="300A10pm" style="background-color: GREEN"></td>
				    <td id="300A11pm" style="background-color: GREEN"></td>
				    <td id="300A12am" style="background-color: GREEN"></td>
				    <td id="300A1am" style="background-color: GREEN"></td>
				    <td id="300A2am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>300B</td>
				    <td id="300B8am" style="background-color: GREEN"></td>		
				    <td id="300B9am" style="background-color: GREEN"></td>
				    <td id="300B10am" style="background-color: GREEN"></td>
				    <td id="300B11am" style="background-color: GREEN"></td>
				    <td id="300B12pm" style="background-color: GREEN"></td>
				    <td id="300B1pm" style="background-color: GREEN"></td>
				    <td id="300B2pm" style="background-color: GREEN"></td>
				    <td id="300B3pm" style="background-color: GREEN"></td>
				    <td id="300B4pm" style="background-color: GREEN"></td>
				    <td id="300B5pm" style="background-color: GREEN"></td>
				    <td id="300B6pm" style="background-color: GREEN"></td>
				    <td id="300B7pm" style="background-color: GREEN"></td>
				    <td id="300B8pm" style="background-color: GREEN"></td>
				    <td id="300B9pm" style="background-color: GREEN"></td>
				    <td id="300B10pm" style="background-color: GREEN"></td>
				    <td id="300B11pm" style="background-color: GREEN"></td>
				    <td id="300B12am" style="background-color: GREEN"></td>
				    <td id="300B1am" style="background-color: GREEN"></td>
				    <td id="300B2am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>300C</td>
				    <td id="300C8am" style="background-color: GREEN"></td>		
				    <td id="300C9am" style="background-color: GREEN"></td>
				    <td id="300C10am" style="background-color: GREEN"></td>
				    <td id="300C11am" style="background-color: GREEN"></td>
				    <td id="300C12pm" style="background-color: GREEN"></td>
				    <td id="300C1pm" style="background-color: GREEN"></td>
				    <td id="300C2pm" style="background-color: GREEN"></td>
				    <td id="300C3pm" style="background-color: GREEN"></td>
				    <td id="300C4pm" style="background-color: GREEN"></td>
				    <td id="300C5pm" style="background-color: GREEN"></td>
				    <td id="300C6pm" style="background-color: GREEN"></td>
				    <td id="300C7pm" style="background-color: GREEN"></td>
				    <td id="300C8pm" style="background-color: GREEN"></td>
				    <td id="300C9pm" style="background-color: GREEN"></td>
				    <td id="300C10pm" style="background-color: GREEN"></td>
				    <td id="300C11pm" style="background-color: GREEN"></td>
				    <td id="300C12am" style="background-color: GREEN"></td>
				    <td id="300C1am" style="background-color: GREEN"></td>
				    <td id="300C2am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>300D</td>
				    <td id="300D8am" style="background-color: GREEN"></td>		
				    <td id="300D9am" style="background-color: GREEN"></td>
				    <td id="300D10am" style="background-color: GREEN"></td>
				    <td id="300D11am" style="background-color: GREEN"></td>
				    <td id="300D12pm" style="background-color: GREEN"></td>
				    <td id="300D1pm" style="background-color: GREEN"></td>
				    <td id="300D2pm" style="background-color: GREEN"></td>
				    <td id="300D3pm" style="background-color: GREEN"></td>
				    <td id="300D4pm" style="background-color: GREEN"></td>
				    <td id="300D5pm" style="background-color: GREEN"></td>
				    <td id="300D6pm" style="background-color: GREEN"></td>
				    <td id="300D7pm" style="background-color: GREEN"></td>
				    <td id="300D8pm" style="background-color: GREEN"></td>
				    <td id="300D9pm" style="background-color: GREEN"></td>
				    <td id="300D10pm" style="background-color: GREEN"></td>
				    <td id="300D11pm" style="background-color: GREEN"></td>
				    <td id="300D12am" style="background-color: GREEN"></td>
				    <td id="300D1am" style="background-color: GREEN"></td>
				    <td id="300D2am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>306</td>
				    <td id="3068am" style="background-color: GREEN"></td>		
				    <td id="3069am" style="background-color: GREEN"></td>
				    <td id="30610am" style="background-color: GREEN"></td>
				    <td id="30611am" style="background-color: GREEN"></td>
				    <td id="30612pm" style="background-color: GREEN"></td>
				    <td id="3061pm" style="background-color: GREEN"></td>
				    <td id="3062pm" style="background-color: GREEN"></td>
				    <td id="3063pm" style="background-color: GREEN"></td>
				    <td id="3064pm" style="background-color: GREEN"></td>
				    <td id="3065pm" style="background-color: GREEN"></td>
				    <td id="3066pm" style="background-color: GREEN"></td>
				    <td id="3067pm" style="background-color: GREEN"></td>
				    <td id="3068pm" style="background-color: GREEN"></td>
				    <td id="3069pm" style="background-color: GREEN"></td>
				    <td id="30610pm" style="background-color: GREEN"></td>
				    <td id="30611pm" style="background-color: GREEN"></td>
				    <td id="30612am" style="background-color: GREEN"></td>
				    <td id="3061am" style="background-color: GREEN"></td>
				    <td id="3062am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>312</td>
				    <td id="3128am" style="background-color: GREEN"></td>		
				    <td id="3129am" style="background-color: GREEN"></td>
				    <td id="31210am" style="background-color: GREEN"></td>
				    <td id="31211am" style="background-color: GREEN"></td>
				    <td id="31212pm" style="background-color: GREEN"></td>
				    <td id="3121pm" style="background-color: GREEN"></td>
				    <td id="3122pm" style="background-color: GREEN"></td>
				    <td id="3123pm" style="background-color: GREEN"></td>
				    <td id="3124pm" style="background-color: GREEN"></td>
				    <td id="3125pm" style="background-color: GREEN"></td>
				    <td id="3126pm" style="background-color: GREEN"></td>
				    <td id="3127pm" style="background-color: GREEN"></td>
				    <td id="3128pm" style="background-color: GREEN"></td>
				    <td id="3129pm" style="background-color: GREEN"></td>
				    <td id="31210pm" style="background-color: GREEN"></td>
				    <td id="31211pm" style="background-color: GREEN"></td>
				    <td id="31212am" style="background-color: GREEN"></td>
				    <td id="3121am" style="background-color: GREEN"></td>
				    <td id="3122am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>313</td>
				    <td id="3138am" style="background-color: GREEN"></td>		
				    <td id="3139am" style="background-color: GREEN"></td>
				    <td id="31310am" style="background-color: GREEN"></td>
				    <td id="31311am" style="background-color: GREEN"></td>
				    <td id="31312pm" style="background-color: GREEN"></td>
				    <td id="3131pm" style="background-color: GREEN"></td>
				    <td id="3132pm" style="background-color: GREEN"></td>
				    <td id="3133pm" style="background-color: GREEN"></td>
				    <td id="3134pm" style="background-color: GREEN"></td>
				    <td id="3135pm" style="background-color: GREEN"></td>
				    <td id="3136pm" style="background-color: GREEN"></td>
				    <td id="3137pm" style="background-color: GREEN"></td>
				    <td id="3138pm" style="background-color: GREEN"></td>
				    <td id="3139pm" style="background-color: GREEN"></td>
				    <td id="31310pm" style="background-color: GREEN"></td>
				    <td id="31311pm" style="background-color: GREEN"></td>
				    <td id="31312am" style="background-color: GREEN"></td>
				    <td id="3131am" style="background-color: GREEN"></td>
				    <td id="3132am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>314</td>
				    <td id="3148am" style="background-color: GREEN"></td>		
				    <td id="3149am" style="background-color: GREEN"></td>
				    <td id="31410am" style="background-color: GREEN"></td>
				    <td id="31411am" style="background-color: GREEN"></td>
				    <td id="31412pm" style="background-color: GREEN"></td>
				    <td id="3141pm" style="background-color: GREEN"></td>
				    <td id="3142pm" style="background-color: GREEN"></td>
				    <td id="3143pm" style="background-color: GREEN"></td>
				    <td id="3144pm" style="background-color: GREEN"></td>
				    <td id="3145pm" style="background-color: GREEN"></td>
				    <td id="3146pm" style="background-color: GREEN"></td>
				    <td id="3147pm" style="background-color: GREEN"></td>
				    <td id="3148pm" style="background-color: GREEN"></td>
				    <td id="3149pm" style="background-color: GREEN"></td>
				    <td id="31410pm" style="background-color: GREEN"></td>
				    <td id="31411pm" style="background-color: GREEN"></td>
				    <td id="31412am" style="background-color: GREEN"></td>
				    <td id="3141am" style="background-color: GREEN"></td>
				    <td id="3142am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>315</td>
				    <td id="3158am" style="background-color: GREEN"></td>		
				    <td id="3159am" style="background-color: GREEN"></td>
				    <td id="31510am" style="background-color: GREEN"></td>
				    <td id="31511am" style="background-color: GREEN"></td>
				    <td id="31512pm" style="background-color: GREEN"></td>
				    <td id="3151pm" style="background-color: GREEN"></td>
				    <td id="3152pm" style="background-color: GREEN"></td>
				    <td id="3153pm" style="background-color: GREEN"></td>
				    <td id="3154pm" style="background-color: GREEN"></td>
				    <td id="3155pm" style="background-color: GREEN"></td>
				    <td id="3156pm" style="background-color: GREEN"></td>
				    <td id="3157pm" style="background-color: GREEN"></td>
				    <td id="3158pm" style="background-color: GREEN"></td>
				    <td id="3159pm" style="background-color: GREEN"></td>
				    <td id="31510pm" style="background-color: GREEN"></td>
				    <td id="31511pm" style="background-color: GREEN"></td>
				    <td id="31512am" style="background-color: GREEN"></td>
				    <td id="3151am" style="background-color: GREEN"></td>
				    <td id="3152am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>316</td>
				    <td id="3168am" style="background-color: GREEN"></td>		
				    <td id="3169am" style="background-color: GREEN"></td>
				    <td id="31610am" style="background-color: GREEN"></td>
				    <td id="31611am" style="background-color: GREEN"></td>
				    <td id="31612pm" style="background-color: GREEN"></td>
				    <td id="3161pm" style="background-color: GREEN"></td>
				    <td id="3162pm" style="background-color: GREEN"></td>
				    <td id="3163pm" style="background-color: GREEN"></td>
				    <td id="3164pm" style="background-color: GREEN"></td>
				    <td id="3165pm" style="background-color: GREEN"></td>
				    <td id="3166pm" style="background-color: GREEN"></td>
				    <td id="3167pm" style="background-color: GREEN"></td>
				    <td id="3168pm" style="background-color: GREEN"></td>
				    <td id="3169pm" style="background-color: GREEN"></td>
				    <td id="31610pm" style="background-color: GREEN"></td>
				    <td id="31611pm" style="background-color: GREEN"></td>
				    <td id="31612am" style="background-color: GREEN"></td>
				    <td id="3161am" style="background-color: GREEN"></td>
				    <td id="3162am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>317</td>
				    <td id="3178am" style="background-color: GREEN"></td>		
				    <td id="3179am" style="background-color: GREEN"></td>
				    <td id="31710am" style="background-color: GREEN"></td>
				    <td id="31711am" style="background-color: GREEN"></td>
				    <td id="31712pm" style="background-color: GREEN"></td>
				    <td id="3171pm" style="background-color: GREEN"></td>
				    <td id="3172pm" style="background-color: GREEN"></td>
				    <td id="3173pm" style="background-color: GREEN"></td>
				    <td id="3174pm" style="background-color: GREEN"></td>
				    <td id="3175pm" style="background-color: GREEN"></td>
				    <td id="3176pm" style="background-color: GREEN"></td>
				    <td id="3177pm" style="background-color: GREEN"></td>
				    <td id="3178pm" style="background-color: GREEN"></td>
				    <td id="3179pm" style="background-color: GREEN"></td>
				    <td id="31710pm" style="background-color: GREEN"></td>
				    <td id="31711pm" style="background-color: GREEN"></td>
				    <td id="31712am" style="background-color: GREEN"></td>
				    <td id="3171am" style="background-color: GREEN"></td>
				    <td id="3172am" style="background-color: GREEN"></td>
				  </tr>
				  <tr>
				    <td>318</td>
				    <td id="3188am" style="background-color: GREEN"></td>		
				    <td id="3189am" style="background-color: GREEN"></td>
				    <td id="31810am" style="background-color: GREEN"></td>
				    <td id="31811am" style="background-color: GREEN"></td>
				    <td id="31812pm" style="background-color: GREEN"></td>
				    <td id="3181pm" style="background-color: GREEN"></td>
				    <td id="3182pm" style="background-color: GREEN"></td>
				    <td id="3183pm" style="background-color: GREEN"></td>
				    <td id="3184pm" style="background-color: GREEN"></td>
				    <td id="3185pm" style="background-color: GREEN"></td>
				    <td id="3186pm" style="background-color: GREEN"></td>
				    <td id="3187pm" style="background-color: GREEN"></td>
				    <td id="3188pm" style="background-color: GREEN"></td>
				    <td id="3189pm" style="background-color: GREEN"></td>
				    <td id="31810pm" style="background-color: GREEN"></td>
				    <td id="31811pm" style="background-color: GREEN"></td>
				    <td id="31812am" style="background-color: GREEN"></td>
				    <td id="3181am" style="background-color: GREEN"></td>
				    <td id="3182am" style="background-color: GREEN"></td>
				  </tr>
			</table>
		</div>	
		<div>
			<button id="resButton" onclick="location.href='<?php echo base_url("?c=crr&m=reserveform"); ?>'">
     Reserve Form</button>
    	</div>	
				
			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2014 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> 
				</p>

			</div>
			
	</body>
</html>
