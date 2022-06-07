<?php
$classificationList = '<select id="classificationId" name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value= '$classification[classificationId]'";
    if(isset($classificationId)){
        if ($classification['classificationId'] === $classificationId){
         $classificationList .= ' selected ';   
        }
    }

    $classificationList .= "> $classification[classificationName] </option>";
}
$classificationList .= '</select>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Add vehicle page| PHP Motors</title>


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
        <legend> Add Vehicle </legend>
        <p>* Note all Fields are Required.</p>
        <p><?php if (isset($message)) { echo $message;}
    ?></P> 
    <br>
     <ul>
    <li> <?php echo $classificationList; ?> </li>
    <li> <label for="invMake"> Make </label><br>
        <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required >
    </li>
       <li> <label for="invModel"> Model </label><br>
        <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>
    </li>
    <li>      
        <label for="invDescription"> Description </label><br>
        <textarea  id="invDescription" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";} ?></textarea>
    </li>
    <li>
        <label for="invImage">Image Path</label><br>
        <input type="text" id="invImage" name="invImage" value="/images/no-image.png"  required>
    <li>
        <label for="invThumbnail"> Thumbnail Path </label><br>
        <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png" required>
    </li>
    <li>
        <label for="invPrice"> Price </label><br>
        <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
    </li>
    <li>
        <label for="invStock"> # In Stock</label><br>
        <input type="text" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
    </li>
    <li>
        <label for="invColor"> Color </label><br>
        <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
    </li>
</ul>
        <input type="submit" name="submit" id="invVehibtn" value="AddVehicle">
        <input type="hidden" name="action" value="addVehicle">
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