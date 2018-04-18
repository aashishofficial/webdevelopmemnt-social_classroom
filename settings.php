<?php
   require 'includes/common.php';
   if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
?>
<!DOCTYPE html>
<html>
     <head>
        <title>Settings</title>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="login.css" type="text/css"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        <div class="container">
            <div class="row row_style">
            <div>
                <center>
                    <h3>
                        <?php 
                        if (isset($_GET['wrongpw_error'])){
                            echo $_GET['wrongpw_error'];
                         } 
                        elseif (isset($_GET['pwchange_success'])){
                           echo $_GET['pwchange_success'];
                         }
                       ?>
                    </h3>
                </center>
            </div>
                <div class="col-md-4 col-md-offset-4">
                    <h3>Change Password</h3>
                    <form method="POST" action="settings_script.php">
                        <div class="form-group">
                            <input type="password" name="old_password" placeholder="Old Password" class="form-control" required="true" pattern=".{6,}">
                            <div><center><?php if (isset($_GET['change_error'])){
                                       echo $_GET['change_error'];
                                       }?></center></div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_password" placeholder="New Password" class="form-control" required="true" pattern=".{6,}">
                            <div><center><?php if (isset($_GET['password_error'])){
                                       echo $_GET['password_error'];
                                       }?></center></div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="renew_password" placeholder="Re-type New Password" class="form-control" required="true" pattern=".{6,}">
                            <div><center><?php if (isset($_GET['match_error'])){
                                       echo $_GET['match_error'];
                                       }?></center></div>
                        </div>
                        <button type="submit" name="changepassword" class="btn btn-primary btn-block">Change</button>
                    </form>
                </div>            
        </div>
        </div>
        <div  class='navbar-fixed-bottom'>
        <?php
        include 'includes/footer.php';
        ?>
    </div>
    </body>
</html>
