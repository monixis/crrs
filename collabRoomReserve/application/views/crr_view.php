
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./style/main.css" />
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

		<div class = "container_home">

				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" /></div>			
				<div id="crroptions" style="margin-bottom: 5px;">
					

					<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Rooms Reservation System</h1>
					<!--div id="options"><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer?iframe=true&width=47%&height=55%"); ?>" rel="prettyphoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div-->
				<div id="options"><a href="<?php echo base_url(); ?>" title="Home" target="_self"><img class="mainoptions" src="./icons/home.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=crr&m=disclaimer&iframe=true&width=47%&height=55%"); ?>" rel="prettyPhoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div>
				
				</div>
		</div>
		<div>
			Pick a date to view available rooms: <input type="text" name="viewDate" id="datepicker" />
 			<p>Date: <?php $date = getdate(); echo($date["mon"]. "/" . $date["mday"]. "/" . $date["year"]); ?></p>
		</div>
		<div>
			<table border="1" style="width:100%">
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
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>111</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>112</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>300A</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>300B</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>300C</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>300D</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>306</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>312</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>313</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>314</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>315</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>316</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>317</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
				  <tr>
				    <td>318</td>
				    <td></td>		
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				    <td></td>
				  </tr>
			</table>
		</div>	
		<div>
			<button onclick="location.href='<?php echo base_url("?c=crr&m=reserveform"); ?>'">
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
