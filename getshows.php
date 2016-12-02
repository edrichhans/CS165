<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    mysql_connect("localhost", "root", "") or die(mysql_error());
    mysql_select_db("ticketing") or die("Cannot connect to database");
    $query = mysql_query("SELECT theaterID, showDate, startTime, endTime FROM show WHERE eventID = ". $_POST["data"]);
    while($row=mysql_fetch_array($query)){
      $theaterName = mysql_query("SELECT theaterName FROM show WHERE theaterID = ". $row["theaterID"]);
      $name = mysql_fetch_array($theaterName["theaterName"]);
      print "<option value=\"". $row["theaterID"]. "\">". $name["theaterName"]. "</option>";
    }
  }
?>
