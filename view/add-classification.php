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
    <?php if (isset($message)) { echo $message;}
    ?>
    <form action="/phpmotors/vehicles/index.php" id="addClass" method="post">
        <h1> Add Car Classification </h1>
        <label for="carType"> Classification Name: </label><br>
        <input type="text" id="carType" name="classificationName"  required>
        <input type="submit" name="submit" id="addClassbtn" value="Addclass">
        <input type="hidden" name="action" value="addClass">
       
    </form>          
    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>

</html>