<html>
  <head>
    <title>View Events</title>
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
  ?>
  <body>
    <h3 class="ui dividing header" align="center">Events</h2>
    </br>
    <table width="100%">
    <tr>
      <th>Name</th>
      <th>Actors</th>
      <th>Synopsis</th>
      </tr>
    <?php
        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("ticketing") or die("Cannot connect to database");
        $query = mysql_query("SELECT eventName,actors,synopsis FROM event");
        while($row = mysql_fetch_array($query)){
          print "<tr>";
            print '<td align="center">'. $row['eventName']."</td>";
            print '<td align="center">'. $row['actors']."</td>";
            print '<td align="center">'. $row['synopsis']."</td>";

          print "</tr>";
        }
    ?>
    </table>    
  </body>
</html>



