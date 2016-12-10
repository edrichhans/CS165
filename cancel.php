<?php
 	if(!empty($_GET['id'])){
      	$tid=$_GET['id'];
     	$id_exists=true;
		mysql_connect("localhost", "root", "") or die(mysql_error());
    	mysql_select_db("ticketing") or die("Cannot connect to database");
    	$query = mysql_query("DELETE FROM reserved WHERE ticketNo = '$tid'");
    	$query2 = mysql_query("UPDATE tickets set isReserved=0 WHERE ticketNo ='$tid'");
      	header('location: viewreservedtickets.php');

	}
?>