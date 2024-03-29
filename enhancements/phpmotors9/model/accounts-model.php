<?php

/************************* 
 * Accounts Model
 ************************/

// Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
      VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
  // Create the prepared statement using the php_motors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

// Check for existing email address
function checkExistingEmail($clientEmail)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if (empty($matchEmail)) {
    return 0;
    // echo 'Nothing found';
    // exit;
  } else {
    return 1;
    // echo 'Match found';
    // exit;
  }
}

// Get client data based on an email address
function getClient($clientEmail)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
          FROM clients
          WHERE clientEmail = :clientEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId){
  // Create a connection
  $db = phpmotorsConnect();
  // The SQL statement to be used with the database
  $sql = 'UPDATE clients SET clientFirstname = :firstName, clientLastname = :lastName, clientEmail = :email  WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':firstName', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':lastName', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getAccountByID($clientId){
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM clients WHERE clientId = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function updatePassword($password, $clientId){
  // Create a connection
  $db = phpmotorsConnect();
  // The SQL statement to be used with the database
  $sql = 'UPDATE clients SET clientPassword = :password WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}