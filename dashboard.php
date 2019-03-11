<!DOCTYPE html>
<html>
<body>

<?php
include 'login.php';
session_start();
$sql = "SELECT * FROM bismita_users WHERE id = '$id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_object($result);
while($row) {<?
    
    <div class="profile-form">
    <input type="button" id="btn" value="Edit your Profile">
    <label>Name:</label><span class="details"><?php echo $row->name; ?></span>
    <label>Email:</label><span class="details"><?php echo $row->email; ?></span>
    <label>Gender:</label><span class="details"><?php echo $row->gender; ?></span>
    <label>Mobile Number.:</label><span class="details"><?php echo $row->mobile_no; ?></span>
    <label>Username:</label><span class="details"><?php echo $row->username; ?></span>
    <a href="change.php">Change your password</a>
    <div>    
<div class="profile-form">
<form id="profile" action="update.php" method="post">
<input type="file" name="image" id="image">
<input type="text" name="name" class="update" value="<?php echo $row->name; ?>">
<input type="email" name="email" class="update" value="<?php echo $row->email; ?>">
<input type="radio" name="radio" value="male" <?php if($row->gender == "male") {echo "checked=checked"} ?>>
<input type="radio" name="radio" value="female" <?php if($row->gender == "female") {echo "checked=checked"} ?>>
<input type="number" name="mobile_no" class="update" value="<?php echo $row->mobile_no; ?>">
</form>
<div>
?>}
<a href="logout.php">Logout</a>
</div>
</body>
</html>
