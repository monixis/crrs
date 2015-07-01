<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>Admin Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="./style/main.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script src="http://library.marist.edu/js/libraryMenu.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="http://library.marist.edu/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		<script src="./js/jquery.rss.js" type="text/javascript" charset="utf-8"></script>
		
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
	</head>
	
	<body>
		<div id="headerContainer">
			<a href="<?php echo base_url(); ?>" target="_self"> 
				<div id="header"></div>
			</a>	
		</div>
		
		<div id="menu">
			<div id="menuItems">

			</div>
		</div>

		<div class = "container_home">
			<div class="empdetails">
				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" />
				</div>
				<div id="rtwoptions" style="margin-bottom: 5px;">
					<h1 style="color: #b31b1b; text-align: center;">Admin - Road to the Workplace</h1>
				</div>
				<select id="employers">
					<option value="0">SELECT AN EMPLOYER TO EDIT</option>
				<?php
					foreach ($result as $row) {
						$employer = $row -> empname;
						$empid = $row -> eid;
					    $empurl = base_url("?c=rtw&m=getemployerdetails&eid=").$empid;
					?>
					<option value="<?php echo $empid; ?>"><?php echo $employer; ?></option>
					<?php
					}
					?>	
				</select>
				<input type="button" id="newEmp" value="Add a New Employer" style="float:right;"></input>
				<div id="empDetails">
				
				</div>	
				
			</div>

		</div>
		</div>
			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2014 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" rel="prettyphoto[iframes]">Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy </a> 
				</p>

			</div>
			<script type="text/javascript">
			$("select#employers").change(function(){
				var empid= $(this).find('option:selected').val();
				if (empid > 0){
					var url;
				url = "<?php echo base_url("?c=rtw&m=getemployerdetailsforAdmin"); ?>" + "&eid=(" + empid + ")"; 
				$("#empDetails").empty();
				$("#empDetails").load(url);
				}
				
					
			});
			
			
			
			</script>
	</body>
</html>
