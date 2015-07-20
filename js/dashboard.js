/**
 * @author Monish.Singh1
 */
var shadowBoxOpen = 0;
$('#datepicker').change(function() {
	 var date = $('input#datepicker').val();
	/* var find = '/';
	 var re = new RegExp (find, 'g');
	 var date1 = date.replace(re,'');
	 var id ='';
	 $('td.slots').each(function(){
	 id = $(this).attr('id');
	 id=id.substring(8);
	 id = date1.concat(id);
	 $(this).attr('id', id);
	 });
*/
var url = "http://localhost/collabRoomReserveSystem/?c=crr&m=getReservations&date="+date;
$('#dashboard_view').empty();
$('#dashboard_view').load(url);

});

$('td').click(function() {
	var slotid = $(this).attr('id'); 
	if(shadowBoxOpen == 0){
		if ($(this).attr('class') == 'slots'){
			var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reserveForm&resId=" + slotid;
			$('#shadowBox').css({'visibility':'visible','width':'840px','height':'600px'});
			$('#shadowFrame').css({'width':'800px','height':'600px'});
			$('#shadowBox').css('left','25%');
			$('iframe').attr('src',link);
			shadowBoxOpen = 1;
		}else{
			var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reservationDetails&resId=" + slotid;
			$('#shadowBox').css({'visibility':'visible','width':'540px','height':'350px'});
			$('#shadowFrame').css({'width':'500px','height':'350px'});
			$('#shadowBox').css('left','33%');
	    	$('iframe').attr('src',link);
	    	shadowBoxOpen = 1;
		}
	}else if(shadowBoxOpen == 1){
			$('#shadowBox').css('visibility','hidden');
			shadowBoxOpen = 0;
	}
	
});

$('#close').click(function(){
	$('#shadowBox').css('visibility','hidden');
	shadowBoxOpen = 0;
	location.reload();
});




