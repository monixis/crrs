
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
		
		<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>
		<script type="text/javascript">	
		
			$(document).ready(function() {
			
				$('#refine, #emplist').hover(function() {
					$(this).css('overflow-y', 'auto');
				}, function() {
					$(this).css('overflow-y', 'hidden');
				});
				
				$('#majmore, #indmore').hide();
				
               $('#emplist').load('http://localhost/roadtoworkplace/?c=rtw&m=getemployers');
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

			<div class="empdetails">
				<div style="width: 12px; float:left;"><img src="./icons/beta.gif" /></div>			
				<div id="rtwoptions" style="margin-bottom: 5px;">
					

					<h1 style="color: #b31b1b; text-align: center;">JAC Collaboration Rooms Reservation System</h1>
					<!--div id="options"><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer?iframe=true&width=47%&height=55%"); ?>" rel="prettyphoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div-->
				<div id="options"><a href="<?php echo base_url(); ?>" title="Home" target="_self"><img class="mainoptions" src="./icons/home.png" /></a><a href="http://libguides.marist.edu/RoadtotheWorkplace" title="Road to the Workplace: Research Tools" target="_blank"><img class="mainoptions" src="./icons/libguides.png" /></a><a href="http://library.marist.edu/forms/ask.php" title="Ask-a-Librarian" target="_blank"><img class="mainoptions" src="./icons/contact.png" /></a><a href="<?php echo base_url("?c=rtw&m=disclaimer&iframe=true&width=47%&height=55%"); ?>" rel="prettyPhoto"><img class="mainoptions" src="./icons/disclaimer.png" /></a></div>
				
				</div>
				
				<div id="breadcrumbs">
					<p id="results"></p>
				</div>
				
				<div id="refine">
					
				<p style="font-size: 17px; color:#b31b1b; margin-top: 0px;">Limits</p>	
				
				
								
				<p class="emptype">Majors</p>
				<?php
					foreach ($majors as $row2) {
						$mid = $row2 -> mid;
						$major = $row2 -> major;
					?>
						<input class="majors" type="checkbox" name="<?php echo $major; ?>" id="<?php echo $mid; ?>">
							<?php echo $major; ?>
						</br>
						
				<?php } ?>				
				<div id="majmore">
				<?php
					foreach ($majors1 as $row4) {
						$moremid = $row4 -> mid;
						$moremajor = $row4 -> major;
					?>
						<input class="majors" type="checkbox" name="<?php echo $major; ?>" id="<?php echo $moremid; ?>">
							<?php echo $moremajor; ?>
						</br>
						
				<?php } ?>	
				</div>
				<a class="refinelist" id="maj-option" href="#" style="margin-left: 25px;">more</a>	
				
				<p class="emptype">Industry</p>
					<?php
					foreach ($industry as $row3) {
						$iid = $row3 -> iid;	
						$industry = $row3 -> industry;
					?>
						<input class="industry" type="checkbox" name="<?php echo $industry; ?>" id="<?php echo $iid; ?>">
							<?php echo $industry; ?>
						</br>
					<?php } ?>
				<div id="indmore">
				<?php
					foreach ($industry1 as $row5) {
						$moreiid = $row5 -> iid;
						$moreindustry = $row5 -> industry;
					?>
						<input class="industry" type="checkbox" name="<?php echo $moreindustry; ?>" id="<?php echo $moreiid; ?>">
							<?php echo $moreindustry; ?>
						</br>
						
				<?php } ?>	
				</div>
				<a class="refinelist" href="#" id="ind-option" style="margin-left: 25px;">more</a>				
				<!--p class="emptype">Size</p>		
					<ul>
					
					<li class="refiner"><a class="refinelist" href="#">Small</a></li>
					<li class="refiner"><a class="refinelist" href="#">Medium</a></li>
					<li class="refiner"><a class="refinelist" href="#">Large</a></li>
							
					
				</ul-->
				<p class="emptype">Employer Type</p>
				<input class="refiner" type="radio" name="emptype" value="0" checked="true">
							All
						</br>
				<?php
					foreach ($emptype as $row1) {
						$tid = $row1 -> tid;
						$type = $row1 -> type;
					?>
					<input class="refiner" type="radio" name="emptype" value="<?php echo $tid; ?>">
							<?php echo $type; ?>
						</br>
				<?php } ?>	
				</div>
				
				
				<div id="emplist">
				
					
				</div>
				<div id="search"><!--a class="btn" id="s" style="float:left">Apply</a--><a class="btn" id="c" style="float:left">Clear</a></div>
			</div>

			<div class="bottom">
				<p class = "foot">
					Marist College, 3399 North Road, Poughkeepsie, NY 12601; 845-575-3000
					<br />
					&#169; Copyright 2007-2014 Marist College. All Rights Reserved.

					<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> 
				</p>

			</div>
			<script type="text/javascript">
				var maj = "";
				var ind = "";
				var etype = 0;
				
				$("input.refiner").click(function(){
					etype = $(this).val();
					search();
				});
			
				$("input.majors").click(function() {
					if($(this).prop('checked') == true){
						
						if (maj.length == 0){
							
							maj = maj + $(this).attr("id");
						}else{
							
							maj = maj + "," + $(this).attr("id");
						}
						
												
					}else{
						
							
						if (maj.indexOf($(this).attr("id")) == 0){
							
							if (maj.length == 1 || maj.length == 2){
								
								maj = maj.replace($(this).attr("id"), '');
							} else {
								
								maj = maj.replace($(this).attr("id") + ",", '');
							} 
							
							
						
						}else {
							
							maj = maj.replace("," + $(this).attr("id"), '');
						
						}
					}
					search();
				});
				
				$("input.industry").click(function() {
					if($(this).prop('checked') == true){
								if (ind.length == 0){
							
										ind = ind + $(this).attr("id");
									}else{
							
										ind = ind + "," + $(this).attr("id");
									}
									
									
					}else{
							
							
							
							if (ind.indexOf($(this).attr("id")) == 0)
									{
										if (ind.length == 1 || ind.length == 2){
								
												ind = ind.replace($(this).attr("id"), '');
											} else {
								
												ind = ind.replace($(this).attr("id") + ",", '');
											} 
								
									}
									
									else 
									
									{
							
											ind = ind.replace("," + $(this).attr("id"), '');
									}
						}
						
					search();	
				});
		 	
				
				$("#maj-option").click(function(){
					$("#majmore").toggle(function(){
						if ($("#maj-option").text() == "more"){
							$("#maj-option").text("less");
						}else{
							$("#maj-option").text("more");
						}
					});
				});
				
				$("#ind-option").click(function(){
					$("#indmore").toggle(function(){
						if ($("#ind-option").text() == "more"){
							$("#ind-option").text("less");
						}else{
							$("#ind-option").text("more");
						}
					});
					
				});
				
				$("#c").click(function(){
										
					$('input[type=checkbox]').attr('checked', false);		
					ind="";
					maj="";
				$('#emplist').load('http://localhost/roadtoworkplace/?c=rtw&m=getemployers');
				document.getElementById('results').innerHTML = '';
				});
				
				
				function search(){
					var url;
					
					if (etype == 0){
						url = "<?php echo base_url("?c=rtw&m=getrefinedemployers"); ?>" + "&qry=emptype%20in%20(1,2,3,4)";
							
					}else{
						url = "<?php echo base_url("?c=rtw&m=getrefinedemployers"); ?>" + "&qry=emptype%20in%20(" + etype + ")"; 
					}
					
					
					if (maj.length > 0){
						url = url + "%20and%20mid%20in%20(" + maj + ")";
					}
					
					if (ind.length > 0){
						url = url  + "%20and%20iid%20in%20(" + ind + ")";
					}
					
					if (maj.length == 0 && ind.length == 0 && etype == 0) {
						url = "http://localhost/roadtoworkplace/?c=rtw&m=getemployers";
					};
				
				var librarytips = ["Marist Library subscribes to more than 200 databases that you can use for your research.", "Marist Library holds about 195,000 print books.", "Through Marist Library you can get access to 131,000 e-books and 75,000 e-Journals.", "Students may reserve one of the Library's fifteen Collaborative Rooms", "Stop by or make an appointment with our Librarians for a research consulation.", "Fox Hunt searches relevant scholarly and academic resources provided by the Libray."];
				//alert(url);
			
				tips = Math.floor((6) * Math.random());
					
				
				//$("#emplist").empty().html('<div style="position: relative; margin-left: 275px; border: 1px solid black;"><img src="./icons/loading.gif" /><br/><p style="text-align: center;">'+ librarytips[tips] +'</p></div>');	
				
				$("#emplist").empty();
				$("#emplist").html('<div id="searching" style="margin-top: 155px; text-align: center;"><img src="./icons/loading.gif" /><br/><p style="text-align: center;">'+ librarytips[tips] +'</p></div>');	
				
				console.log(url);
				setTimeout (function(){
				
				
					$('#emplist').load(url);
					breadcrumb();
						//$('#emplist').load("http://library.marist.edu/roadtoworkplace/?c=rtw&m=getrefinedemployers");
					// $('#breadcrumbs').empty().html('<p id="searchlimit">'+ url +'</p>');	
						
				}, 1500);
		
				}

				var majorToNum = new Array();
        		majorToNum[0] = {1: "Accounting", 2: "Biomedical Sciences", 3: "Business", 4: "Communications", 5: "Computer Science", 6: "Criminal Justice", 7: "Digital Media", 8: "Economics", 9: "Education", 10: "Environmental Science", 11: "Fashion", 12: "Information Technology and Systems", 13: "Liberal Arts", 14: "Mathematics", 15: "Medical Technology", 16: "Natural Science", 17: "Psychology", 18: "Social Work"};

        		var indusToNum = new Array();
        		indusToNum[0] = {1: "Accounting, Tax Preparation, Bookkeeping, and Payroll", 2: "Advertising, Public Relations and Related Services", 3: "Agriculture, Food, Nutrition", 4: "Arts, Culture, and Humanities", 5: "Alliance/Advocacy Organizations", 6: "Animal Protection and Welfare", 7: "Broadcasting (Television and Radio)", 8: "Children and Youth Services", 9: "Computer Systems Design", 10: "Disease, Disorders, Medical Disciplines", 11: "Educational Services and Schools", 12: "Employement Procurement Assistance and Job Training", 13: "Financial Institutions (banks and credit unions)", 14: "Financial Services (financial advice and planning)", 15: "Health Support Services", 16: "Human Services", 17: "Insurance", 18: "International, Foreign Affairs, and National Security", 19: "Law Enforcement", 20: "Legal Services", 21: "Management of Companies and Enterprises", 22: "Mental Health, Crisis Intervention", 23: "Museums & Museum Activities", 24: "Real Estate", 25: "Rental and Leasing Services", 26: "Retail and Wholesale--Clothing and Clothing Accessories", 27: "Retail and Wholesale--Furnishings and Home Furnishings", 28: "Retail and Wholesale--General Merchandise", 29: "Retail and Wholesale--Health and Personal Care", 30: "Scientific Research and Development Services", 31: "Telecommunications", 32: 'Utilities'};

        		var empToNum = new Array();
        		empToNum[0] = {1: 'Non-Profit Organization', 2: 'Government Agency', 3: 'Company - Public', 4: 'Company - Private', 5: 'Company - Subsidiary', 6: 'Company - Holding Company'};
				
				function breadcrumb(){
					setTimeout(function(){
						// debugger;
						if (document.getElementById('list').childElementCount == 1) {
							document.getElementById('results').innerHTML = document.getElementById('list').childElementCount + ' result for '
						}
						else{
							document.getElementById('results').innerHTML = document.getElementById('list').childElementCount + ' results for '	
						}

						var a = maj.split(',');
						var b = ind.split(',');

						//Employer Type Breadcumb
						var emps = document.getElementsByClassName('refiner');
						for (var i = 0; i < emps.length; i++) {
							if(emps[i].checked && emps[i].value != 0){
								document.getElementById('results').innerHTML += "<b>Employer Type:</b> " + emps[i].nextSibling.data.trim() + ' -- ';
								break;
							}
						}

						// Major Breadcrumb
						if(a[0] != ''){
							var line = '';
							document.getElementById('results').innerHTML += '<b>Major:</b> ';
							for (var i = 0; i < a.length; i++) {
								line += majorToNum[0].getKey(a[i]) + ' -- ';
							}
							document.getElementById('results').innerHTML += line;
						}
						else if(a[0] = '' && document.getElementById('results').innerHTML != ''){
							document.getElementById('results').innerHTML.replace(line, '');
						}

						//Industry Breadcrumb
						if(b[0] != ''){
							var line = '';
							document.getElementById('results').innerHTML += '<b>Industry:</b> ';
							for (var i = 0; i < b.length; i++) {
								line += indusToNum[0].getKey(b[i]) + ' -- ';
							}
							document.getElementById('results').innerHTML += line;
						}
						else if(b[0] = '' && document.getElementById('results').innerHTML != ''){
							document.getElementById('results').innerHTML.replace(line, '');
						}
						if(document.getElementById('results').innerHTML == '76 results for '){
							document.getElementById('results').innerHTML = ''
						}
					}, 250);
				}

				Object.prototype.getKey = function (value){
					// debugger;
          			for (var key in this){ 
            			if (key === value){
              				return this[key];
            			}
          			} 
          			return null;
        		};
				
			</script>
			
			
	</body>
</html>
