<?php
//Get the database connectioin file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the vehicle model
require_once '../model/vehicles-model.php';


$classifications = getClassifications();
//var_dump($classifications);
//exit;

$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$classificationList = '<select id="classificationId" name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= '<option value="' . $classification['classificationId'] . '">' . 
    $classification['classificationName'] . '</option>';
}
$classificationList .= '</select>';

$action = filter_input(INPUT_GET, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_POST, 'action');
 } 

 switch ($action){

case 'addVehicle':     
 // Filter and store the data
 //$classificationName= filter_input(INPUT_POST, 'classificationName');
 $invMake= filter_input(INPUT_POST, 'invMake');
 $invModel = filter_input(INPUT_POST, 'invModel');
 $invDescription = filter_input(INPUT_POST, 'invDescription');
 $invImage = filter_input(INPUT_POST, 'invImage');
 $invThumbnail= filter_input(INPUT_POST, 'invThumbnail');
 $invPrice = filter_input(INPUT_POST, 'invPrice');
 $invStock = filter_input(INPUT_POST, 'invStock');
 $invColor= filter_input(INPUT_POST, 'invColor');
 $classificationId= filter_input(INPUT_POST, 'classificationId');

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