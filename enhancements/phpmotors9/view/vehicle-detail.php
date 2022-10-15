<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title><?php echo $vehicleDetail['invMake'].' '.$vehicleDetail['invModel']; ?> | PHP Motors, Inc.</title>
 <link href="/phpmotors9/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/header.php'; ?>
  </header>
  <nav>
   <?php echo $navList; ?>
  </nav>
  <main id="detail">
   <?php if (isset($message)) {
    echo $message;
   } ?>
   <?php if (isset($vehicleDisplay)) {
    echo $vehicleDisplay;
   } if (isset($imageDisplay)) {
     echo $imageDisplay;
    } ?>
    <div id="imageReplace">&nbsp;</div>
  </main>
  <hr>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>