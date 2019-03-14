<?php

include 'config.php';
session_start();
if($_SESSION["loggedin"] == TRUE || isset($_COOKIE["userid"])){
	$username = $_SESSION["username"];
//ImageUpload
  
 
$target_dir = "uploads/";
$target_file = $target_dir. basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if(isset($_POST["submit"])) { 
  if(!empty(getimagesize($_FILES["image"]["tmp_name"]))){
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      
       if($check !== false) {
               echo "File is an image - " . $check["mime"] . ".";
               $uploadOk = 1;
               } else {
                 echo "File is not an image.";
                 $uploadOk = 0;
                }
}}
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "") { 
   echo "Sorry, only JPG, JPEG & PNG files are allowed.";$submit=0;
   $uploadOk = 0;
 }

if ($uploadOk == 0) {$submit=0;
    echo "Sorry, your file was not uploaded.";

    } else {
 
	    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		    $submit = 1;
          echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
	    } else {$submit = 0;
		    echo "Sorry, there was an error uploading your file.";
             }
 }
	 $sql = "UPDATE bismita_users SET image = '$target_file' WHERE username = '$username'";
   
 if($link->query($sql) === TRUE){
	 echo "Profile Picture set.";
	 header("location: dashboard.php");
 } else{ echo $sql.$link->error;}
 $link->close();
} else { header("location: login.php");} 
