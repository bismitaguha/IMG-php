<?php
require_once "config.php";

$username=$password=$name=$email=$confirm_password=$gender=$mobile_no="";
$username_err=$password_err=$confirm_password_err=$email_err=$mobile_no_err=$name_err="";

if($_SESSION["REQUEST_METHOD"]=="POST"){
  if(!empty(trim($_POST["name"]))) {
    $name=$_POST["name"];
  } else{$name_err="Please fill your name.";}
  if(!empty(trim($_POST["email"]))){
    $email=$_POST["email"];
    $sql= "SELECT * from bismita_users WHERE email= '$email'";

    if($stmt= mysqli_prepare($link,$sql)){
       if(mysqli_num_rows($stmt)==1){

         $username_err="The username already exists.";
                            }}
  } else {$email_err="Please fill in your email.";}
  if(empty(trim($_POST["username"]))){
    $username_err="Please enter a username.";}
  else {
    $username=$_POST["username"];
    $sql= "SELECT * from bismita_users WHERE username= '$username'";

    if($stmt= mysqli_prepare($link,$sql)){
      if(mysqli_num_rows($stmt)==1){
        $username_err="The username already exists.";
      }}}
  if(!empty(trim($_POST["password"]))){
    $password=$_POST["password"];
  } else {$password_err="Password cannot be empty.";}


?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
   body{ font: 14px sans-serif; }
   .wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>
<div class="wrapper">
   <h2>Sign Up</h2>
   <p>Please fill this form to create an account.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group">
   <label>Name:</label>
   <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
   <span class="help-block"><?php echo $name_err; ?></span>
</div>
<div class="form-group">
   <label>Email:</label>
   <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
   <span class="help-block"><?php echo $email_err; ?></span>
</div>
<div class="form-group">
   <label>Username:</label>
   <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
   <span class="help-block"><?php echo $username_err; ?></span>
</div>    
<div class="form-group">
   <label>Password:</label>
   <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
   <span class="help-block"><?php echo $password_err; ?></span>
</div>
<div class="form-group">
   <label>Confirm Password:</label>
   <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
   <span class="help-block"><?php echo $confirm_password_err; ?></span>
</div>
<div class="form-group">
  <label>Gender:</label><br>
  <input type="radio" name="radio" value="male">Male<br>
  <input type="radio" name="radio" value="female">Female
</div>
<div class="form-group">
   <label>Mobile No.:</label>
   <input type="number" name="confirm_password" class="form-control" value="<?php echo $mobile_no; ?>">
   <span class="help-block"><?php echo $mobile_no_err; ?></span>
</div>
<div class="form-group">
   <input type="submit" class="btn btn-primary" value="Submit">
   <input type="reset" class="btn btn-default" value="Reset">
</div>
<p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>
</div>    
</body>
</html>



