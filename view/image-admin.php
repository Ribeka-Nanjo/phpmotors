<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Image Management | PHP Motors</title>


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
      <h1>Image Management</h1>

      <h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Vehicle</label>
	<?php echo $prodSelect; ?>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>

</body>
</html>
<?php unset($_SESSION['message']); ?>