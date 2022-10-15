<?php
/************************* 
 * Main Controller
 ************************/

// Get the database connection file
require_once 'library/connections.php';
// Get the main model for use as needed
require_once 'model/main-model.php';
require_once 'library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);


$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
 case 'template':
  include 'view/template.php';
  break;
 default:
  include 'view/home.php';
}