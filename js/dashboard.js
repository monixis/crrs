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
	if ($(this).parent().attr('class') == 'active'){
		if (slotclass != 'time'){
			if(shadowBoxOpen == 0){
					if ($(this).attr('class') == 'slots'){
						var link = "http://localhost/crrs/?c=crr&m=reserveForm&resId=" + slotid;
						$('#shadowBox').css({'visibility':'visible','width':'840px','height':'575px'});
						$('#shadowFrame').css({'width':'800px','height':'575px'});
						$('#shadowBox').css('left','25%');
						$('iframe').attr('src',link);
						shadowBoxOpen = 1;
					}else{
						var link = "http://localhost/crrs/?c=crr&m=reservationDetails&resId=" + slotid;
						$('#shadowBox').css({'visibility':'visible','width':'640px','height':'575px'});
						$('#shadowFrame').css({'width':'600px','height':'575px'});
						$('#shadowBox').css('left','33%');
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
});

$( document ).on( "click", "th.roomno", function(){ 
	var roomNo = $(this).text();
	var link = "http://localhost/crrs/?c=crr&m=roomDetails&roomNo=" + roomNo;
	$('#shadowBox').css({'visibility':'visible','width':'640px','height':'440px'});
	$('#shadowFrame').css({'width':'600px','height':'440px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});
	
