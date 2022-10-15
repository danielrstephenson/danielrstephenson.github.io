<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>New Classification | PHP Motors</title>
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
            <h1 class="account-heading">Add Car Classification</h1>
            <?php
            if (isset($message)) {
             echo $message;
            }
            ?>
            <form action="/phpmotors5/vehicles/" method="post">
                <label for="carClassification" >Classification Name</label><br>
                <input type="text" name="carClassification" id="carClassification" required><br>
                <input type="submit" value="Add Classification">
                <input type="hidden" name="action" value="add-class">
            </form>
          <hr>  
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors5/common/footer.php'; ?>
        </footer>
        </div>
    </body>
</html>
