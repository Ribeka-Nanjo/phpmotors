<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }
// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }

   //Build a navigation bar using classifications array 
   function navList($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
     $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
     .urlencode($classification['classificationName']).
     "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
   }

   // Build the classifications select list 
   function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= '<option>Choose a Classification</option>'; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

   function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href = '/phpmotors/vehicles/?action=vehicleView&invId=$vehicle[invId]'>";
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= "<hr>";
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$$vehicle[invPrice]</span>";
     $dv .= "</a>";
     $dv .= "</li>";
    }
    $dv .= "</ul>";
    return $dv;
   }


   
   //build function that has specific info
   function buildVehiclesView($invInfo){
    $dv = "<section class= 'car-Details'>";
    $dv .= "<img src='$invInfo[invImage]' alt='Image of $invInfo[invMake] $invInfo[invModel]'>";
    $dv .= '<h2>Price: $'.number_format($invInfo['invPrice']).'</h2>';
    $dv .= "<h2>$invInfo[invMake] $invInfo[inModel] Details</h2>";
    $dv .= "<p>$invInfo[invDescription]</p>";
    $dv .= "<p>Color: $invInfo[invColor]</p>";
    $dv .= "<p>Number in Stock: $invInfo[invStock]</p>";
    $dv .= '</section>';
    return $dv;
   }

