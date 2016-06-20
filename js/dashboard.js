/**
 * @author Monish.Singh1
 */

var shadowBoxOpen = 0;
var baseUrl = "http://localhost/crrs/";
$('#datepicker').change(function() {
	 var date = $('input#datepicker').val();
	var url = baseUrl.concat("?c=crr&m=getReservations&date="+date);//http://localhost:9090/crrs/?c=crr&m=getReservations&date="+date
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);

});
$('td').click(function() {
	var slotid = $(this).attr('id');
	localStorage.setItem("slotId", slotid);
	var slotclass = $(this).attr('class');
	var selecteddate = new Date($('input#datepicker').val());
	Date.parse(selecteddate);
	var today = new Date();
	today.setHours(0, 0, 0, 0);
	Date.parse(today);
		if ($(this).parent().attr('class') == 'active'){
			if (slotclass != 'time'){
				if(shadowBoxOpen == 0){
					if ($(this).attr('class') == 'slots'){
						if (today > selecteddate){
							var link = baseUrl.concat("?c=crr&m=displayInfo");//http://localhost:9090/crrs/?c=crr&m=displayInfo
						}else{
							var link = baseUrl.concat("?c=crr&m=verifyReservations&resId="+slotid);//"http://localhost:9090/crrs/?c=crr&m=reserveForm&resId="+slotid;
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

								//"http://localhost:9090/crrs/?c=crr&m=readonlyReservationDetails&resId=" + slotid;
						}else{
							var link =baseUrl.concat("?c=crr&m=reservationDetails&resId="+ slotid);
						//	var link = "http://localhost:9090/crrs/?c=crr&m=reservationDetails&resId=" + slotid;
						}	
						
						$('#shadowBox').css({'visibility':'visible','width':'640px','height':'570px'});
						$('#shadowFrame').css({'width':'600px','height':'570px'});
						$('#shadowBox').css('left','28%');
						$('#shadowBox').css('top','15%');
	    				$('iframe').attr('src',link);
	    				shadowBoxOpen = 1;
					}
				}else if(shadowBoxOpen == 1){
					$('#shadowBox').css('visibility','hidden');
					shadowBoxOpen = 0;
					var date = $('input#datepicker').val();
					var url = baseUrl.concat("?c=crr&m=getReservations&date="+date);
						//"http://localhost:9090/crrs/?c=crr&m=getReservations&date="+date;
					//$('#dashboard_view').empty();
					$('#dashboard_view').load(url);
					$("#tfheader").load(baseUrl.concat("?c=crr&m=tfq"));//"http://localhost:9090/crrs/?c=crr&m=tfq"
				}
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
})
$('#close').click(function() {
	$('#shadowBox').css('visibility','hidden');
	shadowBoxOpen = 0;
	/*var timestamp =localStorage.getItem("timestamp");
	var date = $('input#datepicker').val();

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

		//"http://localhost:9090/crrs/?c=crr&m=roomDetails&roomNo=" + roomNo;
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



$('#print').click(function(){
	var date = $('input#datepicker').val();
	var url = baseUrl.concat("?c=crr&m=printTable&date="+date);
		//"http://localhost:9090/crrs/?c=crr&m=printTable&date="+date;
	window.open(url);
	//window.print();
});

$('#addNotes').click(function(){
	var link = baseUrl.concat("?c=crr&m=addNotes");

		//"http://localhost:9090/crrs/?c=crr&m=addNotes";
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'360px'});
	$('#shadowFrame').css({'width':'600px','height':'360px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});
$('#reports').click(function(){
	var link = baseUrl.concat("?c=crr&m=report");

		//"http://localhost:9090/crrs/?c=crr&m=report";
    window.open(link);
});

