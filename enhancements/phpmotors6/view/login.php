<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Account Login | PHP Motors</title>
 <link href="/phpmotors6/css/style.css" type="text/css" rel="stylesheet" media="screen">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
</head>

<body>
 <div id="wrapper">
  <header>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors6/common/header.php'; ?>
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
   <form method="post" action="/phpmotors6/accounts/">
    <label for="email">Email</label>
    <input type="text" id="email" name="clientEmail" required <?php if (isset($clientEmail)) { echo "value='$clientEmail'";}  ?>>
    <label for="password">Password</label>
    <input type="password" id="password" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
    <input type="submit" value="Sign-in">
    <input type="hidden" name="action" value="Login">
    <a href="/phpmotors6/accounts/?action=deliverRegisterView" id="toreg">Not a member yet?</a>
   </form>

  </main>
  <hr>
  <footer>
   <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors6/common/footer.php'; ?>
  </footer>
 </div>
</body>

</html>