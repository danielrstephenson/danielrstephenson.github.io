<?php
/* 
 * Proxy connection to the phpmotors database
 */

function phpmotorsConnect()
{
  $server = 'localhost';
  $dbname = 'phpmotors';
  $username = 'iClient';
  $password = 'cxw*bfy8dwc0amj9XZQ';

  $dsn = "mysql:host=$server;dbname=$dbname";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  // Create connection object and assign it to a variable
  try {
    return new PDO($dsn, $username, $password, $options);
  } catch (PDOException $e) {
    header('Location: /phpmotors2/view/500.php');
    exit;
  }
}