<?php
if ($_SESSION['loggedin'] != TRUE || $_SESSION['clientData']['clientLevel'] < 2) {
	header("Location: ../");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>
		<?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
			echo "Delete $invInfo[invMake] $invInfo[invModel]";
		}
		?>
	</title>
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
			<h1 class="account-heading">
				<?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
					echo "Delete $invInfo[invMake] $invInfo[invModel]";
				}
				?>
			</h1>
			<?php
			if (isset($message)) {
				echo $message;
			}
			?>
			<p class="center red">Confirm Vehicle Deletion. The delete is permanent.</p>
			<form action="/phpmotors9/vehicles/" method="post">
			<fieldset>
				<label for="invMake">Make</label><br>
				<input type="text" name="invMake" id="invMake" readonly 
				<?php if (isset($invInfo['invMake'])) {
				echo "value='$invInfo[invMake]'"; }?>><br>

				<label for="invModel">Model</label><br>
				<input type="text" name="invModel" id="invModel" readonly <?php if (isset($invInfo['invModel'])) { echo "value='$invInfo[invModel]'"; }?>><br>

				<label for="invDescription">Description</label><br>
				<textarea id="invDescription" name="invDescription" readonly><?php if (isset($invInfo['invDescription'])) {
				echo $invInfo['invDescription']; } ?></textarea>
				<br><br>

				<input type="submit" value="Delete Vehicle">
				<input type="hidden" name="action" value="deleteVehicle">
				<input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {echo $invInfo['invId'];} ?>">
				</fieldset>
			</form>
			<hr>
		</main>

		<footer>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors9/common/footer.php'; ?>
		</footer>
	</div>
</body>

</html>