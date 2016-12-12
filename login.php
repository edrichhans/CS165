<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/semantic.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.1.1.min.js"</script>
        <script src="js/semantic.min.js"></script>
    </head>
    <body>
      <?php
      session_start();
      if($_SESSION['user']){
        header('location: dashboard.php');
      }
       ?>
        <a href="register.php">Click here to Register </a>     
        <h2 class="ui dividing header">Login Page</h2>
        <form class="ui form" action="checklogin.php" method="POST">
          <div class="field">
            <label>Username</label>
            <input type="text" name="username" required="required" />
          </div>
          <div class="field">
            <label>Password</label>
            <input type="password" name="password" required="required" /> <br/>
          </div>
          <button class="ui button submit" type="submit" value="Login"> Login </button>
        </form>
    </body>
</html>
