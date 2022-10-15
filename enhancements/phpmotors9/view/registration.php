<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Account Registration | PHP Motors</title>
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
   <h1 class="account-heading">Register</h1>
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   <form action="/phpmotors9/accounts/index.php" method="post">
    <label for="clientFirstname">First Name</label>
    <input type="text" name="clientFirstname" id="clientFirstname" required <?php  if (isset($clientFirstname)) { echo "value='$clientFirstname'"; } ?>>
    <label for="clientLastname">Last Name</label>
    <input type="text" name="clientLastname" id="clientLastname" required <?php if (isset($clientLastname)) { echo "value='$clientLastname'"; } ?>>
    <label for="clientEmail">Email</label>
    <input type="email" name="clientEmail" id="clientEmail" required <?php if (isset($clientEmail)) { echo "value='$clientEmail'"; } ?>>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
    <label for="clientPassword">Password</label>
    <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
    <input type="submit" value="Register">
    <input type="hidden" name="action" value="register">
   </form>
  </main>
  <hr>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>