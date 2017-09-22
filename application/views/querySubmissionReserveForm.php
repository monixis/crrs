<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>Reserve Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" type="text/css" href="../css/library.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
		<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/menuStyle.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="http://library.marist.edu/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script type="text/javascript">
			$(document).ready(function() {
				$(".expand").click(function() {
					$(".ref_box").slideToggle("normal");
				});
				$("a[rel^='prettyPhoto']").prettyPhoto();
			});
		</script>
	</head>

	<body>
		<div id="headerContainer">
			<a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
		</div>

		<div id="menu">
			<div id="menuItems">

				<form method="GET" action="http://marist.summon.serialssolutions.com/search" class = "summon_search_child">
					<img src="http://library.marist.edu/images/foxhunt.png" class ="menu_foxhunt fox2"/>
					<input type="text" placeholder = "Search Full Text Databases..." name="s.q" class="summon_search_bar_child" size="20"/>
					<input type="submit" value="" class="search_button_child fox2"/>
					<a href="#" class="expand"> <img src="http://library.marist.edu/images/plus.png" class ="expand_img fox2"/></a>
				</form>
			</div>
		</div>

		<div class= "content_container">
			<div class = "container_home_child" >
				<div class = "ref_box">
					<table>
						<th class = "search_drop_header" colspan="4">Library Resources</th>
						<tr>

							<td  class = "search_drop"><a href="http://voyager.marist.edu/vwebv/searchBasic"><img src ="http://library.marist.edu/images/library_catalog_red.png" title="Library Catalog"></a></td>
							<td class = "search_drop"><a href="http://libguides.marist.edu/"><img src ="http://library.marist.edu/images/library_pathfinders_red.png" title="Pathfinders"></a></td>
							<td  class = "search_drop"><a href="http://library.marist.edu/forms/ask.php"> <img src ="http://library.marist.edu/images/ask_a_librarian_red.png" title="Ask A Librarian"></a></td>
							<td  class = "search_drop_last"><a href="http://site.ebrary.com.online.library.marist.edu/lib/marist/home.action"><img src ="http://library.marist.edu/images/ebrary_small.png" title ="ebrary"></a></td>
						</tr>
					</table>

				</div>
				<div class="side_bar">
					<ul>
						<li>
							<a class="side_link" href="http://library.marist.edu/forms/ask.php">Ask a Librarian</a>
						</li>
						<li>
							<a class="side_link" href="http://library.marist.edu/forms/acqbr.php">Acquisitions Request</a>
						</li>
						<li>
							<a class="side_link" href="http://marist.illiad.oclc.org/illiad/logon.html">Inter-Library Loan</a>
						</li>
						<li>
							<a class="side_link_current" href="#">Reserve Form</a>
						</li>
					</ul>
				</div>
				<div class= "content" style="width:630px;">
					<p class="breadcrumb">
						<a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
						> Forms > Reserve Forms

					</p>
					
					<h1 class="page_head">Confirmation Page</h1>
					
					<?php
					session_start();
					print('<p class="infoHeading">' . $_SESSION['Message'] . '</p>');
					?>
					
				</div>
			</div>

			<div class="bottom_container">
				<p class = "foot">
					James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
					<br />
					&#169; Copyright 2007-2012 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/ack.html?iframe=true&width=50%&height=62%" rel="prettyphoto[iframes]">Acknowledgements</a>
				</p>
			</div>
		</div>

	</body>
</html>
