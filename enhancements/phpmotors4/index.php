<?php
/************************* 
 * Main Controller
 ************************/


// Get the database connection file
require_once 'library/connections.php';
// Get the main model for use as needed
require_once 'model/main-model.php';


// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
	$navList .= "<li><a href='/phpmotors4/' title='View the PHP Motors home page'>Home</a></li>";
	foreach ($classifications as $classification) {
		$navList .= "<li><a href='/phpmotors4/vehicles?action=classification&classificationName="
			. urlencode($classification['classificationName']) .
			"' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
	}
	$navList .= '</ul>';



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