<?php
if ($_SESSION['loggedin'] != TRUE) {
	header("Location: /phpmotors7/");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Client Admin | PHP Motors</title>
	<link href="/phpmotors7/css/style.css" type="text/css" rel="stylesheet" media="screen">
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
			<h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
			<p>You are logged in.</p>
			<?php
			if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
			}
			unset($_SESSION['message']);
			?>
			<ul>
				<li>First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
				<li>Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
				<li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
				
			</ul>
			<section>
				<h2 class="margin1">Account Management</h2>
				<p class="margin1">Use this link to update account information.</p>
				<p class="margin1"><a href="/phpmotors7/accounts/?action=update">Update Account Information</a></p>
			</section>
			<?php
			if ($_SESSION['clientData']['clientLevel'] > 1) {
			?>
			<h2 class="margin1">Inventory Management</h2>
				<p class="margin1">Use this link to manage the inventory.</p>
				<p class="margin1"><a href="/phpmotors7/vehicles/">Vehicle Management</a></p>
			<?php
			}
			?>

		</main>
		<hr>
		<footer>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors7/common/footer.php'; ?>
		</footer>
	</div>
</body>

</html>
<?php
unset($_SESSION['message']);
unset($_SESSION['message2']);
?>