<?php
include 'config.php';
session_start();
if($_SESSION["loggedin"] ==TRUE){
   $username= $_SESSION["username"];
  if(isset($_POST['submit'])){
    $to_username=$_POST["to"];
    if(!empty($_POST["message"])){ 
    $message=$_POST["message"];}
    $sql = "INSERT INTO bismita_chat(from_user, messages, to_user) VALUES ('$username','$message', '$to_username')";
    if($link->query($sql) === TRUE){
      echo "message sent";
      header("location: chat.php");
    } else { $link->error;}
    $link->close();
  } } else { header("location: login.php");}

?>

