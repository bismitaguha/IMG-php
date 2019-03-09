<?php
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'main');
 
$link = mysqli_connect("192.168.121.187","first_year","first_year","first_year_db");
 
// Check connection
if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
