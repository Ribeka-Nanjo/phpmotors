<?php
//This is a vehicle controller

//creat or access a Settion
session_start();

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
// Get the upload
require_once '../model/uploads-model.php';



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
 $classificationId= trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

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
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p>Please complete all information for the updated item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
            }

            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
            if ($updateResult === 1) {
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header("location: /phpmotors/vehicles/");
                exit;
               } else {
                $message = "<p class='notify'> Error. the $invMake $invModel was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
            break;
            
        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
                include '../view/vehicle-delete.php';
                exit;
                break;
        break;

        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error: $invMake $invModel was not
            deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
            break;
        
            case 'classification':
                $classificationName = filter_input(INPUT_GET, 'classificationName', 
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Get the vehicles info
                $vehicles = getVehiclesByClassification($classificationName);
                if(!count($vehicles)){
                 $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
                } else {
                 $vehicleDisplay = buildVehiclesDisplay($vehicles);
                // echo $vehicleDisplay;
                 //exit;
                }
                include '../view/classification.php';
                break;
                
            // The function will build a display of vehicle's details.
            case 'vehicleView':
                $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
                $invInfo = getInvItemInfo($invId);

                // Get the vehicles info
                $vehiclesDetail = getInvInfo($invId);
                $getThumbnails = getThumbnails($invId);
                if(empty($invInfo)){
                 $message = "<p class='notice'>Sorry, on $invId could be found.</p>";
                } else {
                 $vehicleSpecificInfo = buildVehiclesView($vehiclesDetail);
                 $vehicleThumbnail = buildThumbnailDisplay($getThumbnails);
                }
                include '../view/vehicle-detail.php';
                break;


            default;
            $classificationList = buildClassificationList($classifications);
        
            include $_SERVER ['DOCUMENT_ROOT']. '/phpmotors/view/vehicle-man.php';
            break;
   }

   

   ?>