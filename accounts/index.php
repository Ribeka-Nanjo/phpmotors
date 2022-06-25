<?php
//This is an account controller

//creat or access a Settion
session_start();

//Get the database connectioin file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';


$classifications = getClassifications();
//var_dump($classifications);
//exit;

$navList = navList($classifications);

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {

  case 'doRegister':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    $existingEmail = checkExistingEmail($clientEmail);

// Check for existing email address in the table
    if ($existingEmail) {
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

// Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

// Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
    break;


  case 'doLogin':
    // Filter and store the data
    $clientEmail = filter_input(INPUT_POST, 'clientEmail');
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword');
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if (empty($clientEmail) || empty($checkPassword)) {
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
    header('Location: /phpmotors/');
    exit;
    break;

  case 'updateInfo':
    include '../view/client-update.php';
    break;

  case 'updateClient':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

    //validate Email address 
    $clientEmail = checkEmail($clientEmail);

    // Check for existing email address in the table
    if (($clientEmail !== $_SESSION['clientData']['clientEmail']) && checkExistingEmail($clientEmail)) {
      $message = '<p class="notice">That email address already exists. please try a different one</p>';
      include '../view/client-update.php';
      exit;
    }

    // Check for missing data
    if (empty($clientId || empty($clientFirstname) || empty($clientLastname) || empty($clientEmail))) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    $clientOutcome = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
    if ($clientOutcome) {
      $clientData = getClientId($clientId);
      array_pop($clientData);
      $_SESSION['clientData'] = $clientData;

      $message = "<p class='notify'>Congratulations, the information was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header("Location: /phpmotors/accounts/");
      exit;
    } else {
      $message = "<p class='notify'> Sorry, information update failed. Please try again!</p>";
      include '../view/client-update.php';
      exit;
    }
    break;

  case'updatePassword';
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $checkPassword = checkPassword($clientPassword);
    if (empty($checkPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/client-update.php';
      exit;
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $passOutcome = updateNewPass($hashedPassword, $clientId);

    if ($passOutcome === 1) {
      $message = "<p>Password update was a success.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/');
      exit;
    } else {
      $message = "<p>Sorry, but password update failed. Please try again.</p>";
      $_SESSION['message'] = $message;
      include '../view/client-update.php';
      exit;
    }
    break;


  case 'login':
    include '../view/login.php';
    break;
  case 'register':
    include '../view/registration.php';
    break;
  default:
    include '../view/admin.php';
    break;

}