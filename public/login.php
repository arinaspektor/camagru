
<?php

	require_once('../private/initialize.php');
	
	// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 	$username = $_POST['username'] ?? '';
  	// 	$password = $_POST['password'] ?? '';
	// }
?>

<?php $page_title = 'Sign in'; ?>

<?php include('../private/shared/header.php'); ?>

<link rel="stylesheet" href="styles/forms.css">
<main>
	<form id="login" action="" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign in & have fun!</h3>
			<div class="put-data">
				<input class="focus-input" type="text" name="username" value="" placeholder="Username / E-mail" required>
				<div class="passwd">
					<input class="focus-input" type="password" name="passwd" value="" placeholder="Password" required>
					<a href="#">Forget your password?</a>
				</div>
				<input type="submit" value="Go!">
			</div>
		</div>
		<p>Don't have an account? <a href="<?php echo 'signup'; ?>">Sign up here</a></p>
	</form>
</main>

<?php include('../private/shared/footer.php'); ?>
