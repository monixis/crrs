/**
 * @author Monish.Singh1
 */
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
	if ($(this).attr('class') == 'slots'){
		//alert('open slots');
		var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reserveForm&resId=" + slotid;
		$('#shadowBox').css({'visibility':'visible','width':'900px','height':'700px'});
		//$('#shadowBox').empty();
	$('#shadowBox').load(link);
	}else{
		var link = "http://localhost/collabRoomReserveSystem/?c=crr&m=reservationDetails&resId=" + slotid;
		$('#shadowBox').css({'visibility':'visible','width':'500px','height':'350px'});
		//$('#shadowBox').empty();
	$('#shadowBox').load(link);
	}
});

$('#close').click(function(){
	$('#shadowBox').css('visibility','hidden');
	alert("monish");
})
