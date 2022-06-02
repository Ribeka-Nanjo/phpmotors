<?php
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

$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_GET, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_POST, 'action');
 }

 switch ($action){
     
case 'register':     
 // Filter and store the data
$clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$clientEmail =  trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
$clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);

// Check for missing data
if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/registration.php';
    exit; 
   }
// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

// Check and report the result
if($regOutcome === 1){
    $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
    include '../view/login.php';
    exit;
   } else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
    include '../view/registration.php';
    exit;
   }
    break;
    case 'login':     
        // Filter and store the data
       $clientEmail = filter_input(INPUT_POST, 'clientEmail');
       $clientPassword = filter_input(INPUT_POST, 'clientPassword');

       $clientEmail = checkEmail($clientEmail);
       $checkPassword = checkPassword($clientPassword);
       
       if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit; 
       }
    
   case 'login':
    include '../view/login.php';
     break;
    default:
    case 'register':
    include '../view/registration.php';

   }