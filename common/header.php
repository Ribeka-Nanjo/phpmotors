<img src="/phpmotors/images/site/logo.png" alt="logo" id=logo>
<?php if (isset($_SESSION['loggedin'])) {
  echo "<span class='welcome-message'> <a href = \"/phpmotors/accounts\" class=\"loginlink\">Welcome " . $_SESSION['clientData']['clientFirstname'] ." </a></span>";

}

if (isset($_SESSION['loggedin'])) {
  echo "<a href=\"/phpmotors/accounts/index.php?action=logout\"> Log Out </a>";
} else {
  echo "<a href= \"/phpmotors/accounts/index.php?action=doLogin\" class=\"login-link\"> My Account </a>";
}

