<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script> 		
<script type="text/javascript" src="./js/dashboard.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<script type="text/javascript">

$(function(){
$("#testTimeline").timeline({
data:   [
<?php 
	foreach($details as $row){
		$resId = $row -> resId;
		$resDate = $row -> resDate;
		$startTime = $row -> startTime;
		$resEmail = $row -> resEmail;
		$resType = $row -> resType;
		$roomNum = $row -> roomNum;
		$status = $row -> status;
		$statusId = $row -> statusId;

echo ("{date: new Date(" . substr($resId,4,4) . "," . substr($resId,0,2) . "," . substr($resId, 2, 2) . "), type: 'someType', title: 'Reservation', description: 'reservation id: " . $resId . " </br> Reservation Time: " . $startTime . "</br> Reservered By: " . $resEmail . "</br> Status: " . $status ."'},");
} ?>
],
height: 600
});
});

$.widget('pi.timeline', {
	options: {
		data:   [
		{date: new Date(), type:"Type1", title:"Title1", description:"Description1"},
		{date: new Date(), type:"Type2", title:"Title2", description:"Description2"}
		],
		types:  [
		{name:"Type1", color:"#00ff00"},
		{name:"Type2", color:"#0000ff"}
		],
		display: "auto",
		height: 600
	},
	_create: function(){
		this._refresh();
	},
	_refresh: function(){
		var miliConstant = 86400000
		var firstDate = this.options.data[0].date;
		var lastDate = this.options.data[0].date;
		for (i=0;i<this.options.data.length;i++) {
			if (this.options.data[i].date > lastDate) { lastDate = this.options.data[i].date; }
			else if (this.options.data[i].date < firstDate) { firstDate = this.options.data[i].date; }
		}
		var dayRange = (lastDate - firstDate) / miliConstant;
		var segSpace = Math.floor(this.options.height / (dayRange / 7));
		var segLength = 7;
		if (segSpace < 80) {
			var segSpace = Math.floor(this.options.height / (dayRange / 14));
			segLength = 14;
		}
		if (segSpace < 80) {
			var segSpace = Math.floor(this.options.height / (dayRange / 28));
			segLength = 28;
		}
		if (segSpace < 80) {
			var segSpace = Math.floor(this.options.height / (dayRange / 56));
			segLength = 56;
		}
		if (segSpace < 80) {
			var segSpace = Math.floor(this.options.height / (dayRange / 112));
			segLength = 112;
		}

		var majorCount = Math.floor(this.options.height / segSpace) + 1;

		//Empty Current Element
		this.element.empty();

		//Draw TimeLine
		this.element.append("<div class='tlLine' style='height: " + this.options.height + "px;'></div>")

		//Draw Major Markers
		var tempDate = new Date(firstDate.getTime());
		for (i=0;i<majorCount;i++) {
			this.element.append("<div class='tlMajor' style='top: " + ((segSpace * i) - 7) + "px;'></div>");
			this.element.append("<span class='tlDateLabel' style='top: " + ((segSpace * i) - 7) + "px;'>" +  $.datepicker.formatDate( "d M y", tempDate) + "</span>");
			tempDate.setDate(tempDate.getDate() + segLength);
		}

		//draw event markers
		for (i=0;i<this.options.data.length;i++) {
			var dayPixels = ((this.options.data[i].date - firstDate) / (lastDate - firstDate)) * this.options.height;
			//alert((this.options.data[i].date - firstDate) + ", " + (lastDate - firstDate) + ", " +dayPixels);
			this.element.append("<div class='tlDateDot' style='top: " + (dayPixels - 11) + "px;'></div>");
			this.element.append("<div class='tlEventFlag' style='top: " + (dayPixels - 11) + "px;'>" + this.options.data[i].title + "</div>");
			this.element.append("<div class='tlEventExpand' style='top: " + (dayPixels - 11) + "px;'><p><b>" + this.options.data[i].date + "</b></p><p>" + this.options.data[i].description +  "<p></div>");
		}

		$(".tlEventExpand").hide();

		//$(".tlEventExpand").hide();
		$(".tlEventFlag").click(function(){
		var tempThis = $(this);
		$(".tlEventExpand").hide();
		$(".tlEventFlag").animate({width:'100px'}, 200);
		if (tempThis.hasClass('active')) {
			tempThis.removeClass('active');
		} else {
			$(".tlEventFlag").removeClass('active');
			tempThis.addClass('active');
			tempThis.animate({width:'120px'}, 200, function(){
				tempThis.next('div').show();
			});
		}
		});
	},
	_destroy: function() {},
	_setOptions: function() {}
});

</script>
<style>
.drawing {
 padding: 0px;
 margin: 0px;
}

#testTimeline {
 margin: 20px;
 position: relative;
}

.tlMajor {
 left: 80px;
 position: absolute;
 width: 10px;
 height: 10px;
 background-color: #888;
 border: 2px solid #eee;
}

.tlDateLabel {
 position: absolute;
 font-size: 12px;
 color: #888;
 text-align: right;
 font-style: italic;
 left: 0px;
 width: 70px;
}

.tlLine {
 position: absolute;
 width: 2px;
 background-color: #888;
 top: 0px;
 left: 85px;
 border: 1px solid #aaa;
}

.tlDateDot {
 left: 95px;
 position: absolute;
 width: 0;
 height: 0;
 border-top: 11px solid transparent;
 border-bottom: 11px solid transparent;
 border-right: 11px solid #5cac73;
}

.tlEventFlag {
 left: 106px;
 position: absolute;
 width: 100px;
 height: 14px;
 background-color: #5cac73;
 font-size: 12px;
 padding: 4px 0px 4px 5px;
 color: #fff;
 cursor: pointer;
}

.tlEventExpand {
 left: 230px;
 position: absolute;
 width: 200px;
 background-color: #5cac73;
 font-size: 12px;
 padding: 0 10px 0 10px;
 color: #fff;
}
</style>

<h1 style="width:440px; height: 38px; text-align: center; font-size: 30px; color: #b31b1b;">Room <?php echo $searchText; ?> Reservations</h1>
	

<title>Room <?php echo $searchText; ?></title>	
<div style="position: relative; top:50px;" id="testTimeline"> </div>
<!--
<div id="details">
	<div id="detailsType">
		<div id="color" style="width: 60px; height: 350px; float:left; ">
		</div>
	</div>

	<p class="resDet"><label class="label">Reservation ID: </label><?php echo $resId; ?></p>
	<p class="resDet"><label class="label">Date: </label><?php echo $resDate; ?></p>
	<p class="resDet"><label class="label">Time:</label><?php echo $startTime; ?></p>
	<p class="resDet"><label class="label">Reserved By:</label><?php echo $resEmail; ?></p>
	<p class="resDet"><label class="label">Status:</label><?php echo $status; ?></p>
</div>
-->
