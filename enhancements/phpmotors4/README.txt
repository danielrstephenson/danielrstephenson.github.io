I. Level the phpmotors database.
    1. Download the phpmotors SQL file - https://blainerobertson.github.io/340br/phpmotors/downloads/phpmotors-db.sql.zip.
    2. Unzip the file inside the sql folder.
    3. Import the SQL file into the phpmotors database.
II. Create the Accounts Model.
    1. Create a regClient() function with the following content:

    <?php
    function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
    {
      // Create a connection object using the phpmotors connection function
      $db = phpmotorsConnect();
      // The SQL statement
      $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
                 VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
      // Create the prepared statement using the phpmotors connection
      $stmt = $db->prepare($sql);
      // The next four lines replace the placeholders in the SQL
      // statement with the actual values in the variables
      // and tells the database the type of data it is
      $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
      $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
      $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
      $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
      // Insert the data
      $stmt->execute();
      // Ask how many rows changed as a result of our insert
      $rowsChanged = $stmt->rowCount();
      // Close the database interaction
      $stmt->closeCursor();
      // Return the indication of success (rows changed)
      return $rowsChanged;
    }

III. Update the registration form.
    1. Open up registration.php and add/update the following action input:

    <input type="hidden" name="action" value="register">

    2. Prepare for errors, add the following above the form tag:

    <?php
    if (isset($message)) {
     echo $message;
    }
    ?>

IV. Finalize the accounts controller to handle registration.
    1. Require the accounts-model.php file.

    require_once '../model/accounts-model.php';

    2. Add the following case statement:

    case 'register':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
    $clientLastname = filter_input(INPUT_POST, 'clientLastname');
    $clientEmail = filter_input(INPUT_POST, 'clientEmail');
    $clientPassword = filter_input(INPUT_POST, 'clientPassword');

    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      $message = '<p>Please provide information for all empty form fields.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/registration.php";
      exit;
    }

    if (regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) === 1) {
      $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/login.php";
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/view/registration.php";
    }
    exit;

    3. Test that you can register someone.

V. Create the Vehicles controller.
    1. Create a new folder inside phpmotors called vehicles.
    2. Create a new controller inside the vehicles folder.

    <?php
    require_once '../library/connections.php';
    require_once '../model/main-model.php';

    // Get the array of classifications
    $classifications = getClassifications();

    // Build a navigation bar using the $classifications array
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
      $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName="
        . urlencode($classification['classificationName']) .
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
      $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
      default:
        break;
    }

    3. Test that the new vehicles controller is working without errors (should see a blank page).

VI. Create the vehicles model.
    1. In the model folder, create vehicles-model.php.
    2. Require this in the vehicles controller file.

    require_once '../model/vehicles-model.php';

    3. Test that the vehicles controller still works.
    4. Add function to add a classification.

    <?php
    function insertNewClassification($classificationName)
    {
      $db = phpmotorsConnect();
      $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
      $stmt->execute();
      $rowsChanged = $stmt->rowCount();
      $stmt->closeCursor();
      return $rowsChanged;
    }

    5. Add function add a vehicle.

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
    {
      $db = phpmotorsConnect();

      $sql = 'INSERT INTO inventory '
        . '(invMake, invModel, invDescription, invImage, invThumbnail, '
        . 'invPrice, invStock, invColor, classificationID) '
        . 'VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, '
        . ':invPrice, :invStock, :invColor, :classificationId);';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
      $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
      $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
      $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
      $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
      $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
      $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
      $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
      $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
      $stmt->execute();
      $rowsChanged = $stmt->rowCount();
      $stmt->closeCursor();
      return $rowsChanged;
    }

VII. Create the vehicle management page.
    1. Create a file called vehicle-man.php in the view folder with the following content:

    <!DOCTYPE html>
    <html lang="en">

      <head>
        <meta charset="UTF-8">
        <title>Vehicle Management | PHP Motors</title>
        <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>

      <body>
        <div id="wrapper">
          <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
          </header>
          <nav>
            <?php echo $navList; ?>
          </nav>
          <main>
            <h1>Vehicle Management</h1>
            <ul>
              <li><a href="/phpmotors/vehicles/?action=class-page">Add Classification</a></li>
              <li><a href="/phpmotors/vehicles/?action=vehicle-page">Add Vehicle</a></li>
            </ul>


            <hr>
          </main>
          <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
          </footer>
        </div>
      </body>

    </html>

    2. Update the default case statement in the controller to pull in this page.

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';

    3. Test the vehicles page.

VIII. Create the add classification page.
    1. Add a new page called add-classification.php to the view folder with the following content:

    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>New Classification | PHP Motors</title>
        <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
      <body>
        <div id="wrapper">
          <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
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
            <form action="/phpmotors/vehicles/" method="post">
              <label for="carClassification">Classification Name</label><br>
              <input type="text" name="carClassification" id="carClassification" required><br>
              <input type="submit" value="Add Classification">
              <input type="hidden" name="action" value="add-class">
            </form>
            <hr>
          </main>
          <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
          </footer>
        </div>
      </body>
    </html>

    2. Add a case statement to pull this page in.

    case 'class-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;

    3. Test that the page pulls in when clicking the link.
    4. Add the case statement to handle inserting the data into the classification table.

    case 'add-class':
        // Filter and store the data
        $carClassification = filter_input(INPUT_POST, 'carClassification', FILTER_SANITIZE_STRING);

        //check data
        if (empty($carClassification)) {
          $message = '<p class="center">Please provide information for all empty form fields.</p>';
          include '../view/add-classification.php';
          exit;
        }

        if (insertNewClassification($carClassification)) {
          header('Location: /phpmotors/vehicles/');
        } else {
          $message = '<p class="center">An error occured while adding the new classification to the database, please try again later.</p>';
          include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
          exit;
        }

        break;

    5. Test that you can insert a new classification.

IX. Create the add vehicle page.