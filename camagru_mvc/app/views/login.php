<link rel="stylesheet" href=" <?php echo STYLES_PATH . '/forms.css'; ?> " >

	<form id="login" action="login" method="post" autocomplete="on">
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

