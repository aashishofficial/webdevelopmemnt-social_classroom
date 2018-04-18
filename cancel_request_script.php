<?php
    require 'includes/common.php';
    $receiver=$_GET['friendrequest_id'];
    $sender=$_SESSION['id'];
    $insert_query="insert into friends (sender,receiver,status) values ('$sender','$receiver','pending')";
    $result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
?>
