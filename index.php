<html>
  <head>
      <title>Chinese Dragon</title>
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
      header('location: dashboard.php');
    }
    else{
      header('location: login.php');
    }
    $user = $_SESSION['user'];
  ?>
  <body>
    <h1 class="ui header">Welcome to Movie ticket reservation!</h1>
    <a href="login.php"> Click here to login</a>
    <br/>
    <a href="register.php"> Click here to register </a>
  </body>
</html>
