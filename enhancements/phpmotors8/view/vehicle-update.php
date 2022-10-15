<?php
if($_SESSION['loggedin'] != TRUE || $_SESSION['clientData']['clientLevel'] < 2){
    header("Location: ../");
}

// Build the classifications option list
    $classifList = '<select name="classificationId" id="classificationId">';
        foreach ($classifications as $classification) {
            $classifList .= "<option value='$classification[classificationId]'";
            if(isset($classificationId)){
                if($classification['classificationId'] === $classificationId){
                    $classifList .= ' selected ';
                }
            }elseif(isset($invInfo['classificationId'])){
                if($classification['classificationId'] === $invInfo['classificationId']){
                 $classifList .= ' selected ';
                }
            }
        $classifList .= ">$classification[classificationName]</option>";
        }
    $classifList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>
  <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel']))
                    { echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) 
                    { echo "Modify $invMake $invModel"; }
            ?>
 </title>
 <link href="/phpmotors8/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors8/common/header.php'; ?>
  </header>
  <nav>
   <?php echo $navList; ?>
  </nav>
  <main>
   <h1 class="account-heading">
    <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel']))
                    { echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) 
                    { echo "Modify $invMake $invModel"; }
                ?>
   </h1>
   <?php if (isset($message)) { echo $message;} ?>
   <p class="center">*Note all Fields are Required</p>
   <form action="/phpmotors8/vehicles/" method="post">
    <?php 
                echo $classifList;
                ?>
    <label for="invMake">Make</label>
    <input type="text" name="invMake" id="invMake" required <?php 
                    if(isset($invMake))
                        { echo "value='$invMake'"; } 
                    elseif(isset($invInfo['invMake'])) 
                        {echo "value='$invInfo[invMake]'"; }
                    ?>>

    <label for="invModel">Model</label>
    <input type="text" name="invModel" id="invModel" required <?php 
                   if(isset($invModel))
                       { echo "value='$invModel'"; } 
                    elseif(isset($invInfo['invModel'])) 
                       {echo "value='$invInfo[invModel]'"; }
                    ?>>

    <label for="invDescription">Description</label>
    <textarea id="invDescription" name="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; }elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
    

    <label for="invImage">Image Path</label>
    <input type="text" name="invImage" id="invImage" value="/php_motors/images/no-image.png" required <?php if(isset($invImage)){echo "value='$invImage'";}
                    elseif(isset($invInfo['invImage'])) 
                       {echo "value='$invInfo[invImage]'"; }
                       ?>>

    <label for="invThumbnail">Thumbnail Path</label>
    <input type="text" name="invThumbnail" id="invThumbnail" value="/php_motors/images/no-image.png" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  
                    elseif(isset($invInfo['invThumbnail'])) 
                       {echo "value='$invInfo[invThumbnail]'"; }
                    ?>>

    <label for="invPrice">Price</label>
    <input type="text" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}
                    elseif(isset($invInfo['invPrice'])) 
                       {echo "value='$invInfo[invPrice]'"; }
                    ?>>

    <label for="invStock"># In Stock</label>
    <input type="text" name="invStock" id="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}  
                    elseif(isset($invInfo['invStock'])) 
                       {echo "value='$invInfo[invStock]'"; }
                    ?>>

    <label for="invColor">Color</label>
    <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";}  
                    elseif(isset($invInfo['invColor'])) 
                       {echo "value='$invInfo[invColor]'"; }
                    ?>>

    <input type="submit" value="Update Vehicle">
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
   </form>
  </main>
  <hr>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors8/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>
