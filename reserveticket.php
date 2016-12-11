<html>
  <head>
    <title>Reserve Ticket</title>
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
    <a href='/CS165'>Home</a>
    <br/>
    <form class="ui form" action="reserveticket.php" method="POST">
      <h4 class="ui dividing header">Reserve Ticket</h3>
      <label>Select Event</label>
      <div class="field">
        <select class="ui dropdown" name="eventname" id="eventname">
          <option value="">Select Event</option>
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
        <select class="ui dropdown show" name="show" id="show">
          <?php
            mysql_connect("localhost", "root", "") or die(mysql_error());
            mysql_select_db("ticketing") or die("Cannot connect to database");
            $query = mysql_query("SELECT showID, showDate, startTime, endTime FROM shows WHERE eventID =". $_GET['id']);
            while($row=mysql_fetch_array($query)){
              print "<option value='". $row['showID']. "'>". $row['showDate']. " ". $row['startTime']. "-". $row['endTime']. "</option>";
            }
           ?>
        </select>
      </div>
      <button class="ui button primary submit">Submit</button>
    </form>
    <script src="js/script.js"></script>
  </body>
</html>

<?php
  include 'ChromePhp.php';

  $bool = NULL;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $show = $_POST['show'];

    mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
    mysql_select_db("ticketing") or die("Cannot connect to database"); //connect to database

    $userID=$_SESSION['userID'];
    $ticketNoQuery = mysql_query("SELECT ticketNo from tickets where showID = '$show' and isReserved = 0 LIMIT 1");
    $ticketNoArr = mysql_fetch_array($ticketNoQuery);
    // ChromePhp::log($_SESSION);
    $ticketNo = $ticketNoArr['ticketNo'];
    $ticketNo = (int)$ticketNo;
    $user = $_SESSION['userID'];
    $user = (int)$user;
    mysql_query("UPDATE tickets SET isReserved = 1 WHERE ticketNo = '$ticketNo'");
    // ChromePhp::log((int)$ticketNo);
    // ChromePhp::log((int)$user);
    mysql_query("INSERT INTO reserved VALUES ('$ticketNo', '$user', now())");
    print '<script>alert("Successfully reserved ticket"); window.location.replace("/CS165/viewreservedtickets.php");</script>';
  }
?>
