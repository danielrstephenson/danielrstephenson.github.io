<?php

/************************* 
 * Accounts Controller
 ************************/

// Test users & passwords
// admin@cit336.net, Sup3rU$er, Sup3rU$ee
// sally@jones.com, S@11yJones, S@11yJonez

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
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
  case 'register':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // check for existing email
    $existingEmail = checkExistingEmail($clientEmail);

    // Deal with existing email during registration
    if ($existingEmail) {
      $message = '<p>The email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }
    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model if no errors exist
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {

      $message = "<p class='notice'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      include '../view/login.php';
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
  break;
  case 'deliverRegisterView':
    include '../view/registration.php';
    break;
  case 'deliverLoginView':
    include '../view/login.php';
    break;


  default:
    include '../view/admin.php';
    exit;
}
