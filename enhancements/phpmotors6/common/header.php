<div id="top-header">
  <img src="/phpmotors6/images/site/logo.png" alt="PHP Motors logo" id="logo">
  <?php
  if (isset($cookieFirstname)) {
    echo "<span id='cookie'>Welcome, $cookieFirstname</span>";
  }
  if (isset($_SESSION['loggedin'])) {
    ?>
    <span id='cookie'>Welcome, $cookieFirstname</span>
    <a href="/phpmotors6/accounts/?action=logout" class="acc">Logout</a>
  <?php } else { ?>
    <a href="/phpmotors6/accounts?action=deliverLoginView" title="Login or Register with PHP Motors" id="acc">My
      Account</a>
  <?php } ?>
</div>