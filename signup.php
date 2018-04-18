<?php
require 'includes/common.php';
if (isset($_SESSION['email']))
{
    header('location:myprofile.php');
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Sign Up</title><link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="signup.css" type="text/css"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include 'includes/header.php';
        ?>
        <div class="container">
        <div class="row row_style">
            <div class="col-md-4 col-md-offset-4">
                <h3>SIGN UP</h3>
                <form method="POST" action="signup_script.php">
                    <div class="form-group">
                        <input class="form-control" placeholder="First Name" name="first_name" required="true" pattern="[a-zA-Z]+"> 
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Last Name" name="last_name" required="true" pattern="[a-zA-Z]+"> 
                    </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            <div><?php 
                            if (isset($_GET['email_error'])){
                                       echo $_GET['email_error'];
                                    }
                            if (isset($_GET['emailexist_error'])){
                                       echo $_GET['emailexist_error'];
                                    }?></div>
                        </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="true" pattern=".{6,}">
                        <div><?php if (isset($_GET['password_error'])){
                                        echo $_GET['password_error'];
                                    }?></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="contact" placeholder="Contact" required="true">
                    </div>
                    <div class="form-group">
                        <input  class="form-control" name="branch" placeholder="Branch" required="true">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        </div>
        <div class='navbar-fixed-bottom'>
        <?php
         include 'includes/footer.php';
        ?>
        </div>
    </body>
</html>