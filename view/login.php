<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login page | PHP Motors</title>


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
    <?php //include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php";
           echo $navList; ?> 
    </nav>
    <main>
    <form id="login" method="post">
    <fieldset>
        <legend> Login </legend>
        <?php if (isset($message)) { echo $message;}
    ?>
        <ul>
            <li>
                <label for="address">Email Address: </label><br>
                <input type="email"  placeholder="Email Address" id="address" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
            </li>
            <li>
                <label class="label" for="password">Password: </label><br>
                <span>Passwords must be at least 8 characters and contain at least 1 number, 
                    1 capital letter and 1 special character</span><br>
                <input type="password" placeholder="Password" id="password" name="password" 
                required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </li>
        </ul>
        <div class="button">
        <input type="submit" name="submit" id="registbtn" value="Login">
        <input type="hidden" name="action" value="login"><br>
    <span class="psw">No account? <a class="regist" href="/phpmotors/accounts?action=registration.php">Sign-up</a></span>
  </div>
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