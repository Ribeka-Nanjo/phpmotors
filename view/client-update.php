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

    <title>Update Account Information | PHP Motors</title>


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
        <?php if (isset($message)) {
          echo $message;
        } ?>
        <form action="/phpmotors/accounts/index.php" id="update" method="post">
          <fieldset>
            <legend> Manage Account</legend>
            <ul>
              <li>
                <label for="fName">First Name: </label><br>
                <input type="text" id="fName" name="clientFirstname" <?php if (isset($clientFirstname)) {
                  echo "value='$clientFirstname'";
                } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                  echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'";
                } ?> required>
              </li>
              <li>
                <label for="lastName"> Last Name: </label><br>
                <input type="text" id="lastName" name="clientLastname" <?php if (isset($clientLastname)) {
                  echo "value='$clientLastname'";
                } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                  echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";
                } ?> required>
              </li>
              <li>
                <label for="address">Email: </label><br>
                <input type="email" id="address" name="clientEmail" <?php if (isset($clientEmail)) {
                  echo "value='$clientEmail'";
                } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                  echo "value='" . $_SESSION['clientData']['clientEmail'] . "'";
                } ?> required>
              </li>
            </ul>
            <input type="submit" name="submit" id="updatebtn" value="Update Client">
            <input type="hidden" name="action" value="updateClient">
            <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
              echo "value=" . $_SESSION['clientData']['clientId'];
            } ?>">
        </form>
        </fieldset>
        <br>

        <form action="/phpmotors/accounts/index.php" id="update" method="post">
          <fieldset>
            <legend> Update Password</legend>
            <label><h3>New Password:</h3></label>
            <ul>
              <li><p class="clienPassword">Passwords must be at least 8 characters and contain at least 1 number,
                  1 capital letter and 1 special character</p><br>
              </li>
              <li>
                <input type="password" placeholder="Password" id="clientPassword" name="clientPassword"
                       required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
              </li>
            </ul>
            <input type="submit" name="submit" id="updatebtn" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
              echo "value=" . $_SESSION['clientData']['clientId'];
            } ?>">

        </form>
        </fieldset>
      </main>

      <hr>

      <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
      </footer>

    </div>

  </body>

</html>