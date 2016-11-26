<html>
  <head>
    <title>Mt first PHP website</title>
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
    <h2>Home Page</h2>
    <p>Hello<?php Print "$user"?>!</p>
    <a href="logout.php">Click here to Logout</a><br/><br/>
    <a href="home.php">Click here to return to home</a><br/><br/>
    <h2 align="center">Currently Selected</h2>
    <table border="1px" width="100%">
      <tr>
        <th>id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Public Post</th>
      </tr>
      <?php
        if(!empty($_GET['id'])){
          $id = $_GET['id'];
          $_SESSION['id'] = $id;
          $id_exists = true;
          mysql_connect("localhost", "root", "") or die(mysql_error());
          mysql_select_db("first_db") or die("Cannot connect to the database");
          $query = mysql_query("SELECT * FROM list WHERE id='$id'");
          $count = mysql_fetch_array(($query));
          if($count > 0){
            while($row = mysql_fetch_array($query)){
              print "<tr>";
                print '<td align="center">'. $row['id']. '</td>';
                print '<td align="center">'. $row['details']. '</td>';
                print '<td align="center">'. $row['date_posted']. '-'. $row['time_posted']. '</td>';
                print '<td align="center">'. $row['date_edited']. '-'. $row['time_posted']. '</td>';
                print '<td align="center">'. $row['public']. '</td>';
              print "</tr>";
            }
          }
          else{
            $id_exists = false;
          }
        }
      ?>
    </table>
    <br/>
    <?php
      if($id_exists){
        print '
        <form action="edit.php" method="POST">
          Enter new detail: <input type="text" name="details"/><br/>
          public post? <input type="checkbox" name="public[]" value="yes"/><br/>
          <input type="submit" value="Update List"/>
        </form>
        ';
      }
      else{
        print '<h2 align="center">There is no data to be edited</h2>';
      }
     ?>
   </body>
 </html>
