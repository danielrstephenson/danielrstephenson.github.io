<!DOCTYPE html>
<html>

<head>
 <meta charset="UTF-8">
 <title>Server Error | PHP Motors</title>
 <link href="/phpmotors7/css/style.css" type="text/css" rel="stylesheet">
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
   <h1>Server Error</h1>
   <p id="err">Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
   <hr>
  </main>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors7/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>