<?php
require 'includes/common.php';
 $user_id=$_SESSION['id'];
 if (isset($_POST['submit'])){
 $select_query="select * from user where user_id='$user_id'";
 $result=mysqli_query($con,$select_query) or die(mysqli_error($con));
 $row=mysqli_fetch_array($result);
 $target_dir = "uploads/".$row['email']."/";
 $email=$row['email'];
 if(!is_dir($target_dir)){
 mkdir("$target_dir");
 }
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (!basename($_FILES["fileToUpload"]["name"])){
    header('location:myprofile.php?error=No photo selected.');
}
else{
    if(isset($_POST["submit"])){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        }
        else{
            $uploadOk = 0;
            header('location:myprofile.php?error=File is not an Image.');
        }
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000 && $uploadOk ==1) {
        header('location:myprofile.php?error=File size too large.');
        $uploadOk = 0;
    }
    // Allow certain file formats
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $uploadOk ==1) {
            header('location:myprofile.php?error=JPG, JPEG, PNG & GIF files are allowed.');
            $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0 ) {
       
    }
    // if everything is ok, try to upload file
    else{
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
        $insert_query="update user set directory='$target_file'  where email='$email'";
        $insert_data=mysqli_query($con,$insert_query) or die(mysqli_error($con));
        header('location:myprofile.php');
        } 
        else{
            header('location:myprofile.php?error=Upload Failed due to some reasons.');
        }
    }
}
}
if(isset($_POST['remove'])){
    $update_query="update user set directory='' where user_id='$user_id'";
    $result1=mysqli_query($con,$update_query) or die(mysqli_error($con));
    header('location:myprofile.php');
}
?>