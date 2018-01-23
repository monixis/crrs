/**
 * @author Monish.Singh1
 */
var shadowBoxOpen = 0;
//var test = 0;
// var baseUrl = "http://localhost/crrs/";
var baseUrl = "http://dev.library.marist.edu/crrs/";
$('#datepicker').change(function() {
	var date = $('input#datepicker').val();
	var slotId = localStorage.getItem("slotId");
	var c = document.getElementById("cat_drop");
	var category_type = c.options[c.selectedIndex].value;
	var p = document.getElementById("pat_drop");
	var patron_type = p.options[p.selectedIndex].value;
	var url = baseUrl.concat("?c=crr&m=getReservations&date="+date+"&slotId="+slotId+"&cat_type="+category_type+"&pat_type="+patron_type);//http://localhost:9090/crrs/?c=crr&m=getReservations&date="+date
	$('#dashboard_view').empty();
	$("#dashboard_view").html('<div id="searching" style="margin-top: 155px; text-align: center;"><img src="./icons/page-loader.gif" /><br/><p style="text-align: center;"></p></div>');
	console.log(url);
	setTimeout (function(){
		$('#dashboard_view').load(url);//http://localhost/crrs/?c=crr&m=todayReservation

		//$('#emplist').load(url);
		//breadcrumb();
		//$('#emplist').load("http://library.marist.edu/roadtoworkplace/?c=rtw&m=getrefinedemployers");
		// $('#breadcrumbs').empty().html('<p id="searchlimit">'+ url +'</p>');

	}, 1500);
	//$('#dashboard_view').load(url);

});
$('td').click(function() {
	var cat = $('#cat_drop').val();
	var pat = $('#pat_drop').val();
	var slotid = $(this).attr('id');
	var slotclass = $(this).attr('class');
	var selecteddate = new Date($('input#datepicker').val());
	Date.parse(selecteddate);
	var today = new Date();
	today.setHours(0, 0, 0, 0);
	Date.parse(today);
		if ($(this).parent().attr('class') == 'active'){
			if (slotclass != 'time'){
				if(shadowBoxOpen == 0){
					localStorage.setItem("slotId", slotid);
					if ($(this).attr('class') == 'slots'){
						if (today > selecteddate){
							var link = baseUrl.concat("?c=crr&m=displayInfo");//http://localhost:9090/crrs/?c=crr&m=displayInfo
						}else{
							var link = baseUrl.concat("?c=crr&m=verifyReservations&resId="+slotid+"&date="+selecteddate +"&pat="+ pat + "&cat=" + cat);//"http://localhost:9090/crrs/?c=crr&m=reserveForm&resId="+slotid;
						}
						$('#shadowBox').css({'visibility':'visible','width':'840px','height':'640px'});
						$('#shadowFrame').css({'width':'800px','height':'640px'});
						$('#shadowBox').css('left','25%');
						$('#shadowBox').css('top','15%');
						$('iframe').attr('src',link);
						shadowBoxOpen = 1;
					}else{
						if (today > selecteddate){
							var link =baseUrl.concat("?c=crr&m=readonlyReservationDetails&resId="+ slotid) ;

								//"http://localhost/crrs/?c=crr&m=readonlyReservationDetails&resId=" + slotid;
						}else{
							var link =baseUrl.concat("?c=crr&m=reservationDetails&resId="+ slotid);
						//	var link = "http://localhost/crrs/?c=crr&m=reservationDetails&resId=" + slotid;
						}

						$('#shadowBox').css({'visibility':'visible','width':'640px','height':'570px'});
						$('#shadowFrame').css({'width':'600px','height':'570px'});
						$('#shadowBox').css('left','28%');
						$('#shadowBox').css('top','15%');
	    				$('iframe').attr('src',link);
	    				shadowBoxOpen = 1;
					}
				}/*else if(shadowBoxOpen == 1){
					$('#shadowBox').css('visibility','hidden');
					shadowBoxOpen = 0;
					var date = $('input#datepicker').val();
					var slotId = localStorage.getItem("slotId");
					var tentative = localStorage.getItem("tentative");
					if(tentative == 1) {
						$.ajax({
							type: "GET",
							url: baseUrl.concat("?c=crr&m=updateTenativeSlots&slotId=" + slotId),
							data: $(this).serialize(),
							success: function (data) {

							}
						});
					}
					//var url = baseUrl.concat("?c=crr&m=updateTenativeSlots&time=" + timestamp + "&date=" + date + "&slotId=" + slotId);
					var url = baseUrl.concat("?c=crr&m=getReservations&date="+date);

					//"http://localhost/crrs/?c=crr&m=getReservations&date="+date;
					$('#dashboard_view').empty();
					$('#dashboard_view').load(url);
					$("#tfheader").load(baseUrl.concat("?c=crr&m=tfq"));

            //"http://localhost:9090/crrs/?c=crr&m=tfq"
				}*/
			}
		}
});

$('#search').click(function() {
	var searchText = $("#tfq").val();
	if(shadowBoxOpen == 0){
		var link =  baseUrl.concat("?c=crr&m=search&q="+ searchText);
			//"http://localhost:9090/crrs/?c=crr&m=search&q=" + searchText;
		$('#shadowBox').css({'visibility':'visible','width':'840px','height':'575px'});
		$('#shadowFrame').css({'width':'797px','height':'575px'});
		$('#shadowBox').css('left','25%');
		$('iframe').attr('src',link);
		shadowBoxOpen = 1;
	}
});
$('#tfq').keypress(function(e){
	var key = e.which;
	if(key == 13){
		var searchText = $("#tfq").val();
		if(shadowBoxOpen == 0){
			var link =  baseUrl.concat("?c=crr&m=search&q="+ searchText);
			$('#shadowBox').css({'visibility':'visible','width':'840px','height':'575px'});
			$('#shadowFrame').css({'width':'797px','height':'575px'});
			$('#shadowBox').css('left','25%');
			$('iframe').attr('src',link);
			shadowBoxOpen = 1;
		}

	}

});
$('#close').click(function() {
	$('#shadowBox').css('visibility','hidden');
	shadowBoxOpen = 0;
	var date = $('input#datepicker').val();
/*	var timestamp =localStorage.getItem("timestamp");
	$.ajax({url: baseUrl.concat("?c=crr&m=refreshReservations&time=" + timestamp + "&date=" + date),
		success: function (result) {
			//var res = $.json(result);
			var arr = $.map(result, function(el) { return el });

			alert(arr);
		}

	});*/

	/*
	var date = $('input#datepicker').val();
	var blocked = localStorage.getItem("tentative");
	if(blocked == 1) {

	}else{
		var timestamp =localStorage.getItem("timestamp");
		//alert(timestamp);
		var url = baseUrl.concat("?c=crr&m=getNewReservations&time="+timestamp+"&date="+date);

	}*/
});

$(document).on('click', 'th.roomno', function(){
	var roomNo = $(this).text();
	var link =baseUrl.concat("?c=crr&m=roomDetails&roomNo=" + roomNo);

		//"http://localhost/crrs/?c=crr&m=roomDetails&roomNo=" + roomNo;
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'440px'});
	$('#shadowFrame').css({'width':'600px','height':'440px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});

$('#notesSearch').click(function(){
	var searchText = $("#primEmail").val();
	var link = baseUrl.concat("?c=crr&m=search&q=" + searchText);
	//var link = "http://localhost:9090/crrs/?c=crr&m=search&q=" + searchText;
	window.open(link);
});

/*$('#refresh').click(function(){
	var date = $('input#datepicker').val();
	var url = "http://localhost/crrs/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
	$("#tfheader").load("http://localhost/crrs/?c=crr&m=tfq");
});*/


$('#print').click(function(){
	var date = $('input#datepicker').val();
	var url = baseUrl.concat("?c=crr&m=printTable&date="+date);
		//"http://localhost/crrs/?c=crr&m=printTable&date="+date;
	window.open(url);
	//window.print();
});

$('#addNotes').click(function(){
	var link = baseUrl.concat("?c=crr&m=addNotes");

		//"http://localhost/crrs/?c=crr&m=addNotes";
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'360px'});
	$('#shadowFrame').css({'width':'600px','height':'360px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});


$('#reports').click(function(){
	var link = baseUrl.concat("?c=crr&m=report");
		//"http://localhost/crrs/?c=crr&m=report";
    window.open(link);
});

jQuery(function($){
	$('#admin').click(function(){
	$("#admin-authentication").toggle();
	if($("#admin-authentication").is(":visible") == true){
		$("#hdresTable").css("margin-top", "93px");
	}else{
		$("#hdresTable").css("margin-top", "0px");
	};
		//$("#datepicker").datepicker( "option", "maxDate", "+1y" );
	});
 });
