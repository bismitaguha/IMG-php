<?php
 
include 'config.php';
require 'image.php';
session_start();
if($_SESSION["loggedin"] == TRUE ){
  $id = $_SESSION["id"];
  $username = $_SESSION["username"];
  if(isset($_POST["submit"])){ echo "hi";
    if(!empty(trim($_POST["name"]))) {
      $name=$_POST["name"];
    } else{$name_err="Name cannot be empty.";}

    if(isset($_POST["radio"])){
          $gender=$_POST["radio"];
            }
      if(!empty($_POST["mobile_no"])){
            $mobile_no=$_POST["mobile_no"];
              } else { $mobile_no_err="Enter a valid mobile no.";}
      
  
      if($name_err=="" && $mobile_no_err=""){
        $sql = "UPDATE bismita_users SET name = '$name', gender = '$gender', mobile_no = '$mobile_no', image = '$target_file' WHERE username = '$username'";

       if($link->query($sql) === TRUE){
        echo "Updated successfully.";
        header("location: chat.php");
       } else { echo $sql.$link->error;
       }
       $link->close();
      }
  }}
