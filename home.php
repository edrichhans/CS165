<html>
  <head>
    <title>My first PHP webbsite </title>
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
    <h2>Home Page</h2>
    <p> Hello <?php print "$user"?>!</p>
    <a href="logout.php">Click here to logout</a><br/><br/>
    <form action="add.php" method='POST'>
      Add more to list: <input type="text" name="details" /> <br/>
      Public post? <input type="checkbox" name="public[]" value="yes"/><br/>
      <input type="submit" value="Add to list"/>
    </form>
    <h2 align="center">My List</h2>
    <table border="1px" width="100%">
      <tr>
        <th>id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Public Post</th>
      </tr>
      <?php
        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("first_db") or die("Cannot connect to database");
        $query = mysql_query("SELECT * FROM list");
        while($row = mysql_fetch_array($query)){
          print "<tr>";
            print '<td align="center">'. $row['id']. '</td>';
            print '<td align="center">'. $row['details']. '</td>';
            print '<td align="center">'. $row['date_posted']. ' - '. $row['time_posted']. '</td>';
            print '<td align="center">'. $row['date_edited']. ' - '. $row['time_edited']. '</td>';
            print '<td align="center"><a href="edit.php?id='. $row['id']. '">edit</a></td>';
            print '<td align="center"><a href="delete.php?id='. $row['id']. '">delete</a></td>';
            print '<td align="center">'. $row['public']. '</td>';
          print "</tr>";
        }
      ?>
    </table>
  </body>
</html>
