<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>New Vehicle | PHP Motors</title>
 <link href="/phpmotors4/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors4/common/header.php'; ?>
  </header>
  <nav>
   <?php echo $navList; ?>
  </nav>
  <main>
   <h1 class="account-heading">Add Vehicle</h1>
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   <p class="center">*Note all Fields are Required</p>
   <form action="/phpmotors4/vehicles/" method="post">
   <label for="carClass">Classification</label><br>
    <?php
    echo $classificationList;
    ?>
    <br>
    <label for="invMake">Make</label>
    <input type="text" name="invMake" id="invMake">

    <label for="invModel">Model</label>
    <input type="text" name="invModel" id="invModel">

    <label for="invDescription">Description</label>
    <textarea id="invDescription" name="invDescription"></textarea>

    <label for="invImage">Image Path</label>
    <input type="text" name="invImage" id="invImage" value="/phpmotors4/images/no-image.png">

    <label for="invThumbnail">Thumbnail Path</label>
    <input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors4/images/no-image.png">

    <label for="invPrice">Price</label>
    <input type="text" name="invPrice" id="invPrice">

    <label for="invStock"># In Stock</label>
    <input type="text" name="invStock" id="invStock">

    <label for="invColor">Color</label>
    <input type="text" name="invColor" id="invColor">

    <input type="submit" value="Add Vehicle">
    <input type="hidden" name="action" value="add-vehicle">
   </form>
   <hr>
  </main>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors4/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>