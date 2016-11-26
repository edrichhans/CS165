<html>
  <head>
    <title>Theater</title>
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
    <h3 class="ui dividing header">Add Theater</h2>
    <form class="ui form" action="addtheater.php" method="POST">
      <div class="field">
        <label>Name</label>
        <input type="text" name="name" required="required/">
      </div>
      <div class="field">
        <div class="two fields">
          <div class="field">
            <label>Address</label>
            <input type="text" name="location" required="required"/>
          </div>
          <div class="field">
            <label>Capacity</label>
            <input type="number" name="capacity" required="required"/>
          </div>
        </div>
      </div>
      <button class="ui submit primary button" type="submit">Create Theater</button>
    </form>
  </body>
</html>

<?php

$bool = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = mysql_real_escape_string($_POST['name']);
  $location = mysql_real_escape_string($_POST['location']);
  $capacity = $_POST['capacity'];

  $bool = true;

  mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
  mysql_select_db("ticketing") or die("Cannot connect to database"); //connect to database
  $query = mysql_query("Select * from theater");
  while($row = mysql_fetch_array($query)){
    $table_users = $row['theatername'];
    if(name == $table_users){
      $bool = false;
      Print '<script>alert("Theater name has been taken!");</script>';
      // Print '<script>window.location.assign("addtheater.php");</script>';
    }
  }
}

if($bool){
  mysql_query("INSERT INTO theater (theatername, noOfSeats, location) VALUES ('$name', '$capacity', '$location')");
  Print '<script>alert("Successfully Created Theater!");</script>'; // Prompts the user
  Print '<script>window.location.assign("addtheater.php");</script>'; // redirects to register.php
}
?>
