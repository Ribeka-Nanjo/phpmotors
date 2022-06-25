<?php
    if (empty($_SESSION['loggedin'])) {
        header('Location: /phpmotors/index.php');

    }
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin | PHP Motors</title>


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
    <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>
    <p>You are logged in</p>
    <ul>
        <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?></li>
        <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname']; ?></li>
        <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?></li>
    </ul>
    <h2>Account Management</h2>
    <p>Use this link to update account information</p>
    <p><a href="/phpmotors/accounts?action=updateInfo">Update Account Information</a></p>



    <?php
           if ($_SESSION['clientData']['clientLevel'] > 1){
                echo "<h2>Inventory Management</h2>";
                echo "<p>Use this link to manage the inventory</p>";
                echo "<a href = '/phpmotors/vehicles'>Vehicle Management</a>";
            }
    ?>
    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>

</html>