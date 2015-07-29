/**
 * @author Monish.Singh1
 */
var shadowBoxOpen = 0;
$('#datepicker').change(function() {
	 var date = $('input#datepicker').val();
	var url = "http://localhost/collabRoomReserveSystem/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
});

$('td').click(function() {
	var slotid = $(this).attr('id'); 
	if (slotid != "time"){
		if(shadowBoxOpen == 0){
			if ($(this).attr('class') == 'slots'){
				var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reserveForm&resId=" + slotid;
				$('#shadowBox').css({'visibility':'visible','width':'840px','height':'550px'});
				$('#shadowFrame').css({'width':'800px','height':'620px'});
				$('#shadowBox').css('left','25%');
				$('iframe').attr('src',link);
				shadowBoxOpen = 1;
			
		}else{
			var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reservationDetails&resId=" + slotid;
			$('#shadowBox').css({'visibility':'visible','width':'540px','height':'417px'});
			$('#shadowFrame').css({'width':'500px','height':'417px'});
			$('#shadowBox').css('left','33%');
	    	$('iframe').attr('src',link);
	    	shadowBoxOpen = 1;
		}
	}else if(shadowBoxOpen == 1){
			$('#shadowBox').css('visibility','hidden');
			shadowBoxOpen = 0;
	}
	}
	
});

$('.tfbutton2').click(function() {
	var searchBy = $("input:radio[name='searchBy']:checked").val();
	var searchText = $("#tfq").val();
	if(shadowBoxOpen == 0){
		var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=searchResults&searchBy=" + searchBy + "&q=" + searchText;
		$('#shadowBox').css({'visibility':'visible','width':'840px','height':'600px'});
		$('#shadowFrame').css({'width':'800px','height':'600px'});
		$('#shadowBox').css('left','25%');
		$('iframe').attr('src',link);
		shadowBoxOpen = 1;
	}
})

$('#close').click(function(){
	$('#shadowBox').css('visibility','hidden');
	shadowBoxOpen = 0;
	var date = $('input#datepicker').val();
	var url = "http://localhost/collabRoomReserveSystem/?c=crr&m=getReservations&date="+date;
	$('#dashboard_view').empty();
	$('#dashboard_view').load(url);
});
$('th.roomno').click(function(){
	var roomNo = $(this).text();
	var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=roomDetails&roomNo=" + roomNo;
	$('#shadowBox').css({'visibility':'visible','width':'540px','height':'350px'});
	$('#shadowFrame').css({'width':'500px','height':'350px'});
	$('#shadowBox').css('left','33%');
	$('iframe').attr('src',link);
	shadowBoxOpen = 1;
});



