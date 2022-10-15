<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Vehicle Management | PHP Motors</title>
 <link href="/phpmotors5/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors5/common/header.php'; ?>
  </header>
  <nav>
   <?php echo $navList; ?>
  </nav>
  <main>
   <h1>Vehicle Management</h1>
   <ul>
    <li><a href="/phpmotors5/vehicles/?action=class-page">Add Classification</a></li>
    <li><a href="/phpmotors5/vehicles/?action=vehicle-page">Add Vehicle</a></li>
   </ul>
   <hr>
  </main>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors5/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>