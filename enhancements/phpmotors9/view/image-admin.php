<!DOCTYPE html>
<?php
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Image Management | PHP Motors</title>
        <link href="/phpmotors9/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/header.php'; ?>
        </header>
        <nav>
        <?php echo $navList ?>
        </nav>
        <main>
            <h1>Image Management Here</h1>
            <p>Choose one of the options below:</p>
            <h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors9/uploads/" method="post" enctype="multipart/form-data" id="imgUploadForm">
 <label for="invItem">Vehicle</label>
 <?php echo $prodSelect; ?>
 <fieldset>
 <label>Is this the main image for the vehicle?</label>
 <label for="priYes" class="pImage">Yes</label>
 <input type="radio" checked name="primary" id="priYes" class="pImage" value="1">
 <label for="priNo" class="pImage">No</label>
 <input type="radio" name="primary" id="priNo" class="pImage" value="0">
</fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

        </main>
        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>
