<?php

/************************* 
 * Accounts Controller
 ************************/


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';


// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName="
    . urlencode($classification['classificationName']) .
    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

  case 'deliverRegisterView':
    include '../view/registration.php';
    break;
  case 'deliverLoginView':
    include '../view/login.php';
    break;


  default:

}
