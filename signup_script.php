<?php
require 'includes/common.php';
$email=$_POST['email'];
$password=$_POST['password'];
  $regex_email= "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
  if (!preg_match($regex_email,$email)){
      header('location: signup.php?email_error=Enter correct email');
  }
 else if (strlen($password)<6){
      header('location: signup.php?password_error=Enter password greater than 6 characters.');
 }
 else{
  $email= mysqli_real_escape_string($con,$email);
  $password=md5(mysqli_real_escape_string($con,$password));
  $first_name=mysqli_real_escape_string($con,$_POST['first_name']);
  $last_name=mysqli_real_escape_string($con,$_POST['last_name']);
  $branch=mysqli_real_escape_string($con,$_POST['branch']);
  $contact=mysqli_real_escape_string($con,$_POST['contact']);
  $select_query="select * from user where email='$email'";
  $check_data=mysqli_query($con,$select_query) or die(mysqli_error($con));
  if (mysqli_num_rows($check_data)>0){
      header('location: signup.php?emailexist_error=This email is already registered.');
  }
  else{
      $insert_query="insert into user (email,password,first_name,last_name,contact,branch) values('$email','$password','$first_name','$last_name','$contact','$branch')";
      echo $insert_query;
      $insert_data=mysqli_query($con,$insert_query) or die(mysqli_error($con));
      $_SESSION['id']=mysqli_insert_id($con);
      $_SESSION['email']=$email;
      header('location:index.php');
  }
 }
 ?>
