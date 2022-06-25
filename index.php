<?php
//This is the main controller

//creat or access a Settion
session_start();

require_once 'library/connections.php';
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

$classifications = getClassifications();
//var_dump($classifications);
//exit;

$navList = navList($classifications);

$action = filter_input(INPUT_GET, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_POST, 'action');
 }

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   }

 switch ($action){
    case 'template':
     include 'view/template.php';
     break;
    default:
     include 'view/home.php';
   }

   