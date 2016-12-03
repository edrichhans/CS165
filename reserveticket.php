<html>
  <head>
    <title>Create Event </title>
    <link rel="stylesheet" type="text/css" href="css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/transition.min.css">
    <link rel="stylesheet" type="text/css" href="css/popup.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/dropdown.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/calendar.min.css">
    <script src="js/jquery-3.1.1.min.js"</script>
    <script src="js/semantic.min.js"></script>
    <script src="js/transition.min.js"></script>
    <script src="js/popup.min.js"></script>
    <script src="js/calendar.min.js"></script>
    <script src="js/dropdown.min.js"></script>
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
    <form class="ui form" action="reserveticket.php" method="POST">
      <h4 class="ui dividing header">Reserve Ticket</h3>
      <label>Select Event</label>
      <div class="field">
        <select class="ui dropdown" name="eventname" id="eventname">
          <?php
            mysql_connect("localhost", "root", "") or die(mysql_error());
            mysql_select_db("ticketing") or die("Cannot connect to database");
            $query = mysql_query("SELECT * from event");
            while($row=mysql_fetch_array($query)){
              print "<option value='". $row['eventID']. "'>". $row['eventName']. "</option>";
            }
           ?>
        </select>
      </div>
      <label>Select Time</label>
      <div class="field">
        <select class="ui dropdown show" name="show" id="show" disabled>
          <?php
            mysql_connect("localhost", "root", "") or die(mysql_error());
            mysql_select_db("ticketing") or die("Cannot connect to database");
            $query = mysql_query("SELECT showDate, startTime, endTime FROM shows WHERE eventID =". $_GET[id]);
            while($row=mysql_fetch_array($query)){
              print "<>";
            }
           ?>
        </select>
      </div>
      <button class="ui button primary submit">Submit</button>
    </form>
    <script src="js/script.js"></script>
  </body>
</html>