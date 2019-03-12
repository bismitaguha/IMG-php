<?php

  class chatClass
  {
    public static function getRestChatLines($id)
    {
      $arr = array();
      $jsonData = '{"results":[';
      $db_connection = new mysqli( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "SELECT id, usrname,  chattext, chattime FROM bismita_chat WHERE id > ? and chattime >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
      $statement->bind_param( 'i', $id);
      $statement->execute();
      $statement->bind_result( $id, $username, $chattext, $chattime);
      $line = new stdClass;
      while ($statement->fetch()) {
        $line->id = $id;
        $line->usrname = $usrname;
        $line->color = $color;
        $line->chattext = $chattext;
        $line->chattime = date('H:i:s', strtotime($chattime));
        $arr[] = json_encode($line);
      }
      $statement->close();
      $db_connection->close();
      $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
      return $jsonData;
    }
    
    public static function setChatLines( $chattext, $usrname, $color) {
      $db_connection = new mysqli( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "INSERT INTO bismita_chat( usrname, chattext) VALUES(?, ?, ?)");
      $statement->bind_param( 'sss', $usrname, $color, $chattext);
      $statement->execute();
      $statement->close();
      $db_connection->close();
    }
  }
?>
