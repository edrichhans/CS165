<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    mysql_connect("localhost", "root", "") or die(mysql_error());
    mysql_select_db("ticketing") or die("Cannot connect to database");
    $query = mysql_query("SELECT theaterID, theaterName FROM theater");
    while($row=mysql_fetch_array($query)){
      print "<option value='". $row['theaterID']. "'>". $row['theaterName']. "</option>";
    }
  }
?>
