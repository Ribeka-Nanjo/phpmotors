<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Add Vehicle page| PHP Motors</title>


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
    <h1>Vehicle Management</h1>
    <?php if (isset($message)) { echo $message;}
    ?>
    <div class="vehiman">
         <ul>
            <li>
            <a href="/phpmotors/vehicles?action=add-classification">Add Classification</a>
            </li>
            <li>
            <a href="/phpmotors/vehicles?action=add-vehicle">Add Vehicle</a>
            </li>
        </ul>   
</div>   
    </main>
    <hr>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>

</html>