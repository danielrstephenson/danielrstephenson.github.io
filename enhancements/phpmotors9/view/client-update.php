<?php
if (!$_SESSION['loggedin']) {
  header('Location: /phpmotors9/');
}

$fName = $_SESSION['clientData']['clientFirstname'];
$lName = $_SESSION['clientData']['clientLastname'];
$email = $_SESSION['clientData']['clientEmail'];
$id = $_SESSION['clientData']['clientId'];
?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Update Account Information</title>
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
          <h1>Update Account Information</h1>

          <h2>Update Account Info</h2>
          <?php
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          }
          unset($_SESSION['message']);
          ?>
          <form method="post" action="/phpmotors9/accounts/">
            <label for="clientFirstname">First Name</label><br>
            <input type="text" name="clientFirstname" id="clientFirstname" required
              <?php if (isset($fName)) {
                echo "value='$fName'";
              } else if (isset($clientFirstname)) {
                echo "value='$clientFirstname'";
              }
              ?>
            ><br>
            <label for="clientLastname">Last Name</label><br>
            <input type="text" name="clientLastname" id="clientLastname" required
              <?php if (isset($lName)) {
                echo "value='$lName'";
              } else if (isset($clientLastname)) {
                echo "value='$clientLastname'";
              } ?>
            ><br>
            <label for="clientEmail">Email</label><br>
            <input type="email" name="clientEmail" id="clientEmail" required
              <?php if (isset($email)) {
                echo "value='$email'";
              } else if (isset($clientEmail)) {
                echo "value='$clientEmail'";
              } ?>
            ><br>
            <input type="submit" value="Update Info">
            <input type="hidden" name="action" value="acct-update">
            <input type="hidden" name="clientId" value="<?php echo $id; ?>">
          </form>


          <h2>Update Password</h2>
          <?php
          if (isset($_SESSION['message2'])) {
            echo $_SESSION['message2'];
          }
          ?>
          <form method="post" action="/phpmotors9/accounts/">
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <p class="red">*note your original password will be changed.</p>
            <label for="clientPassword">Password</label><br>
            <input type="password" name="clientPassword" id="clientPassword"
                   pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
            <input type="submit" value="Update Password">
            <input type="hidden" name="action" value="pass-update">
            <input type="hidden" name="clientId" value="<?php echo $id; ?>">
          </form>

        </main>
        <hr>
        <footer>
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
        </footer>
      </div>
    </body>
  </html>
<?php
unset($_SESSION['message']);
unset($_SESSION['message2']);
?>