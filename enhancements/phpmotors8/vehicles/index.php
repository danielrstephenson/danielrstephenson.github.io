<?php

/************************* 
 * Vehicles Controller
 ************************/

session_start();

// Get the database connection file
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
//require_once '../model/uploads-model.php';
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);


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
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit;
    }

    //add to database
    $classifAdded = insertNewClassification($carClassification);

    if ($classifAdded) {
      header('Location: /phpmotors8/vehicles/');
    } else {
      $message = '<p class="notice">An error occured while adding the new classification to the database, please try again later.</p>';
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
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
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
      $message = '<p class="notice">The ' . $invMake . ' ' . $invModel . ' was added successfully!</p>';
      include '../view/add-vehicle.php';
      exit;
    } else {
      $message = '<p class="notice">The new vehicle could not be added at this time. Please try again later</p>';
      include '../view/add-vehicle.php';
      exit;
    }
    break;

  case 'vehicle-page':
    include '../view/add-vehicle.php';
    exit;
    break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
  case 'getInventoryItems':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray);
    break;

  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;

  case 'updateVehicle':
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
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


    if (
      empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)
    ) {
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/vehicle-update.php';
      exit;
    }

    $updateResult = updateVehicle(
      $invMake,
      $invModel,
      $invDescription,
      $invImage,
      $invThumbnail,
      $invPrice,
      $invStock,
      $invColor,
      $classificationId,
      $invId
    );

    // echo $updateResult; exit;
    if ($updateResult) {
      $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors8/vehicles/');
      exit;
    } else {
      $message = "<p class='notice'>The $invMake $invModel could not be updated at this time. Please try again later</p>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = '<p class="notice">Sorry, no vehicle information could be found.</p>';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;

  case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<p class='notice'>Congratulations the $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors8/vehicles/');
      exit;
    } else {
      $message = "<p class='notice'>Error: $invMake $invModel was not
      deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors8/vehicles/');
      exit;
    }
    break;

  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
    $vehicles = getVehiclesByClassification($classificationName);
    if (!count($vehicles)) {
      $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
    } else {
      $vehicleDisplay = buildVehicleDisplay($vehicles);
    }
    include '../view/classification.php';
    break;
  case 'vehicle':
    $invId = filter_input(INPUT_GET, 'vid', FILTER_SANITIZE_STRING);
    $vehicleDetail = getVehicleDetail($invId);
    if (!count($vehicleDetail)) {
      $message = "<p class='notice'>Sorry, no vehicle information could be found.</p>";
    } else {
      $vehicleImages = getVehicleDetail($invId);
//      $imageDisplay = buildVehicleImagesDisplay($vehicleImages);
      $vehicleDisplay = daniel($vehicleDetail);
    }
    include '../view/vehicle-detail.php';
    break;
  default:
    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
    exit;
    break;
}
