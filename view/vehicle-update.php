<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}

$classificationList = '<select id="classificationId" name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value= '$classification[classificationId]'";
    if(isset($classificationId)){
        if ($classification['classificationId'] === $classificationId){
         $classificationList .= ' selected ';   
        }
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classificationList .= ' selected ';
        }
    }

    $classificationList .= "> $classification[classificationName] </option>";
}
$classificationList .= '</select>';

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>


  <link href="/phpmotors/css/normalize.css" type="text/css" rel="stylesheet" media="screen">
  <link href="/phpmotors/css/base.css" type="text/css" rel="stylesheet" media="screen">
  <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head>

<body>

  <div id="wrapper">

    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
    </header>

    <nav>
    <?php echo $navList; ?> 
    </nav>

    <main>
    <form action="/phpmotors/vehicles/index.php" id="inv" method="post">
    <fieldset>
        <legend> <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify$invMake $invModel"; }?></legend>
        <p>* Note all Fields are Required.</p>
        <p><?php if (isset($message)) { echo $message;}
    ?></P> 
    <br>
     <ul>
    <li> <?php echo $classificationList; ?> </li>
    <li> <label for="invMake"> Make </label><br>
    <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
    </li>
       <li> <label for="invModel"> Model </label><br>
       <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
    </li>
    <li>      
        <label for="invDescription"> Description </label><br>
        <textarea  id="invDescription" name="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    </li>
    <li>
        <label for="invImage">Image Path</label><br>
        <input type="text" id="invImage" name="invImage" value="/images/no-image.png" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>
    </li>
    <li>
        <label for="invThumbnail"> Thumbnail Path </label><br>
        <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
    </li>
    <li>
        <label for="invPrice"> Price </label><br>
        <input type="text" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
    </li>
    <li>
        <label for="invStock"> # In Stock</label><br>
        <input type="text" id="invStock" name="invStock"  required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
    </li>
    <li>
        <label for="invColor"> Color </label><br>
        <input type="text" id="invColor" name="invColor"  required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
    </li>
</ul>
        <input type="submit" name="submit" id="invVehibtn" value="Update Vehicle">
        <input type="hidden" name="action" value="updateVehicle">
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
        elseif(isset($invId)){ echo $invId; } ?>">
        </fieldset>
    </form>          
    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>

</html>