<?php
//create admin account when not exist
  require 'model/Dbh.php';
  require 'includes/createAdmin.inc.php';

  $admin = new CreateAdmin();

  $admin->makeAccountAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" type="text/css" href="css/glyphicons.css"/>
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/app.css"/>
      <link rel="icon" href="images/logo.png"/>
</head>
<body>
<div class="bg_cover">
  <form action="includes/login.inc.php" method="post">
    <div class="login">
      <div class="login-header">
        <img src="images/logo.png" alt="logo" class="fav_logo">
        <p class="text-banner">ePay-AENHS</p>
          <?php
            if(isset($_GET['login'])){
              if($_GET['login'] !== ""){
                if($_GET['login'] === "success"){
                  echo '
                  <img src="gifs/rot.gif" class="rot"/><b class="text-success">Logging you in...</b>
                    <script>
                      setInterval(function() {
                        window.location="controllers/dashboard.php";
                      }, 2000);
                    </script>
                  ';
                } else {
                  echo '<b class="text-danger">User not found!</b>';
                }
              }
            }
          ?>
        
      </div>
      <div class="login-body">
          <br/>
        <input type="text" name="email" class="form-control" placeholder="Enter email" required ><br/>
        <input type="password" name="pwd" class="form-control" placeholder="Your password" required ><br/>
        
      </div>
      <div class="login-footer d-grid">
        <input type="submit" name="btn_login" class="btn btn-outline-success btn-block" value="LOG IN">
      </div>
    </div>
  </form>
</div>
</body>
</html>