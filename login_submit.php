<?php
  require 'includes/common.php';
  $email=$_POST['email'];
  $regex_email= "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
  if (!preg_match($regex_email,$email)){
      header('location: login.php?email_error=enter correct email');
  }
  $password=$_POST['password'];
  if (strlen($password)<6){
      header('location: login.php?password_error=enter correct password');
  }
  $email= mysqli_real_escape_string($con,$email);
  $password=md5(mysqli_real_escape_string($con,$password));
  $select_query="select user_id,email from user where email='$email' and password='$password'";
  $check_data=mysqli_query($con,$select_query) or die(mysqli_error($con));
  if (mysqli_num_rows($check_data)==0){
      echo "Please check your email and password.";
  }
  else{
      $row=mysqli_fetch_array($check_data);
      $_SESSION['id']=$row['user_id'];
      $_SESSION['email']=$row['email'];
      header('location:myprofile.php');
  }
 ?>
