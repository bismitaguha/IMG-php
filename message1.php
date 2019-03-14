<!DOCTYPE html>
<html>
<title>Chat</title>
<body>

<?php 
include 'config.php';
session_start();
if($_SESSION["loggedin"] == TRUE || isset($_COOKIE["userid"])){
  $username=$_SESSION["username"];
  if(isset($_POST['to'])){
  $to_username=$_POST["to"];
$sql = "SELECT from_user, messages, to_user FROM bismita_chat WHERE (from_user = '$username' OR from_user = '$to_username') AND (to_user = '$username' OR to_user = '$to_username') ";
$result = mysqli_query($link, $sql);

//$row = mysqli_fetch_assoc($result);
  
  while($row=$result->fetch_assoc())

{
    echo $row['from_user'].":".$row['messages']."<br>";
}}} else {header("location: login.php");}
?>
<form action="message.php" method="post">
<input type="text" name="message"><input type="hidden" name="to" value="<?php echo $to_username;?>">
<input type="submit" name="submit" value="send">
</form>
</body>
</html>

