I. Create SQL Statements.
    1. Create a "sql" folder inside phpmotors.
    2. Create a new SQL file called enhancement.sql inside the "sql" folder.
    3. Write a SQL statement that inserts a new client into the clients table.

    INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment)
    VALUES ('Tony', 'Stark', 'tony@starkent.com', ' Iam1ronM@n', 1, 'I am the real Ironman');

    4. Modify the Tony Stark record to clientLevel 3.

    UPDATE clients SET clientLevel = 3 WHERE clientId = 1;

    5. Modify the "GM Hummer" record to read "spacious interior" rather than "small interior" using a single query.

    SELECT * FROM inventory WHERE invMake = 'GM' AND invModel = 'Hummer'; -- pull the ID

    UPDATE inventory
    SET invDescription = replace(invDescription, 'small interiors', 'spacious interiors')
    WHERE invId = 12;

    6. Use an inner join to select the invModel field from the inventory table and the classificationName field from the
    carclassification table for inventory items that belong to the "SUV" category.

    SELECT * FROM carclassification WHERE classificationName = 'SUV'; -- pull the ID

    SELECT i.invModel, c.classificationName
    FROM inventory i
    INNER JOIN carclassification c ON i.classificationId = c.classificationId
    WHERE i.classificationId = 1;

    7. Delete the Jeep Wrangler from the database.

    SELECT * FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler'; -- pull the ID

    DELETE FROM inventory WHERE invId = 1;

    8. Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage
    and invThumbnail columns using a single query.

    UPDATE inventory SET invImage=concat('/phpmotors',invImage), invThumbnail=concat('/phpmotors', invThumbnail);

II. Build a Database Connection File.

    1. Create a new folder called "library" in phpmotors.
    2. Create a new file called connections.php in "library".
    3. Create a PDO connection function called phpmotorsConnect() inside connections.php.

    <?php

    function phpmotorsConnect()
    {
      $server = 'localhost';
      $dbname = 'phpmotors';
      $username = 'iClient';
      $password = 'cxw*bfy8dwc0amj9XZQ';

      $dsn = "mysql:host=$server;dbname=$dbname";
      $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

      try {
        return new PDO($dsn, $username, $password, $options);
      } catch (PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
      }
    }

    4. Create a folder called "view" in phpmotors.
    5. Create a file called 500.php in "view".
    6. Move your template.php into the "view" folder. Copy your template.php content into 500.php and replace the <main> content with appropriate message.

    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>Content Title | PHP Motors</title>
        <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
      <body>
        <div id="wrapper">
          <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
          </header>
          <nav>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>
          </nav>
          <main>
            <h1>Server Error</h1>
            <div id="server-error">Sorry our server seems to be experiencing some technical difficulties.</div>
          </main>
          <hr>
          <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
          </footer>
        </div>
      </body>
    </html>

    7. Add a CSS style for the server-error message.

    main div#server-error {
      margin-left: 1em;
    }

    8. Open up http://localhost/phpmotors/view/500.php for a sanity check.
    9. Add the following to your home.php file, at the top.

    <?php
      require_once('library/connections.php');
      // test redirect if fails
      phpmotorsConnect();
    ?>

    10. Change your password in connections.php to something that isn't right.
    11. Open up http://localhost/phpmotors/home.php, it should redirect you to http://localhost/phpmotors/view/500.php.
    12. Change your password back to the correct one and hit http://localhost/phpmotors/home.php again.

