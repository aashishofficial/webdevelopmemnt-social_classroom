<?php
require 'includes/common.php';
?>
<!DOCTYPE html>
<html>
     <head>
        <title>Notifications</title>
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
            $receiver=$_SESSION['id'];
            $select_query="select * from user where user_id in (select sender from friends where receiver='$receiver' and status='pending')";
            $result=mysqli_query($con,$select_query) or die(mysqli_error($con));
        ?>    
        <div class="container">
            <div class="row" style="margin-top:70px ">
                <div class="col-lg-6">
                    <b><ul><h1 style='text-align: right'>Notifications</h1></ul></b>
                    <br>
                    <?php
                        foreach ($result as $row){
                    ?>
                        <li>
                    <a href=""><?php
                            echo $row['first_name']." ".$row['last_name']." wants to be your friend.";?></a>
                        </li>    
                        <?php
                            }
                        ?>
                       
                </div>
            </div>    
        </div>
    </body>
</html>
