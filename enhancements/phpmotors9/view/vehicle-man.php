<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors9/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Vehicle Management | PHP Motors</title>
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
  <main>
   <h1>Vehicle Management</h1>
   <ul>
    <li><a href="/phpmotors9/vehicles/?action=class-page">Add Classification</a></li>
    <li><a href="/phpmotors9/vehicles/?action=vehicle-page">Add Vehicle</a></li>
   </ul>

   <?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
  <table id="inventoryDisplay"></table>
   <hr>
  </main>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
  </footer>
 </div>
 <script src="/phpmotors9/js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>