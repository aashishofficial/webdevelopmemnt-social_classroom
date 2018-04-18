<?php
  require 'includes/common.php';
  if(!isset($_SESSION['email'])){
       header('location:index.php');
   }
   $user_id=$_SESSION['id'];
   $content=htmlspecialchars($_POST['content']);
   if((isset($_POST['content']))){
   $insert_query="insert into post (posted_by,post_content) values ('$user_id','$content')";
   $result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
   }
   header('location:myprofile.php');
   ?>        
   