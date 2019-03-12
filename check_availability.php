<?php
require_once("config.php");


if(!empty($_POST["username"])) {
	$username = $_POST["username"];
	$sql = "SELECT * FROM bismita_users WHERE username='$username'";
	$result = mysqli_query($link, $sql);
	if(mysqli_num_rows($result) == 1){
    
       echo "<span class='status-not-available'> Username Not Available.</span>";
       } else{
        echo "<span class='status-available'> Username Available.</span>";
      }
}
?>
