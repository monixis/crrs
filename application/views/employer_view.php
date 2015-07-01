
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>RTW: Employer's Profile</title>
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
				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" /></div>	
				<div id="rtwoptions" style="margin-bottom: 5px;">
					<h1 style="color: #b31b1b; text-align: center;">Road to the Workplace</h1>
					<div id="options"><a href="<?php echo base_url(); ?>" title="Home" target="_self"><img class="mainoptions" src="./icons/home.png" /></a><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer?iframe=true&width=47%&height=55%"); ?>" rel="prettyphoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div>
				</div>
				<div id="empdetailsleft">
						<?php
					foreach ($result as $row) {
						$employer = $row -> empname;
						$website = $row -> website;
						$corporatewebsite = $row -> corporatewebsite;
						$additionalwebsites = $row -> additionalwebsites;
						$leadership = $row -> leadership;
						$hrcontactinfo = $row -> hrcontactinfo;
						$jobfaircontactinfo = $row -> jobfaircontactinfo;
						$location = $row -> location;
						$region = $row -> region;
						$size = $row -> size;
						$noofemp = $row -> noofemp;
						$ticker = $row -> ticker;
						$affiliates = $row -> affiliates;
						$news = $row -> news;
						$budget = $row -> budget;
						$facebook = $row -> facebook;
						$twitter = $row -> twitter;
						$linkedin = $row -> linkedin;
						$taxforms = $row -> taxforms;
						$socialmedia = $row -> socialmedia;
						$missionstmt = $row -> missionstmt;
						$overview = $row -> overview;
						$culture = $row -> culture;
						$financials = $row -> financials;
						$citations = $row -> citations;
						$poi = $row -> poi;
					}
				     ?>		
				     <h2 id="empname"><?php echo $employer; ?></h2>
				     
				     <p class="viewdetails" id='poi'><strong>Points of Interest: </strong><br/>
						<?php echo $poi; ?>
					</p>
					
				     	
					<p class="viewdetails" id='overview'><strong>Employer Overview: </strong><br/>
						<?php echo $overview; ?>
					</p>
					
					<p class="viewdetails" id='missionstmt'><strong>Mission Statement: </strong><br/><br/>
						<?php echo $missionstmt; ?>
					</p>
					
					<p class="viewdetails" id='culture'><strong>Company Culture: </strong><br/><br/>
						<?php echo $culture; ?>
					</p>
					<p class="viewdetails" id='financials'><strong>Financials: </strong><br/>
						<?php echo $financials; ?>
					</p>
					<p class="viewdetails" id='taxforms'><strong>990 Tax Forms: </strong><br/>
						<?php echo $taxforms; ?>
				    </p>
					<p class="viewdetails" id='citations'><strong>Citations: </strong><br/>
						<?php echo $citations; ?>
				    </p>
				    
				</div>
			
				<div id="empdetailsright">
					
				
				<p class="viewdetails" id='ticker'><strong>Ticker: </strong><?php echo $ticker; ?></p>
				<p class="viewdetails" id='location'><strong>Location: </strong><?php echo $location; ?></p>
				<p class="viewdetails" id='region'><strong>Region: </strong><?php echo $region; ?></p>
				<p class="viewdetails" id='noofemp'><strong>No. of Employees: </strong><?php echo $noofemp; ?></p>				
				<p class="viewdetails" id='affiliates'><strong>Affiliates: </strong><?php echo $affiliates; ?></p>
				<p class="viewdetails" id='budget'><strong>Budget: </strong><?php echo $budget; ?></p>
				
				<p class="viewdetails" id='websites'><strong>Websites:</strong><br/><br/>
					<?php echo $website; ?><br/>
					<?php echo $corporatewebsite; ?><br/>
					<?php echo $additionalwebsites; ?>
				</p>
				
				<p class="viewdetails" id='contactinfo'><strong>Contact Information: </strong><br/><br/>
					<?php echo $hrcontactinfo; ?>
					<?php echo $jobfaircontactinfo; ?>
				</p>
				
				<p class="viewdetails" id='leadership'><strong>Leadership: </strong><br/><br/>
						<?php echo $leadership; ?>
				</p> 
				
				<p class="viewdetails" style="margin-top: 0px;"><strong>News</strong></p>
				<div id="rss-news">
					
				</div>
				
				<p class="viewdetails"><strong>Social Media: </strong><br/><br/>
					<!--a href=<?php echo $twitter; ?> target="_blank"><img class="icons" src="./icons/twitter.png"/></a>
					<a href=<?php echo $facebook; ?> target="_blank"><img class="icons" src="./icons/facebook.png"/></a>
					<a href=<?php echo $linkedin; ?> target="_blank"><img class="icons" src="./icons/linkedin.png"/></a-->
					<div id="socialmedias">
						<?php echo $facebook; ?> 
					<?php echo $twitter; ?> 
					<?php echo $linkedin; ?>	
					</div>	
					
				</p>
				
				<p class="viewdetails" id='othersocialmedia'><strong>Other Social Media Links: </strong><br/><br/>
					<?php echo $socialmedia; ?>
				</p>
				<p class="viewdetails" id='major'><strong>Associated Majors: </strong><br/><br/>
					<?php
					foreach ($majors as $row1) {
						$mid = $row1 -> mid;
						$major = $row1 -> major;
					?>
						<a class="refinelist" href="<?php echo base_url("?c=rtw&m=getrefinedemployers&qry=emptype%20in%20(1,2,3,4,5,6)%20and%20mid%20in%20(". $mid .")?iframe=true&width=45%&height=65%"); ?>" rel="prettyphoto">
							<?php echo $major; ?>
						</a>&nbsp;
					<?php } ?>
				</p>
				
				<p class="viewdetails" id='industry'><strong>Associated Industries: </strong><br/><br/>

					<?php
					foreach ($industries as $row2) {
						$iid = $row2 -> iid;
						$industry = $row2 -> industry;
					?>
						<a class="refinelist" href="<?php echo base_url("?c=rtw&m=getrefinedemployers&qry=emptype%20in%20(1,2,3,4,5,6)%20and%20iid%20in%20(". $iid .")?iframe=true&width=45%&height=65%"); ?>" rel="prettyphoto">
							<?php echo $industry; ?>
						</a>&nbsp;
					<?php } ?>
					
				</p>
				
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
			
					var tags = document.getElementsByTagName('p')
					for (var i = 0; i < tags.length; i++) {
						if(tags[i].nextSibling.nodeName != 'UL'){
							if(tags[i].innerText.trim().substring(tags[i].innerText.trim().length - 1) == ':'){
								if (tags[i].innerText.trim() != 'Social Media:') {
									tags[i].innerHTML = '';
								}
							}
						}
					}

				}
				
			
				$('#rss-news').ready(function(){
					//https://news.google.com/news/feeds?pz=1&cf=all&ned=ENGLISH&hl=US&q=secret%20service&output=rss
		     		$("#rss-news").rss("<?php echo $news; ?>", {
						limit : 5,
						layoutTemplate : '<span id="entries">{entries}</span>',
						entryTemplate : '<a href="{url}" target="_blank">{title}</a></br></br>|'
					}).show();
				});	
			</script>
	</body>
</html>
