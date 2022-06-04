<?php
//Get the database connectioin file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the vehicle model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';



$classifications = getClassifications();
//var_dump($classifications);
//exit;

$navList = navList($classifications);

$action = filter_input(INPUT_GET, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_POST, 'action');
 } 

 switch ($action){

case 'addVehicle':     
 // Filter and store the data
 //$classificationName= filter_input(INPUT_POST, 'classificationName');
 $invMake= trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invThumbnail= trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $invColor= trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
 $classificationId= trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

// Check for missing data
if ( empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage)|| empty($invThumbnail)|| empty($invPrice)|| empty($invStock)|| empty($invColor) || empty($classificationId)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/add-vehicle.php';
    exit; 
   }

// Send the data to the model
$invOutcome = invCar( $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
// Check and report the result
if($invOutcome === 1){
    $message = "<p>This vehical registration was a success.</p>";
    include '../view/vehicle-man.php';
    exit;
   } else {
    $message = "<p>Sorry, the vehical registration failed. Please try again! </p>";
    include  '../view/add-vehicle.php';
    exit;
   }
   break;

   case 'addClass':
    $classificationName= filter_input(INPUT_POST, 'classificationName');
    if (empty($classificationName)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/add-classification.php';
        exit; 
    }
    $newClassOutcome = newClass($classificationName);
    if($newClassOutcome === 1){
        $message = "";
        header("Location: /phpmotors/vehicles/");
        exit;
       }else{
           $message = "<p>Sorry, the vehical registration failed. Please try again! </p>";
        include  '../view/add-classification.php';
        exit;
       }
       break;
       
       case 'add-classification':
        include '../view/add-classification.php';
        break;
        case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;
        default;
            include '../view/vehicle-man.php';
            break;
   }
   ?>