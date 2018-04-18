<?php
   require 'includes/common.php';
   if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
   $id=$_SESSION['id'];
   $select_query="select * from user where user_id='$id' ";
   $result=mysqli_query($con,$select_query) or die(mysqli_error($con));
   $row=mysqli_fetch_array($result);
   if (isset($_GET['profile_id'])){
    $profile_id=$_GET['profile_id'];
    $select_query1="select * from user where user_id='$profile_id' ";
    $result1=mysqli_query($con,$select_query1) or die(mysqli_error($con));
    $row1=mysqli_fetch_array($result1);
    $select_query2="select * from user where user_id in (select sender from friends where receiver='$profile_id' and status='accepted') or user_id  in (select receiver from friends where sender='$profile_id' and status='accepted')   order by rand()";
$result2=mysqli_query($con,$select_query2) or die(mysqli_error($con));
$row2=mysqli_fetch_array($result2);
$flag=0; 
   }
   else{
$select_query2="select * from user where user_id in (select sender from friends where receiver='$id' and status='accepted') or user_id  in (select receiver from friends where sender='$id' and status='accepted')   order by rand()";
$result2=mysqli_query($con,$select_query2) or die(mysqli_error($con));
$row2=mysqli_fetch_array($result2);
$flag=0;  
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="stylesheet" href="profile.css" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="#" />
    </head>
</html>
<body>
    <?php
            include 'includes/header.php';
    ?>
    <div class="container" style="margin-top: 65px">
        <div class="row text-center">
            <div class="col-lg-3">
                <div class="thumbnail">
                    <?php if (isset($_GET['profile_id'])){
                     if($row1['directory'])
                        { 
                            echo "<img src=".$row1['directory']." alt=".$row1['first_name']." class="."image_profile".">" ; 
                        }
                        else
                        {  
                    ?>    
                            <img src="images/male.jpg" alt="Camera 1" width="200">
                            <?php
                        }
                    }
                     else{
                         if($row['directory'])
                        { 
                            echo "<img src=".$row['directory']." alt=".$row['first_name']." class="."image_profile".">" ; 
                        }
                        else
                        {  
                    ?>    
                            <img src="images/male.jpg" alt="Camera 1" height="480px">
                            <?php
                        }
                     }
                            ?>
                </div>
                <h4 style="color: green">
                    <?php 
                    if (isset($_GET['profile_id'])){
                        echo $row1['first_name']." ".$row1['last_name'];
                    }
                    else{
                        echo $row['first_name']." ".$row['last_name'];
                    }
                    ?>
                </h4>
            </div>
            <div class="col-lg-9">
               <table>
                   <?php if (isset($_GET['profile_id'])){ ?>
                    <tr>
                        <td>Branch</td>
                        <td><?php echo $row1['branch'] ?></td> 
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row1['email'] ?></td> 
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><?php echo $row1['contact']?></td> 
                    </tr>
                   <?php } else{ ?>
                     <tr>
                        <td>Branch</td>
                        <td><?php echo $row['branch'] ?></td> 
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $row['email'] ?></td> 
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><?php echo $row['contact']?></td> 
                    </tr>  
                  <?php } ?>
                </table>
            </div>
        </div>
        <div clas="row">
            <h1 style="color:greenyellow; margin-top: 40px">Friends</h1>
        </div>
        <div class="row" style=" display: block;margin-top:65px;height: 100px">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($result2 as $row2){
                       if ($flag==0){   
                    ?>
                    <div class="item active">
                        
                     <?php $flag=1; } else{?>
                     <div class="item">
                         <?php } ?>
                            <div class="row text-center">
                                <div class="col-lg-3">
                                    <div class="thumbnail">
                                        <?php 
                                        
                                            if($row2['directory'])
                                            { 
                                                echo "<img src=".$row2['directory']." alt=".$row2['first_name']." class="."image_profile".">" ; 
                                            }
                                            else
                                            {  
                                        ?>    
                                                <img src="images/male.jpg" alt="Camera 1" height="480px">
                                            <?php
                                            }
                                            ?>
                                    </div>
                                    <h4 style="color: green">
                                    <?php 
                                        echo $row2['first_name']." ".$row2['last_name'];
                                    ?>
                                    </h4>
                                </div>
                                <div class="col-lg-9">
                                    <table>
                                        <tr>
                                            <td>Branch</td>
                                            <td><?php echo $row2['branch'] ?></td> 
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row2['email'] ?></td> 
                                        </tr>
                                        <tr>
                                            <td>Contact</td>
                                            <td><?php echo $row2['contact']?></td> 
                                        </tr>
                                    </table>
                                </div>
                        </div>
                    </div> 
                   <?php } ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    </div>
</body>