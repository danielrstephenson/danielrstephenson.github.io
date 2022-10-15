<?php

/************************* 
 * Vehicles Controller
 ************************/

// Get the database connection file
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';


// Get the array of classifications
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

// Build Classification Select List 
$classificationList = '<select name="classificationId" id="classificationList">';
$classificationList .= "<option>Choose a Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .= '</select>';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'class-page':
    include '../view/add-classification.php';
    exit;
    break;

  case 'add-class':
    // Filter and store the data
    $carClassification = filter_input(INPUT_POST, 'carClassification', FILTER_SANITIZE_STRING);

    //check data
    if (empty($carClassification)) {
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit;
    }

    //add to database
    $classifAdded = insertNewClassification($carClassification);

    if ($classifAdded) {
      header('Location: /phpmotors4/vehicles/');
    } else {
      $message = '<p class="center">An error occured while adding the new classification to the database, please try again later.</p>';
      include '../view/add-classification.php';
      exit;
    }

    break;

  case 'add-vehicle':
    // Filter and store the data
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

    if (
      empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription)   || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)
    ) {
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      include '../view/add-vehicle.php';
      exit;
    }

    $vehicleAdded = addVehicle(
      $invMake,
      $invModel,
      $invDescription,
      $invImage,
      $invThumbnail,
      $invPrice,
      $invStock,
      $invColor,
      $classificationId
    );

    if ($vehicleAdded) {
      $message = '<p class="center">The ' . $invMake . ' ' . $invModel . ' was added successfully!</p>';
      include '../view/add-vehicle.php';
      exit;
    } else {
      $message = '<p class="center">The new vehicle could not be added at this time. Please try again later</p>';
      include '../view/add-vehicle.php';
      exit;
    }
    break;

  case 'vehicle-page':
    include '../view/add-vehicle.php';
    exit;
    break;


    default:
     include '../view/vehicle-man.php';
    exit;
    break;
}
