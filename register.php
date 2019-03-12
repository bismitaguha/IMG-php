<?php
include 'config.php';
$username=$password=$name=$email=$gender=$mobile_no=$confirm_password="";
$username_err=$password_err=$confirm_password_err=$email_err=$mobile_no_err=$name_err="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(!empty(trim($_POST["name"]))) {
    $name=$_POST["name"];
  } else{$name_err="Please fill your name.";}
  if(!empty(trim($_POST["email"]))){
       $sql= "SELECT id from bismita_users WHERE email= ?";
    $stmt = mysqli_prepare($link,$sql);
    if($stmt){
      mysqli_stmt_bind_param($stmt, "s", $param_email);
          $param_email=trim($_POST["email"]);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
       if(mysqli_stmt_num_rows($stmt)==1){
         $email_err="The email already exists.";
          } else { $email=trim($_POST["email"]);}
      }mysqli_stmt_close($stmt);
      }  
  } else {$email_err="Please enter your email";}
  if(empty(trim($_POST["username"]))){
    $username_err="Please enter a username.";}
  else {
    $sql= "SELECT id from bismita_users WHERE username= ?";
      $stmt=mysqli_prepare($link, $sql);
    if($stmt){
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      $param_username=trim($_POST["username"]);
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)==1){
        $username_err="The username already exists.";
      } else { $username = trim($_POST["username"]);}
    }mysqli_stmt_close($stmt);
    }  
  }
  if(!empty(trim($_POST["password"]))){
    $password=$_POST["password"]; $hash= password_hash($password, PASSWORD_DEFAULT);
  } else {$password_err="Password cannot be empty.";}
  if(!empty(trim($_POST["confirm_password"]))){
    if(trim($_POST["password"])==trim($_POST["confirm_password"])){
      $confirm_password_err="";
    } else{
      $confirm_password_err="Passwords do not match";
    }}
  
  if(isset($_POST["radio"])){
    $gender=$_POST["radio"];
  }
  if(!empty($_POST["mobile_no"])){
    $mobile_no=$_POST["mobile_no"];
  } else { $mobile_no_err="Enter a valid mobile no.";}
  if($username_err=="" && $password_err=="" && $confirm_password_err=="" && $email_err=="" && $mobile_no_err=="" && $name_err==""){
  $sql = "INSERT INTO bismita_users (username, password, name,email,gender,mobile_no) VALUES ('$username', '$hash', '$name', '$email', '$gender', '$mobile_no')";
 if($link->query($sql) === TRUE){
   echo "Registered successfully.";
   header("location: login.php");
 }
 else { echo $sql.$link->error;
}$link->close();
}}
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
   .help-block{font-color: red;}
</style>
</head>
<body>
<div class="wrapper">
   <h2>Sign Up</h2>
   <p>Please fill this form to create an account.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="my_form" onsubmit="return validateForm()" >
<div class="form-group">
   <label>Name:</label>
   <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" id="name" onkeyup='name_check()'><span id="message-3"></span>
   <span class="help-block"><?php echo $name_err; ?></span>
</div>
<div class="form-group">
   <label>Email:</label>
   <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" id="mail-id" onkeyup='match()'><span id="message-1"></span>
   <span class="help-block"><?php echo $email_err; ?></span>
</div>
<div class="form-group">
   <label>Username:</label>
   <input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>" onkeyup='checkAvailability()' >
   <span class="help-block"><?php echo $username_err; ?></span>
   <span id="user-availability-status"></span>
</div>    
<div class="form-group">
   <label>Password:</label>
   <input type="password" name="password" class="form-control" id="password"  value="<?php echo $password; ?>">
   <span class="help-block"><?php echo $password_err; ?></span>
</div>
<div class="form-group">
   <label>Confirm Password:</label>
   <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" id="confirm_password" onkeyup ='check()'><span id="message"></span>
   <span class="help-block"><?php echo $confirm_password_err; ?></span>
</div>
<div class="form-group">
  <label>Gender:</label><br>
  <input type="radio" name="radio" value="male">Male<br>
  <input type="radio" name="radio" value="female">Female
</div>
<div class="form-group">
   <label>Mobile No.:</label>
   <input type="number" name="mobile_no" class="form-control" value="<?php echo $mobile_no; ?>" id="ph-no" onkeyup='phone()'><span id="message-2"></span>
   <span class="help-block"><?php echo $mobile_no_err; ?></span>
</div>
<div class="form-group">
   <input type="submit" class="btn btn-primary" value="Submit">
   <input type="reset" class="btn btn-default" value="Reset">
</div>
<p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>
</div>
<script>

function checkAvailability() {
  
  jQuery.ajax({
    url: "check_availability.php",
    data:'username='+$("#username").val(),
    type: "POST",
    success:function(data){
    $("#user-availability-status").html(data);
    
},
error:function (){}
});
}
function check() {
  if (document.getElementById('password').value ==
  document.getElementById('confirm_password').value) {
  document.getElementById('message').style.color = 'green';
  document.getElementById('message').innerHTML = 'Password matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password does not match';
  }}

function name_check() {
  var term = document.getElementById('name').value;
  var re = /[a-zA-Z]+/;

  if (re.test(term)) {
     document.getElementById('message-3').style.color = 'green';
     document.getElementById('message-3').innerHTML = 'Valid';
     } else {
     document.getElementById('message-3').style.color = 'red';
     document.getElementById('message-3').innerHTML = 'Not Valid';
    }
}

function match() {
    var term = document.getElementById('mail-id').value;
    var re = /^\w+@[a-z]{2}(\.iitr\.ac\.in)$/;
    if (re.test(term)) {
       document.getElementById('message-1').style.color = 'green';
       document.getElementById('message-1').innerHTML = 'Valid';
    } else {
       document.getElementById('message-1').style.color = 'red';
       document.getElementById('message-1').innerHTML = 'Not Valid';
   }
}

function phone() {
   var term = document.getElementById('ph-no').value;
   var re = /^[6789]\d{9}$/;
   if (re.test(term)) {
      document.getElementById('message-2').style.color = 'green';
      document.getElementById('message-2').innerHTML = 'Valid';
   } else { 
      document.getElementById('message-2').style.color = 'red';
      document.getElementById('message-2').innerHTML = 'Not Valid';}
}

function validateForm() {
  var x = document.forms["my_form"]["name"].value;
    if (x == "") {
       alert("Name must be filled out");
       return false;
    }

    var x = document.forms["my_form"]["ph-no"].value;
      if (x == "") {
        document.getElementById('ph-no').style.color = 'red';
        alert("Phone Number must be filled out");
        return false;
      }
    var x = document.forms["my_form"]["password"].value;
       if (x == "") {
          document.getElementById('password').style.color = 'red';
          alert("Password must be filled out");
          return false;
      }
    var x = document.forms["my_form"]["confirm_password"].value;
       if (x == "") {
          document.getElementById('confirm_password').style.color = 'red';
          alert("Confirm Password must be filled out");
          return false;
      }
    var x = document.forms["my_form"]["mail-id"].value;
       if (x == "") {
          document.getElementById('mail-id').style.color = 'red';
          alert("Email must be filled out");
          return false;
      }
}
</script>
</body>
</html>



