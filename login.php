<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
      header("location: dashboard.php");
          exit();
}

include 'config.php';

$username=$password="";
$username_err=$password_err="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(empty(trim($_POST["username"]))){
     $username_err="Please enter username";
  } else{
     $username=trim($_POST["username"]);
  }
    if(empty(trim($_POST["password"]))){
         $password_err="Please enter password";
    } else{
       $password=$_POST["password"];
         }
         if(empty($username_err) && empty($password_err)){
          
             $sql ="SELECT id, username, password FROM bismita_users WHERE username = '$username'";
             $result = mysqli_query($link, $sql);
             while($row = mysqli_fetch_object($result)){
             $hash=$row->password;
             }
             if(password_verify($password,$hash)){
             
             $count = mysqli_num_rows($result);
              echo $count;
                if($count==1){
                session_start();
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                header("location: dashboard.php");
                echo "hi";}
         } else { $password_err="Wrong Password.";}
         }

         echo $hash."   ";
         echo $password;
        
        if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on'){
          $hour = time()+3600*24*30;
          setcookie('username', $username, $hour);
        }
                     
     $link->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
     body{ font: 14px sans-serif; }
    .wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>
<div class="wrapper">
   <h2>Login</h2>
   <p>Please fill in your credentials to login.</p>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
   <label>Username</label>
   <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
   <span class="help-block"><?php echo $username_err; ?></span>
   </div>    
   <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
   <label>Password</label>
   <input type="password" name="password" class="form-control">
   <span class="help-block"><?php echo $password_err; ?></span>
   <label>
   <input type="checkbox" name="remember_me" id="remember_me"> Remember me</label>
</div>
<div class="form-group">
   <input type="submit" class="btn btn-primary" value="Login">
</div>
<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
   </form>
</div>    
</body>
</html>
