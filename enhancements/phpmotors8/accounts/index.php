<?php

/************************* 
 * Accounts Controller
 ************************/
// Create or access a Session
session_start();

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
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      // include '../view/login.php';
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
  case 'Login':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientEmail = checkEmail($clientEmail);

    // Check for missing data
    if (empty($clientEmail) || empty($clientPassword)) {
      $message = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/login.php';
      exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if (!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
    break;

  case 'logout':
    session_destroy();
    unset($_SESSION);
    setcookie('PHPSESSID', '', strtotime('-1 hour'), '/');
    header('Location: /phpmotors8/');
    break;

  case 'update':
    include '../view/client-update.php';
    break;

  case 'acct-update':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);


    if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
      //check that values are the correct format
      $clientEmail = checkEmail($clientEmail);

      //check if email exists
      $existingEmail = checkExistingEmail($clientEmail);

      // Check for existing email address in the table
      if ($existingEmail) {
        $_SESSION['message'] = '<p class="notice">That email address already exists. Please chose another.</p>';
        include '../view/client-update.php';
        exit;
      }
    }
    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $_SESSION['message'] = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    // Send the data to the model
    $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    // Check and report the result
    if ($updateOutcome) {
      $_SESSION['clientData'] = getAccountByID($clientId);
      $_SESSION['message'] = "<p class='notice'>$clientFirstname, Yor information has been updated.</p>";
      header('Location: /phpmotors8/accounts/');
      exit;
    } else {
      $_SESSION['message'] = "<p class='notice'>Sorry $clientFirstname, we could not update your account information. Please try again.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  case 'pass-update':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $checkPassword = checkPassword($clientPassword);

    if (!empty($clientPassword) && $checkPassword) {
      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      //update password
      $updatePass = updatePassword($hashedPassword, $clientId);

      if ($updatePass) {
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $_SESSION['message'] = "<p class='notice'>$clientFirstname, Your password has been updated.</p>";
        header('Location: /phpmotors8/accounts/');
        exit;
      } else {
        $_SESSION['message'] = "<p class='notice'>An error occured and the password could not be updated.</p>";
        header('Location: /phpmotors8/accounts/');
        exit;
      }
    } else {
      $_SESSION['message2'] = "<p class='notice'>Please Make sure your password matches the desired pattern.</p>";
      include '../view/client-update.php';
      exit;
    }
    break;




  default:
    include '../view/admin.php';
    exit;
}
