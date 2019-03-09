<?php
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'main');
 
$link = mysqli_connect("localhost","bismita","biscuit@7777","main");
 
// Check connection
if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
