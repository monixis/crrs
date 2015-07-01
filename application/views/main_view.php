<!--!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title><?php echo $title; ?></title-->
		<link rel="stylesheet" type="text/css" href="./style/view.css" />
	<!--/head>
	<body>
		<div class = "container_home">
				<div id="emplist"-->
					<h2>Employer List</h2>
					<ol id="list">
					<?php
					foreach ($result as $row) {
						$employer = $row -> empname;
						$empid = $row -> eid;
					    $empurl = base_url("?c=rtw&m=getemployerdetails&eid=").$empid;
					?>
					<li class="emp"><a href="<?php echo $empurl; ?>" target="_blank"><?php echo $employer; ?></a></li>
					<?php
					}
					?>	
					</ol>
			     <!--/div>
         </div>
	</body>
</html-->