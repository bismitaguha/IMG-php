<?php
require "config.php";
session_start();
if($_SESSION["loggedin"] == TRUE || isset($_COOKIE["userid"])){
    $username = $_SESSION["username"];
      $sql = "SELECT username FROM bismita_users WHERE not username = '$username'";
        $result = mysqli_query($link, $sql);
          $storeArray = array();
            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                  $storeArray[] = $row['username'];
                    }
}
 
    ?>



<!DOCTYPE html>
<html>
<head>
<title>Chat</title>
</head>
<body>
    <ul>
       
      <?php 
      $arrlength = count($storeArray);
      echo $arrlength." users";
      for($i = 0; $i<($arrlength); $i++){
        echo "<form method='post' action='message1.php'><li><input type='submit' name='to' value='$storeArray[$i]'></li></form>";
      }
      ?>
        </ul>
        <a href="dashboard.php">Dashboard</a>

        </body>
        </html>
