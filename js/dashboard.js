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
	alert($(this).attr('id'));
})