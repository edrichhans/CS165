<html>
  <head>
    <title>View Shows</title>
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.1.1.min.js"</script>
    <script src="js/semantic.min.js"></script>
  </head>
  <?php
    session_start();
    if($_SESSION['user']){
    }
    else{
      header('location: index.php');
    }
    $user = $_SESSION['user'];
    $id_exists = false;
  ?>
  <body>
    <a href='/CS165'>Home</a>
    <br/>
    <h3 class="ui dividing header" align="center">Reserved Tickets</h2>
    </br>
    <table width="100%">
    <tr>
      <th width ="30%">Event</th>
      <th>Date</th>
      <th>Start</th>
      <th>End</th>
      <th>Cancel</th>
      </tr>

      <?php
        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("ticketing") or die("Cannot connect to database");
        $userID = $_SESSION['userID'];
        $query = mysql_query("SELECT r.ticketNo as ticketNo, eventName, showDate, startTime, endTime FROM reserved as r, tickets as t, shows as s, event as e WHERE t.ticketNo = r.ticketNo AND t.showID=s.showID AND s.eventID = e.eventID AND r.userID = '$userID'");
        while($row = mysql_fetch_array($query)){
            print "<tr>";
              print '<td align="center">'. $row['eventName']."</td>";
              print '<td align="center">'. $row['showDate']."</td>";
              print '<td align="center">'. $row['startTime']."</td>";
              print '<td align="center">'. $row['endTime']."</td>";
              print '<td align="center"><a href="cancel.php?id='.$row['ticketNo'].'">Cancel reservation</a></td>';
            print "</tr>";
          }
      ?>

<!--     <?php
        if(!empty($_GET['id'])){
          $eid=$_GET['id'];
          $_SESSION['chosenEID'] = $eid;
          $id_exists=true;
          mysql_connect("localhost", "root", "") or die(mysql_error());
          mysql_select_db("ticketing") or die("Cannot connect to database");
          $eventName=mysql_fetch_array(mysql_query("SELECT eventName FROM event WHERE eventID = '$eid'"))[0];
          print'<h3 class="ui dividing header" align="center">Shows for '.$eventName.'</h2>';
          print '</br>
          <table width="100%">
          <tr>
            <th>Theater</th>
            <th>Date</th>
            <th>Start</th>
            <th>End</th>
            <th>Available Seats</th>
          </tr>';
          $query = mysql_query("SELECT theaterName,showDate,startTime,endTime,COUNT(isReserved) as avSeats FROM shows,theater,tickets WHERE shows.showID=tickets.showID AND shows.theaterID=theater.theaterID AND eventID='$eid' AND isReserved=0 GROUP BY tickets.showID ");
          while($row = mysql_fetch_array($query)){
            print "<tr>";
              print '<td align="center">'. $row['theaterName']."</td>";
              print '<td align="center">'. $row['showDate']."</td>";
              print '<td align="center">'. $row['startTime']."</td>";
              print '<td align="center">'. $row['endTime']."</td>";
              print '<td align="center">'. $row['avSeats']."</td>";


            print "</tr>";
          }

        }
    ?> -->
    </table>
  </body>
</html>
