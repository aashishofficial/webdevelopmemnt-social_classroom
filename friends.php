<?php
  require 'includes/common.php';
  if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
  $user_id=$_SESSION['id'];
  $select_query2="select * from user where user_id='$user_id'";
 $result=mysqli_query($con,$select_query2) or die(mysqli_error($con));
 $row2=mysqli_fetch_array($result);
  $select_query="select * from user where user_id in(select sender from friends where status='accepted' and receiver='$user_id')";
 $result=mysqli_query($con,$select_query) or die(mysqli_error($con));
 $row=mysqli_fetch_array($result);
 $select_query1="select * from user where user_id in(select receiver from friends where status='accepted' and sender='$user_id')";
 $result1=mysqli_query($con,$select_query1) or die(mysqli_error($con));
 $row1=mysqli_fetch_array($result);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row2['first_name']."  ".$row2['last_name'] ?></title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="#" />
    </head>
</html>
<body>
        <?php
            include 'includes/header.php';
        ?>
        <div class="container">
            <div  class="row text-center" style="margin-top: 75px">
                <div class="col-lg-2">
                    <h3 style="color: red">Friends</h3>
                    <br>
                    <?php
                        foreach ($result as $row){
                    ?>
                    <div class="thumbnail" class="image_profile">
                        <?php
                            if($row['directory']){
                        ?>
                        <img src=<?php echo $row['directory'] ?> alt=<?php echo $row['first_name'] ?>>
                        <?php
                            }
                        else{    
                        ?>
                        <img src='images/male.jpg' alt=<?php echo $row['first_name'] ?>>
                        <?php 
                            }
                        ?>
                        <div class="caption">
                            <h3><?php  echo $row['first_name'];  ?></h3>
                            <a href="add_friend_script.php?unfriend_id=<?php echo $row['user_id']?>" class="btn btn-block btn-danger" >Unfriend</a>
                        </div>
                    </div>
                    <?php
                          
                        }
                    ?>
                    <br>
                     <?php
                        foreach ($result1 as $row){
                    ?>
                    <div class="thumbnail" class="image_profile">
                        <?php
                            if($row['directory']){
                        ?>
                        <img src=<?php echo $row['directory'] ?> alt=<?php echo $row['first_name'] ?>>
                        <?php
                            }
                        else{    
                        ?>
                        <img src='images/male.jpg' alt=<?php echo $row['first_name'] ?>>
                        <?php 
                            }
                        ?>
                        <div class="caption">
                            <h3><?php  echo $row['first_name'];  ?></h3>
                            <a href="add_friend_script.php?unfriend_id=<?php echo $row['user_id']?>" class="btn btn-block btn-danger" >Unfriend</a>
                        </div>
                    </div>
                    <?php
                          
                        }
                    ?>
                </div>
            </div>
        </div>
 </body>
