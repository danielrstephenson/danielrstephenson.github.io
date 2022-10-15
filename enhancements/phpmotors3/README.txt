ACTIVITIES
----------
I. MVC Overview
  1. Create a new "model" folder within the phpmotors folder.
  2. Move the "home.php" file inside the "view" folder (the same place as your 500.php and template.php files).
  3. Create a new PHP file called index.php in your phpmotors folder.

  <?php
    $action = filter_input(INPUT_POST, 'action');
    if ($action === null) {
      $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
      default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
        break;
    }

  4. Open up your browser and hit http://localhost/phpmotors to make your home page still loads properly.

II. Build Dynamic Site Navigation.
    1. Create main-model.php inside this model folder with the following code:

    <?php
    function getClassifications(): bool|array
    {
      // Create a connection object from the phpmotors connection function
      $db = phpmotorsConnect();
      // The SQL statement to be used with the database
      $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName';
      // The next line creates the prepared statement using the phpmotors connection
      $stmt = $db->prepare($sql);
      // The next line runs the prepared statement
      $stmt->execute();
      // The next line gets the data from the database and
      // stores it as an array in the $classifications variable
      $classifications = $stmt->fetchAll();
      // The next line closes the interaction with the database
      $stmt->closeCursor();
      // The next line sends the array of data back to where the function
      // was called (this should be the controller)
      return $classifications;
    }

    2. Add the following to the top of your index.php file:

    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

    $classifications = getClassifications();

    3. Create the HTML navigation from the dynamic classifications in the index.php file:

    $navList = '<ul>';
    $navList .= '<li><a href="/phpmotors/index.php" title="View the PHP Motors home page">Home</a></li>';
    foreach ($classifications as $classification) {
      $navList .= '<li><a href="/phpmotors/index.php?action=' . urlencode($classification['classificationName']) . '" title="View our ' . $classification['classificationName'] . ' product line">' . $classification['classificationName'] . '</a></li>';
    }
    $navList .= '</ul>';

    4. Add the $navList to your home.php and template.php files:

    Change this  <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php'; ?>

    to this <?php echo $navList ?>

III. Create the Accounts Folder and Controller.
    1. Create a new folder called accounts in the phpmotors folder.
    2. Create an index.php file with the following code:

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

    $classifications = getClassifications();

    $navList = '<ul>';
    $navList .= '<li><a href="/phpmotors/index.php" title="View the PHP Motors home page">Home</a></li>';
    foreach ($classifications as $classification) {
      $navList .= '<li><a href="/phpmotors/index.php?action=' . urlencode($classification['classificationName']) . '" title="View our ' . $classification['classificationName'] . ' product line">' . $classification['classificationName'] . '</a></li>';
    }
    $navList .= '</ul>';

    $action = filter_input(INPUT_POST, 'action');
    if ($action === null) {
      $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
      case '':

        break;
      default:

        break;
    }

IV. Build a login view.
    1. Create a login.php file inside of view, with the following code:

    <!DOCTYPE html>
    <html lang="en">

      <head>
        <meta charset="UTF-8">
        <title>Account Login | PHP Motors</title>
        <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

      </head>

      <body>
        <div id="wrapper">
          <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
          </header>
          <nav>
            <?php echo $navList ?>
          </nav>
          <main>
            <h1 class="account-heading">Sign in</h1>
            <?php
            if (isset($message)) {
              echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/">
              <label for="email">Email</label>
              <input type="text" id="email" name="clientEmail">
              <label for="password">Password</label>
              <input type="password" id="password" name="clientPassword">
              <input type="submit" value="Sign-in">
              <input type="hidden" name="action" value="Login">
              <a href="/phpmotors/accounts/?action=registration-page" id="toreg">Not a member yet?</a>
            </form>

          </main>
          <hr>
          <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
          </footer>
        </div>
      </body>

    </html>

    2. Create registration.php in the view folder with the following code:

    <!DOCTYPE html>
    <html lang="en">

      <head>
        <meta charset="UTF-8">
        <title>Account Registration | PHP Motors</title>
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
            <h1 class="account-heading">Register</h1>
            <form action="/phpmotors/accounts/index.php" method="post">
              <label for="clientFirstname">First Name</label>
              <input type="text" name="clientFirstname" id="clientFirstname">
              <label for="clientLastname">Last Name</label>
              <input type="text" name="clientLastname" id="clientLastname">
              <label for="clientEmail">Email</label>
              <input type="email" name="clientEmail" id="clientEmail">
              <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
              <label for="clientPassword">Password</label>
              <input type="password" name="clientPassword" id="clientPassword">
              <input type="submit" value="Register">
              <input type="hidden" name="action" value="deliverRegisterView">
            </form>
          </main>
          <hr>
          <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
          </footer>
        </div>
      </body>

    </html>

    3. Add a hyperlink to My Account that points at the /accounts controller in header.php.

    <a href="/phpmotors/accounts?action=login-page" title="Login or Register with PHP Motors" id="acc">My Account</a>

    4. Update the accounts controller to handle the login-page action and registration views.

    switch ($action) {
      case 'login-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;
      case 'registration-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;
      default:

        break;
    }




