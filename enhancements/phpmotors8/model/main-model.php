<?php

/* 
 * Main PHPMotors Model
 */

function getClassifications(){
 // Create a connection using the connection function
 $db = phpmotorsConnect(); 
 // The SQL statement to be used with the database 
 $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC'; 
 // Create a prepared statement using the DB connection      
 $stmt = $db->prepare($sql);
 // Run the prepared statement 
 $stmt->execute(); 
 // Get data from DB and store as an array in variable 
 $classifications = $stmt->fetchAll(); 
 // Closes the DB interaction 
 $stmt->closeCursor(); 
 // Send the array back to where it was called
 return $classifications;
}