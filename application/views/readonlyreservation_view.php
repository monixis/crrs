<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 

<?php 
	$resId =$resId;
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
			$("#color").addClass("transactionComplete");
 		}
		if(<?php echo $notValid ?> == 1){
			$("#valid").attr("hidden","true");
			$("#color").addClass("slots");
			$("#invalid").removeAttr("hidden");
		}
	});
</script>
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 570px; float:left; ">
		</div>
		
		<div style="float:right; width:530px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">
			<div id="confirmations"></div><p id="resId">#<?php echo $rId ; ?> - Readonly<a href><!--img src="./icons/edit.svg" class="shortcutlink" style="width:20px; height:20px; margin-left:5px;"/--></a></p>
		</div>
		
	</div>
	<div id="invalid" hidden>
		<center><p> The resevation ID #<?php echo $searchText; ?> is invalid.</p></center>
	</div>
	<div id="valid">
	<p class="resDet"><label class="label">Room No: </label><?php echo $roomNum; ?></p>
	<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
	<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?><label class="label" style="margin-left: 70px;">Total Hours:</label><?php echo $totalHours; ?></p>
	<p class="resDet"><label class="label">Reserved By:</label><?php echo $resEmail; ?></p>
	<p class="resDet"><label class="label">Secondary Patron:</label><?php echo $secEmail; ?></p>
	<p class="resDet"><label class="label">Phone No:</label><?php echo $resPhone; ?></p>
	<p class="resDet"><label class="label">Status:</label><?php echo $status; ?><label class="label" style="margin-left: 55px;">No. of Patrons:</label><?php echo $numPatrons; ?></p>
	<p class="resDet"><label class="label">Comments:</label><textarea readonly rows="3" cols="50" style="margin-left:60px; margin-bottom:5px;"><?php echo $comments; ?></textarea></p>
	</div>
</div>
