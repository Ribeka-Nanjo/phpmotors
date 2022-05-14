<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Registration page| PHP Motors</title>


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
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" ?>
    </nav>

    <main>
    <form id="regist" method="post">
    <fieldset>
        <legend> Create New Account </legend>
        <ul>
            <li>
                <label for="fName">First Name: </label><br>
                <input type="text"  placeholder="First Name" id="fName" name="fName">
            </li>
            <li>
                <label for="name"> Last Name: </label><br>
                <input type="text"  placeholder="Last Name" id="name" name="name">
            </li>
            <li>
                <label for="address">Email Address: </label><br>
                <input type="text"  placeholder="Email Address" id="address" name="address">
            </li>
            <li>
                <label for="password">Password:</label><br>
                <input type="password"  placeholder="Password" id="password" name="password">
            </li>
        </ul>
        <div class="button">
    <button type="button" class="registbtn">Create</button>
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