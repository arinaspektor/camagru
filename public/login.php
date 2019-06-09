
<?php

	require_once('../private/initialize.php');

	// if($user->is_loggedin() != "")
	// {
 	// 	$user->redirect('index.php');
	// }

	if (isset($_POST['btn-signin'])) {
		if ($user->login($_POST['username'], $_POST['passwd'])) {
			redirect(WWW_ROOT . '/index');
		} else {
			echo 'Invalid data!';
		}
	}
	// else if ($user->is_loggedin()) {
	// 	$user->logout();
	// 	redirect(WWW_ROOT . '/index');
	// }
	// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 	$username = $_POST['username'] ?? '';
  	// 	$password = $_POST['password'] ?? '';
	// }
?>

<?php $page_title = 'Sign in'; ?>

<?php include('../private/shared/public_header.php'); ?>

<link rel="stylesheet" href="styles/forms.css">
<main>
	<form id="login" action="" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign in & have fun!</h3>
			<div class="put-data">
				<input class="focus-input" type="text" name="username" value="" placeholder="Username" required>
				<div class="passwd">
					<input class="focus-input" type="password" name="passwd" value="" placeholder="Password" required>
					<a href="#">Forget your password?</a>
				</div>
				<input type="submit" name="btn-signin" value="Go!">
			</div>
		</div>
		<p>Don't have an account? <a href="<?php echo 'signup'; ?>">Sign up here</a></p>
	</form>
</main>

<?php include('../private/shared/footer.php'); ?>
