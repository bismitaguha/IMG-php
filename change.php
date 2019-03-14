<?php

include 'config.php';
session_start();
if($_SESSION["loggedin"] == TRUE){
  $username = $_SESSION["username"];
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $password =$_POST["new_password"];
    $conf_password =$_POST["conf_password"];
    $curr_password = $_POST["current_password"];
    $sql = "SELECT password FROM bismita_users WHERE username = '$username'";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_object($result)){
          $hash=$row->password;
                 }
          if(password_verify($curr_password,$hash)) {
            if($conf_password==$password){ $hash1= password_hash($password, PASSWORD_DEFAULT);
            $sql="UPDATE bismita_users SET password = '$hash1' WHERE username= '$username'";
            if($link->query($sql) === TRUE){
              echo "Updated successfully.";
              //header("location: dashboard.php");
            }} else { echo "Confirm password doesn't match.";}
            } else { echo "Current password is wrong.";}
  }} else { header("location: login.php");}

?>

<!DOCTYPE html>
<html>
<head>
<title>Change your Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
     body{ font: 14px sans-serif; }
     .wrapper{ width: 350px; padding: 20px;}
     .help-block{ color: red;}
</style>
</head>
<body>
<div class="wrapper">
<div class="form-group">
<form id="change" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
  <label>Current Password:</label>
  <input type="password" name="current_password" class="form-control"><br>
  <hr>
  <label>New Password:</label>
  <input type="password" name="new_password" class="form-control" id="password" ><br>
  <label>Confirm Password:</label>
  <input type="password" name="conf_password" class="form-control" id="conf_password" onkeyup='check()' ><br>
  <span id="message"></span>
  <input type="submit" name="submit" value="Change">
</form>
</div>
</div>
<script>

function check() {
  if(document.getElementById('password').value == document.getElementById('conf_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password does not match';
  }}

</script>
</body>
</html>

