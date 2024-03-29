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

function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {

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


