<?php  

if (($_SESSION['loggedin'] != TRUE) || ($_SESSION['clientData']['clientLevel'] == 1)) {
  header("Location: /phpmotors7/");
  exit;
}

$classifList = '<select name="classificationId">';
foreach ($classifications as $classification){
    $classifList .= "<option value='$classification[classificationId]'";
    
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classifList .= ' selected ';
        }
    }
    $classifList .= ">$classification[classificationName]</option>";
}
 $classifList .= '</select>';
?><!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>New Vehicle | PHP Motors</title>
 <link href="/phpmotors7/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors7/common/header.php'; ?>
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
   <p class="notice">*Note all Fields are Required</p>
   <form action="/phpmotors7/vehicles/" method="post">
   <label for="carClass">Classification</label>
    <?php
    echo $classifList;
    ?>
    
    <label for="invMake">Make</label>
    <input type="text" name="invMake" id="invMake" required 
    <?php if(isset($invMake)){echo "value='$invMake'";}  ?>>

    <label for="invModel">Model</label>
    <input type="text" name="invModel" id="invModel" required 
    <?php if(isset($invModel)){echo "value='$invModel'";}  ?>>

    <label for="invDescription">Description</label>
    <textarea id="invDescription" name="invDescription" required><?php if(isset($invDescription)){echo $invDescription;}  ?></textarea>

    <label for="invImage">Image Path</label>
    <input type="text" name="invImage" id="invImage" value="/phpmotors7/images/no-image.png" required 
    <?php if(isset($invImage)){echo "value='$invImage'";}  ?>>

    <label for="invThumbnail">Thumbnail Path</label>
    <input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors7/images/no-image.png" required 
    <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>>

    <label for="invPrice">Price</label>
    <input type="text" name="invPrice" id="invPrice" required 
    <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>>

    <label for="invStock"># In Stock</label>
    <input type="text" name="invStock" id="invStock" required 
    <?php if(isset($invStock)){echo "value='$invStock'";}  ?>>

    <label for="invColor">Color</label>
    <input type="text" name="invColor" id="invColor" required 
    <?php if(isset($invColor)){echo "value='$invColor'";}  ?>>

    <input type="submit" value="Add Vehicle">
    <input type="hidden" name="action" value="add-vehicle">
   </form>
   <hr>
  </main>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors7/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>