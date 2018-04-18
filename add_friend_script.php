<?php
    require 'includes/common.php';
    $sender=$_SESSION['id'];
    if(isset($_GET['friendrequest_id'])){
    $receiver=$_GET['friendrequest_id'];
    $insert_query="insert into friends (sender,receiver,status) values ('$sender','$receiver','pending')";
    $result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
    header('location:myprofile.php');
    }
    if(isset($_GET['cancelrequest_id'])){
    $receiver=$_GET['cancelrequest_id'];
    $insert_query="delete from friends where receiver='$receiver' and sender='$sender' and status='pending'";
    $result1=mysqli_query($con,$insert_query) or die(mysqli_error($con));
    header('location:myprofile.php');
    }
    if(isset($_GET['acceptrequest_id'])){
    $receiver=$_GET['acceptrequest_id'];
    $update_query="update friends set status='accepted' where sender='$receiver' and receiver='$sender'";
    $result2=mysqli_query($con,$update_query) or die(mysqli_error($con));
    header('location:myprofile.php');
    }
    if(isset($_GET['unfriend_id'])){
    $receiver=$_GET['unfriend_id'];
    $delete_query1="delete from friends where status='accepted' and sender='$receiver' and receiver='$sender'";
    $delete_query2="delete from friends where status='accepted' and sender='$sender' and receiver='$receiver'";
    $result2=mysqli_query($con,$delete_query1) or die(mysqli_error($con));
    $result3=mysqli_query($con,$delete_query2) or die(mysqli_error($con));
    header('location:friends.php');
    }

?>
