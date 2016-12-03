<?php
  session_start();
  $username = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  $bool = true;

  mysql_connect("localhost", "root", "") or die(mysql_error());
  mysql_select_db("ticketing") or die("Cannot connect to database");
  $query = mysql_query("SELECT * FROM user WHERE username = '$username'"); //query users table
  $exists = mysql_num_rows($query); //check if username exists
  $table_users = "";
  $table_password = "";
  if("$exists" > 0){
    while($row = mysql_fetch_assoc($query)){ //display all rows from query
      $table_users = $row['username']; //the first username row is passed on to $table_users and so on until the query is finished
      $table_password = $row['password'];
      $table_userID = $row['userID'];
    }
    if(($username == $table_users) && ($password == $table_password)){
      if($password == $table_password){
        $_SESSION['user'] = $username;
        $_SESSION['userID'] = $table_userID;
        header('location: dashboard.php');
      }
    }
    else{
      Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
      Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
  }
  else{
    Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
    Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
  }
?>
