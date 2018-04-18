<?php
  require 'includes/common.php';
  if(!isset($_SESSION['email']))
  {
      header('location:index.php');
  }
  $old_password=mysqli_real_escape_string($con,$_POST['old_password']);
  $new_password=mysqli_real_escape_string($con,$_POST['new_password']);
  $user_id=$_SESSION['id'];
  $renew_password=mysqli_real_escape_string($con,$_POST['renew_password']);
  $select_query="select password from user where user_id='$user_id'";
  $result=mysqli_query($con,$select_query) or die(mysqli_error($con));
  $new_password1=md5($new_password);
  $row=mysqli_fetch_array($result);
  if (strlen($new_password)<6){
      header('location: settings.php?password_error=Enter password with atleast 6 characters.');
  }
  elseif ($new_password!=$renew_password){
      header('location: settings.php?match_error=New password in both fields should match.');
  }
  elseif ($new_password==$old_password){
      header('location: settings.php?change_error=New password must be different from old.');
  }
  elseif ($row['password']==md5($old_password)){
      $update_query="update user set password='$new_password1' where user_id='$user_id'";
      $result1=mysqli_query($con,$update_query) or die(mysqli_error($con));
      header('location: settings.php?pwchange_success=Password Succesfully changed!');
      }
  else{
      header('location: settings.php?wrongpw_error=Incorrect Old password!');
  }
?>

