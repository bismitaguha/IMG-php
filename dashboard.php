<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
     body{ font: 14px sans-serif; }
     .wrapper{ width: 350px; padding: 20px;}
     .help-block{ color: red;}
</style>
</head>
<body>

<?php
require "config.php";
session_start();
if($_SESSION["loggedin"] == TRUE ){
  

$username = $_SESSION["username"];
$sql = "SELECT * FROM bismita_users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_object($result);}
else { header("location: login.php");}
if($row) {
   ?><div class="wrapper">
    <div class="form-group" id="details">
    <input type="button" class="btn btn-default" value="Edit your Profile" onclick='edit()'><hr>
    
    <label style="margin-bottom: 2px;">Name:</label><span class="form-control" style="border: 0px; padding: 0px; border-radius: 0px; height: 25px;"><?php echo $row->name; ?></span><br>
    <label>Email:</label><span class="form-control" style="border: 0px; padding: 0px; border-radius: 0px; height: 25px;"><?php echo $row->email; ?></span><br>
    <label>Gender:</label><span class="form-control" style="border: 0px; padding: 0px; border-radius: 0px; height: 25px;"><?php echo $row->gender; ?></span><br>
    <label>Mobile Number.:</label><span class="form-control" style="border: 0px; padding: 0px; border-radius: 0px; height: 25px;"><?php echo $row->mobile_no; ?></span><br>
    <label>Username:</label><span class="form-control" style="border: 0px; padding: 0px; border-radius: 0px; height: 25px;"><?php echo $row->username; ?></span><br>
    <a href="change.php">Change your password</a>
    <br><a href="chat.php">Chat</a>
    </div>
<div class="form-group" id="form-edit" style="display: none";>

<form id="image" action="image.php" method="post" enctype="multipart/form-data">
<label>Change Profile Picture:</label>
<input type="file" name="image" id="image" class="form-control" ><input type="submit" name="submit" class="btn btn-primary" value="Upload"><br>
<br>
</form>
<form action="update.php" method="post">
<label>Name:</label>
<input type="text" name="name" class="form-control" value="<?php echo $row->name; ?>"><br><br>
<label>Gender:</label><br>
<input type="radio" name="radio" value="male" <?php if($row->gender == "male") {echo "checked=checked";} ?>>Male<br>
<input type="radio" name="radio" value="female" <?php if($row->gender == "female") {echo "checked=checked";} ?>>Female<br>
<label>Mobile Number:</label>
<input type="number" name="mobile_no" class="form-control" value="<?php echo $row->mobile_no; ?>"><br><input type="submit" name="submit" class="btn btn-primary" value="Update Profile">
</form>
</div>
<?php } ?>
<a href="logout.php">Logout</a>
</div>
<script>

function edit(){
  document.getElementById('details').style.display = 'none';
  document.getElementById('form-edit').style.display = 'block';
}
</script>
</body>
</html>
 
