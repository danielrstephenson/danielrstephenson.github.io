<?php

/* 
 * Vehicle Model
 */

function insertNewClassification($classificationName)
{
 $db = phpmotorsConnect();
 $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

function addVehicle(
 $invMake,
 $invModel,
 $invDescription,
 $invImage,
 $invThumbnail,
 $invPrice,
 $invStock,
 $invColor,
 $classificationId
) {

 $db = phpmotorsConnect();

 $sql = 'INSERT INTO inventory '
  . '(invMake, invModel, invDescription, invImage, invThumbnail, '
  . 'invPrice, invStock, invColor, classificationID) '
  . 'VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, '
  . ':invPrice, :invStock, :invColor, :classificationId);';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
 $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
 $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
 $db = phpmotorsConnect(); 
 $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
 $stmt = $db->prepare($sql); 
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
 $stmt->execute(); 
 $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 $stmt->closeCursor(); 
 return $inventory; 
}

// Get vehicle information by invId
function getInvItemInfo($invId){
 $db = phpmotorsConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $invInfo;
}

// Update a vehicle
function updateVehicle($invMake, $invModel, $invDescription, $invImage,  $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
  $db = phpmotorsConnect();
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
   $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// Delete a vehicle from inventory
function deleteVehicle($invId) {
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// Get list of vehicles by classification name
function getVehiclesByClassification($classificationName){
  $db = phpmotorsConnect();
  $sql = 'SELECT inventory.invId, invMake, invModel, invPrice, imgPath FROM inventory join images WHERE inventory.invId = images.invId AND imgPath LIKE \'%-tn%\' AND imgPrimary = 1 AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}


// Get information for all vehicles
function getVehicles(){
 $db = phpmotorsConnect();
 $sql = 'SELECT invId, invMake, invModel FROM inventory';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $invInfo;
}

// Get vehicle detail information
function getVehicleDetail($invId){
  $db = phpmotorsConnect();
  $sql = 'SELECT i.invId, invMake, invModel, invDescription, invStock, invPrice, invColor, imgPath  FROM inventory AS i join images WHERE i.invId = images.invId AND imgPath NOT LIKE \'%-tn%\' AND i.invId  = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $detail = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $detail;
 }