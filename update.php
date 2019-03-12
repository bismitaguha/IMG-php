<?php
 
include 'config.php';
session_start();
if($_SESSION["loggedin"] == TRUE ){
  $id = $_SESSION["id"];
  $username = $_SESSION["username"];
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty(trim($_POST["name"]))) {
      $name=$_POST["name"];
    } else{$name_err="Name cannot be empty.";}

    if(isset($_POST["radio"])){
          $gender=$_POST["radio"];
            }
      if(!empty($_POST["mobile_no"])){
            $mobile_no=$_POST["mobile_no"];
              } else { $mobile_no_err="Enter a valid mobile no.";}
      
      //Image Upload
      $target_dir = "uploads/";
      $target_file = $target_dir. basename($_FILES["image"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image."; $uploadOk = 0;}
      }

      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
      } else {
           if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
             } else {
             echo "Sorry, there was an error uploading your file.";
            }
     }
      if($name_err=="" && $mobile_no_err=""){
        $sql = "UPDATE bismita_users SET name = '$name', gender = '$gender', mobile_no = '$mobile_no', image = '$target_file' WHERE username = '$username'";

       if($link->query($sql) === TRUE){
        echo 

