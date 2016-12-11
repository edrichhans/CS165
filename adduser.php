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
    if($_SESSION['rights'] == 'admin'){
    }
    else{
      header('location: index.php');
    }
    $user = $_SESSION['user'];
  ?>
  <body>
    <h3 class="ui dividing header">Add User</h2>
    <form class="ui form" action="adduser.php" method="POST">
      <div class="field">
        <label>Name</label>
        <input type="text" name="name" required="required/">
      </div>
      <div class="field">
        <div class="two fields">
          <div class="field">
            <label>e-mail</label>
            <input type="text" name="email" required="required"/>
          </div>
          <div class="field">
            <label>Phone</label>
            <input type="number" name="phone" required="required"/>
          </div>
        </div>
      </div>
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" required="required"/>
      </div>
      <div class="field">
        <label>Password</label>
        <input type="text" name="password" required="required"/>
      </div>
      <div class="field">
        <label>Retype-password</label>
        <input type="text" name="repassword" required="required"/>
      </div>
      <button class="ui submit primary button" type="submit">Create User</button>
    </form>
  </body>
</html>

<?php

$bool = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = mysql_real_escape_string($_POST['name']);
  $email = mysql_real_escape_string($_POST['email']);
  $phone = mysql_real_escape_string($_POST['phone']);
  $username = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);

  $bool = true;

  mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
  mysql_select_db("ticketing") or die("Cannot connect to database"); //connect to database
  $query = mysql_query("Select username from Users");
  while($row = mysql_fetch_array($query)){
    $table_users = $row['theatername'];
    if($name == $table_users){
      $bool = false;
      Print '<script>alert("Username has been taken!");</script>';
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
