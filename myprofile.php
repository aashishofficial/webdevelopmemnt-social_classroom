<?php
  require 'includes/common.php';
  if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
$user_id=$_SESSION['id'];
$select_query="select * from user where user_id='$user_id'";
$result=mysqli_query($con,$select_query) or die(mysqli_error($con));
$row=mysqli_fetch_array($result);
$branch=$row['branch'];
$email=$row['email'];
$select_query1="select * from user where user_id not in (select sender from friends where receiver='$user_id' and status='accepted')and user_id not in (select receiver from friends where sender='$user_id' and status='accepted')  and email!='$email' order by rand() limit 5";
$result1=mysqli_query($con,$select_query1) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $row['first_name']."  ".$row['last_name'] ?></title>
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
        <div class="container" style="margin-top: 65px">
            <div  class="row text-center">
                <div class="col-lg-2 ">
                        <div class="thumbnail" >
                         <?php if($row['directory'])
                            { 
                               echo "<a href="."profile.php"."><img src=".$row['directory']." alt=".$row['first_name']." class="."image_profile"."></a>" ; 
                            }
                            else
                           {  
                        ?>    
                            <a href="profile.php"><img src="images/male.jpg" alt="Camera 1" height="480px"></a>
                        <?php
                            }
                        ?>
                        </div>
                        <h4 style="color: green">
                        <?php 
                            echo $row['first_name']." ".$row['last_name'];
                        ?>
                        </h4>
                        <?php
                         $select_query4="select * from user where user_id='$user_id' ";
                         $result4=mysqli_query($con,$select_query4) or die(mysqli_error($con));
                         $row4=mysqli_fetch_array($result4);
                         if($row4['directory']){ ?>
                            <form class="form-inline" method="post" enctype="multipart/form-data" action="addphoto_script.php"> 
                                <input type="file" name="fileToUpload" value="fileupload" id="fileupload">
                                <button type="submit" name="submit" value="change" class="btn btn-primary">Change</button>
                                <button type="submit" name="remove" value="remove" class="btn btn-primary">Remove</button>
                                <br>
                                <?php 
                                    if (isset($_GET['error'])){
                                       echo $_GET['error'];
                                    }
                                ?>        
                            </form>
                         <?php }
                         else{
                         ?>
                        <form method="post" enctype="multipart/form-data" action="addphoto_script.php"> 
                            <input type="file" name="fileToUpload" value="fileupload" id="fileupload">
                            <button type="submit" name="submit" class="btn btn-primary">Set Profile Picture</button>
                            <br>
                            <?php 
                                if (isset($_GET['error'])){
                                    echo $_GET['error'];
                                }
                             ?>
                        </form>
                        <?php } ?>
                <?php   include 'includes/sidenav.php'; ?>
                </div>
                <div class="col-lg-7 col-lg-offset-1">
                    <div class="row text-left">
                        <form method="post" action="post_script.php">
                        <h2> Write a post:</h2>
                         <textarea rows="4" cols="80" name="content">
                         </textarea> 
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" style="">Post</button>
                        </form>
                    </div>
                    <br>
                    <br>
                    <div class="row text-left">
                    <?php
                    $select_query6="select * from post where posted_by='$user_id'";
                    $result6=mysqli_query($con,$select_query6) or die(mysqli_error($con));
                    foreach($result6 as $row6){
                        echo $row6["post_content"];
                        echo $row6['Date'];
                    }
                    ?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h3 style="color: red">Suggestions</h3>
                    <br>
                     <?php
                        if (mysqli_num_rows($result)==0){
                            echo "<center><h3>No one is from the branch mentioned by you.</h3></center>";
                        }
                    else{
                        foreach ($result1 as $row){
                    ?>
                    <div class="thumbnail" class="image_profile">
                         <?php
                            if($row['directory']){
                        ?>
                        <a href="profile.php?profile_id=<?php echo $row['user_id']?>"><img src=<?php echo $row['directory'] ?> alt=<?php echo $row['first_name'] ?>></a>
                        <?php
                            }
                        else{    
                        ?>
                        <a href="profile.php?profile_id=<?php echo $row['user_id']?>"><img src='images/male.jpg' alt=<?php echo $row['first_name'] ?>></a>
                        <?php 
                            }
                        ?>
                        <div class="caption">
                            <h3><?php  echo $row['first_name'];  ?></h3> 
                            <?php
                                $sender=$_SESSION['id'];
                                $receiver=$row['user_id'];
                                $select_query2="select * from friends where sender='$sender' and receiver='$receiver' and status='pending'";
                                $result2=mysqli_query($con,$select_query2) or die(mysqli_error($con));
                                $select_query3="select * from friends where sender='$receiver' and receiver='$sender' and status='pending'";
                                $result3=mysqli_query($con,$select_query3) or die(mysqli_error($con));
                                if(mysqli_num_rows($result3)){
                                ?>
                                    <a href="add_friend_script.php?acceptrequest_id=<?php echo $row['user_id']?>" class="btn btn-block btn-primary" >Accept Request</a>
                                 <?php   
                                 } 
                                elseif(!mysqli_num_rows($result2)){
                                ?>
                                    <a href="add_friend_script.php?friendrequest_id=<?php echo $row['user_id']?>" class="btn btn-block btn-primary" >Add Friend</a>
                                <?php 
                                    }
                                    else{
                                ?>
                                    <a href="add_friend_script.php?cancelrequest_id=<?php echo $row['user_id']?>" class="btn btn-block btn-success" >Cancel Request</a>
                                <?php   } ?>    
                        </div>
                    </div>
                    <?php
                          
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
 </body>
</html>
