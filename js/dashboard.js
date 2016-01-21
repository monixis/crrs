/**
 * @author Monish.Singh1
 */
var shadowBoxOpen = 0;
$('#datepicker').change(function() {
	 var date = $('input#datepicker').val();
	var url = "http://localhost/crrs/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
});

$('td').click(function() {
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
					if ($(this).attr('class') == 'slots'){
						if (today > selecteddate){
							var link = "http://localhost/crrs/?c=crr&m=displayInfo";
						}else{
							var link = "http://localhost/crrs/?c=crr&m=reserveForm&resId=" + slotid;
						}
						$('#shadowBox').css({'visibility':'visible','width':'840px','height':'640px'});
						$('#shadowFrame').css({'width':'800px','height':'640px'});
						$('#shadowBox').css('left','25%');
						$('#shadowBox').css('top','15%');
						$('iframe').attr('src',link);
						shadowBoxOpen = 1;
					}else{
						if (today > selecteddate){
							var link = "http://localhost/crrs/?c=crr&m=readonlyReservationDetails&resId=" + slotid;
						}else{
							var link = "http://localhost/crrs/?c=crr&m=reservationDetails&resId=" + slotid;
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
					var url = "http://localhost/crrs/?c=crr&m=getReservations&date="+date;
					$('#dashboard_view').empty();
					$('#dashboard_view').load(url);
					$("#tfheader").load("http://localhost/crrs/?c=crr&m=tfq");
				}
			}
		}
});

$('#search').click(function() {
	var searchText = $("#tfq").val();
	if(shadowBoxOpen == 0){
		var link = "http://localhost/crrs/?c=crr&m=search&q=" + searchText;
		$('#shadowBox').css({'visibility':'visible','width':'840px','height':'575px'});
		$('#shadowFrame').css({'width':'797px','height':'575px'});
		$('#shadowBox').css('left','25%');
		$('iframe').attr('src',link);
		shadowBoxOpen = 1;
	}
})

$('#close').click(function(){
	$('#shadowBox').css('visibility','hidden');
	shadowBoxOpen = 0;
	var date = $('input#datepicker').val();
	var url = "http://localhost/crrs/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
	$("#tfheader").load("http://localhost/crrs/?c=crr&m=tfq");
});

$(document).on( "click", "th.roomno", function(){ 
	var roomNo = $(this).text();
	var link = "http://localhost/crrs/?c=crr&m=roomDetails&roomNo=" + roomNo;
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'440px'});
	$('#shadowFrame').css({'width':'600px','height':'440px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});
	
$('#notesSearch').click(function(){
	var searchText = $("#primEmail").val();
	var link = "http://localhost/crrs/?c=crr&m=search&q=" + searchText;
	window.open(link);
});

$('#refresh').click(function(){
	var date = $('input#datepicker').val();
	var url = "http://localhost/crrs/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
	$("#tfheader").load("http://localhost/crrs/?c=crr&m=tfq");
});


$('#print').click(function(){
	var date = $('input#datepicker').val();
	var url = "http://localhost/crrs/?c=crr&m=printTable&date="+date;
	window.open(url);
	//window.print();
});

$('#addNotes').click(function(){
	var link = "http://localhost/crrs/?c=crr&m=addNotes";
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'360px'});
	$('#shadowFrame').css({'width':'600px','height':'360px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});

$('#reports').click(function(){
	var link = "http://localhost/crrs/?c=crr&m=report";
    window.open(link);
});

