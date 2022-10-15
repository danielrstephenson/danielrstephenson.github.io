<div id="top-header">
 <img src="/phpmotors9/images/site/logo.png" alt="PHP Motors logo" id="logo">
 <?php
 if (isset($cookieFirstname)) {
  echo "<span id='cookie'>Welcome, $cookieFirstname</span>";
 }
 if (isset($_SESSION['loggedin'])) {
 ?>
 <a href="/phpmotors9/accounts/?action=logout" class="acc">Logout</a>
 <?php } else { ?>
 <a href="/phpmotors9/accounts?action=login-page" title="Login or Register with PHP Motors" id="acc">My Account</a>
 <?php } ?>
</div>