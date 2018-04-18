<?php
  require 'includes/common.php';
  if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
?>   
<!DOCTYPE html>
<html>
    <head>
        <title>MyProjects</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="#" />
    </head>
<body>
        <?php
            include 'includes/header.php';
        ?>
    <div class="container">
        <div class="row" style="margin-top:65px">
            <h3>Want to Start a Project?</h3>
            <br>
            <a href="start_project.php" class="btn btn btn-primary" >Start Project</a>
        </div>
    </div>
</body>
</html>
