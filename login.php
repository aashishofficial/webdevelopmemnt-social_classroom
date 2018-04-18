<?php
require 'includes/common.php';
if (isset($_SESSION['email'])){
    header ('location:myprofile.php');
}
?>
<html>
    <head>
        <title>Login</title>
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
                <div class="col-md-10 col-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <p class="text-warning">Login to join your friends</p>
                        <div class="row">
                            <div class="col-md-5">
                                <form method="POST" action="login_submit.php">
                                <div class="form-group">
                                    <label for="e-mail">Email</label>
                                    <input type="email" class="form-control" placeholder="" name="email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                    <div><?php if (isset($_GET['email_error'])){
                                       echo $_GET['email_error'];
                                    }?></div>
                                </div>
                                <div class="form-group">
                                    <label for="pass-word">Password</label>
                                    <input type="password" class="form-control" name="password" required="true" pattern=".{6,}">
                                    <div><?php if (isset($_GET['password_error'])){
                                        echo $_GET['password_error'];
                                    }?></div>
                                </div>
                                <button type="submit" name="Submit" class="btn btn-primary">Submit</button>    
                             </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">Don't have an account?<a href="signup.php"> Register</a></div>
                </div>
            </div>
            </div>
        </div>
        <?php
        include 'includes/footer.php';
        ?>
    </body>
</html>
