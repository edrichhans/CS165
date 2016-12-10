$('#addShow').click(function(){
  event.preventDefault();
  $('.theaters').append("<div class=\"fields\"><div class=\"eight wide field\"><label>Theater</label><select class=\"ui dropdown notdone\" name=\"theaters[]\"><option value=\"\">Choose location</option></select></div><div class=\"four wide field\"><label>Start Time</label><div class=\"ui calendar startTime\"><div class=\"ui left input icon\"><i class=\"calendar icon\"></i><input type=\"text\" name=\"start[]\" /></div></div></div><div class=\"four wide field\"><label>End Time</label><div class=\"ui calendar endTime\"><div class=\"ui left input icon\"><i class=\"calendar icon\"></i><input type=\"text\" name=\"end[]\" /></div></div></div></div>");
  // $('.ui.dropdown.notdone').append("<?php mysql_connect(\"localhost\", \"root\", \"\") or die(mysql_error());mysql_select_db(\"ticketing\") or die(\"Cannot connect to database\");$query = mysql_query(\"SELECT theaterID, theaterName FROM theater\");while($row=mysql_fetch_array($query)){print \"<option value='\". $row['theaterID']. \"'>\". $row['theaterName']. \"</option>\";} ?>");
  $.get('gettheaters.php').done(function(data){
    $('.ui.dropdown.notdone select').append(data);
    $('.ui.dropdown.notdone').removeClass("notdone");
  });
  $('.dropdown').dropdown();
  $('.startTime:last').calendar({endCalendar: $('.endTime:last')});
  $('.endTime:last').calendar({startCalendar: $('.startTime:last')});
});

$('#removeShow').click(function(){
  event.preventDefault();
  $('.theaters').children().last().remove();
});

$('#eventname').change(function(){
  $('#show').prop("disabled", false);
  // $.post('getshows.php', {data: $('#eventname').val()});
});

$(document).ready(function(){
  $('.dropdown').dropdown();
  $('.startTime').calendar({endCalendar: $('.endTime')});
  $('.endTime').calendar({startCalendar: $('.startTime')});
});

$('#eventname').change(function (){
  var url = window.location.pathname;
  url += '?id=' + parseInt($(this).val());
  window.location.href = url;
});
