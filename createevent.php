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
    <a href='/CS165'>Home</a>
    <br/>
    <form class="ui form" action="createevent.php" method="POST">
      <h4 class="ui dividing header">Event Details</h3>
      <label>Event name</label>
      <div class="field">
        <input type="text" name="name" />
      </div>
      <div class="field">
        <label>Synopsis</label>
        <textarea name="synopsis"></textarea>
      </div>
      <h4 class="ui dividing header">Time</h3>
      <div class="theaters">
        <div class="fields">
          <div class="eight wide field">
            <label>Theater</label>
            <select class="ui dropdown" name='theaters[]'>
              <option value="">Choose location</option>
              <?php
                mysql_connect("localhost", "root", "") or die(mysql_error());
                mysql_select_db("ticketing") or die("Cannot connect to database");
                $query = mysql_query("SELECT theaterID, theaterName FROM theater");
                while($row=mysql_fetch_array($query)){
                  print "<option value='". $row['theaterID']. "'>". $row['theaterName']. "</option>";
                }
               ?>
            </select>
          </div>
          <div class="four wide field">
            <label>Start Time</label>
            <div class="ui calendar startTime">
              <div class="ui left input icon">
                <i class="calendar icon"></i>
                <input type="text" name="start[]" />
              </div>
            </div>
          </div>
          <div class="four wide field">
            <label>End Time</label>
            <div class="ui calendar endTime">
              <div class="ui left input icon">
                <i class="calendar icon"></i>
                <input type="text" name="end[]" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <button id="addShow" class="ui button">Add Show</button>
      <button id="removeShow" class="ui button">Remove Show</button>
      <button class="ui button primary submit">Submit</button>
    </form>
    <script src="js/script.js"></script>
  </body>
</html>

<?php
  include 'ChromePhp.php';

  function datesOverlap($start_one,$end_one,$start_two,$end_two) {
    ChromePhp::log($start_one);
    ChromePhp::log($end_one);
    ChromePhp::log($start_two);
    ChromePhp::log($end_two);
    if (($start_one <= $end_two && $end_one >= $start_two) || ($start_two <= $end_one && $end_two >= $start_one)) { //If the dates overlap
      ChromePhp::log('overlap');
      return 1; //return how many days overlap
    }
    return 0; //Return 0 if there is no overlap
  }

  function checkExists($theaters, $startTimes, $endTimes){
    foreach($theaters as $index => $theaterID){
      $shows = mysql_query("SELECT * FROM shows WHERE theaterID = '$theaterID'");
      while($row = mysql_fetch_array($shows)){
        $combinedStartDateTime = $row['showDate']. ' '. $row['startTime'];
        $combinedEndDateTime = $row['showEndDate']. ' '. $row['endTime'];
        $startDateTime = strtotime($combinedStartDateTime);
        $endDateTime = strtotime($combinedEndDateTime);
        if(datesOverlap(strtotime($startTimes[$index]), strtotime($endTimes[$index]), $startDateTime, $endDateTime)){
          return 1;
        }
      }
    }
    return 0;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $theaters = $_POST['theaters'];
    $startTimes = $_POST['start'];
    $endTimes = $_POST['end'];
    $name = mysql_real_escape_string($_POST['name']);
    $synopsis = mysql_real_escape_string($_POST['synopsis']);

    mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
    mysql_select_db("ticketing") or die("Cannot connect to database"); //connect to database

    $bool = checkExists($theaters, $startTimes, $endTimes);

    ChromePhp::log($bool);

    if($bool){
      ChromePhp::log('pasok here');
      Print '<script>alert("timeslot taken!");</script>';
    }

    else{
      $userID=$_SESSION['userID'];
      mysql_query("INSERT INTO event (eventName, synopsis) VALUES ('$name', '$synopsis')");
      $eventID = mysql_fetch_array(mysql_query("SELECT eventID FROM event WHERE eventName = '$name'"))[0];
      mysql_query("INSERT INTO created(userID,eventID,dateCreated) VALUES ('$userID','$eventID',now())");


      foreach ($theaters as $index => $theaterID) {
        $startTime = date("H:i:s",strtotime($startTimes[$index]));
        $date = date("Y-m-d",strtotime($startTimes[$index]));
        $endDate = date("Y-m-d",strtotime($endTimes[$index]));
        $endTime = date("H:i:s",strtotime($endTimes[$index]));
        $seats = mysql_fetch_array(mysql_query("SELECT noOfSeats FROM theater WHERE theaterID='$theaterID'"))[0];
        $eventID = mysql_fetch_array(mysql_query("SELECT eventID FROM event WHERE eventName = '$name'"))[0];
        mysql_query("INSERT INTO shows (eventID, theaterID, showDate, startTime, showEndDate, endTime) VALUES ('$eventID', '$theaterID', '$date', '$startTime', '$endDate', '$endTime')");
        $showID = mysql_insert_id();
        $_SESSION['seats']=$seats;
        $_SESSION['theaterID'] = $theaterID;
        for ($x=0; $x<$seats; $x++){
          mysql_query("INSERT INTO tickets(showID) VALUES ('$showID')");
        }
      }
      Print '<script>alert("Successfully Created Event");</script>';
    }
  }
?>
