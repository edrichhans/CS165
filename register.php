<html>
  <head>
    <title>My first PHP Website</title>
    <link rel="stylesheet" href="css/semantic.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.1.1.min.js"</script>
    <script src="js/semantic.min.js"></script>
  </head>
  <body>
    <h3 class="ui dividing header">Registration Page</h2>
    <form class="ui form" action="register.php" method="POST">
      <div class="field">
        <label>Name</label>
        <div class="ui input focus">
          <input type="text" name="name" required="required" />
        </div>
      </div>
      <div class="field">
        <div class="two fields">
          <div class="field">
            <label>Email</label>
            <input type="text" name="email" required="required"/>
          </div>
          <div class="field">
            <label>Phone</label>
            <input type="number" name="phone" required="required"/>
          </div>
        </div>
      <div class="field">
        <label>Username:</label>
        <div class="ui input">
          <input type="text" name="username" required="required" />
        </div>
      </div>
      <div class="field">
        <label>Password:</label>
        <input type="password" name="password" required="required" />
      </div>
      <button class="ui button" type="submit" value="Register"> Register </button>
    </form>
  </body>
</html>

<?php

$bool = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  $name = mysql_real_escape_string($_POST['name']);
  $phone = $_POST['phone'];
  $email = mysql_real_escape_string($_POST['email']);

  $bool = true;

  mysql_connect("localhost", "root", "") or die(mysql_error()); //connect to server
  mysql_select_db("ticketing") or die("Cannot connect to database"); //connect to database
  $query = mysql_query("Select * from user");
  while($row = mysql_fetch_array($query)){
    $table_users = $row['username'];
    if($username == $table_users){
      $bool = false;
      Print '<script>alert("Username has been taken!");</script>';
      Print '<script>window.location.assign("register.php");</script>';
    }
  }
}

if($bool){
  mysql_query("INSERT INTO user (name, username, password, email, phone) VALUES ('$name', '$username', '$password', '$email', '$phone')");
  Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
  Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
}
?>
