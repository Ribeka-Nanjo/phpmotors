<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php if(isset($invInfo['invMake'])){ 
	echo "$invInfo[invMake] $invInfo[invModel]";} ?>|  PHP Motors, Inc.</title>


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
    <?php 
           echo $navList; ?> 
    </nav>

    <main>
    <h1><?php echo " $invInfo[invModel]"; ?> Vehicles</h1>
    <?php if(isset($message)){
             echo $message; }
    ?>
    <?php if(isset($vehicleSpecificInfo)){
    echo $vehicleSpecificInfo;
} ?>
    </main>


    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>

</html>