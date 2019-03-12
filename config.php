<?php
define('DB_SERVER', '192.168.121.187');
define('DB_USERNAME', 'first_year');
define('DB_PASSWORD', 'first_year');
define('DB_NAME', 'first_year_db');
 
$link = mysqli_connect("192.168.121.187","first_year","first_year","first_year_db");
 
// Check connection
if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
