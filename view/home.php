<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Home | PHP Motors</title>

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
            <h1>Welcome to PHP Motors</h1>
            <div>
                <ul class="d-list">
                <li><strong>DMC Delorean</strong></li>
                    <li>3 cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzy dice</li>
                </ul>
                <div class="img-sec">
                    <img src="./images/site/own_today.png" id=button alt="button">
                    <img src="./images/delorean.jpg" class="delorean-img" alt="delorean image">
                </div>
            </div>
            <div class="d-content">
            <div class=d-review>
                <h2>DMC Delorean Reviews</h2>
                <ul class="d-review">
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly." (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's living and love it." (5/5)</li>
                </ul>
            </div>
            <div class="d-content2">
                <h2>Delorean Upgrades</h2>
                <div class="upgrades">
                    <a href="#">
                        <figure>
                            <div class="up-sticker">
                                <img src="./images/upgrades/flux-cap.png" alt="image of a flux capacitor">
                            </div>
                            <figcaption>Flux Capacitor</figcaption>
                        </figure>
                    </a>
                    <a href="#">
                        <figure>
                            <div class="up-sticker">
                                <img src="./images/upgrades/flame.jpg" alt="image of a flame decals">
                            </div>
                            <figcaption>Flame Decals</figcaption>
                        </figure>
                    </a>
                </div>
                <div class="upgrades">
                    <a href="#">
                        <figure>
                            <div class="up-sticker">
                                <img src="./images/upgrades/bumper_sticker.jpg" alt="image of a bumper">
                            </div>
                            <figcaption>Bumper Stickers</figcaption>
                        </figure>
                    </a>
                    <a href="#">
                        <figure>
                            <div class="up-sticker">
                                <img src="./images/upgrades/hub-cap.jpg" alt="image of a hub caps">
                            </div>
                            <figcaption>Hub Caps</figcaption>
                        </figure>
                    </a>
            </div>
        </div>
    </div>
</main>
 <hr>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
</div>
</body>
</html>
      