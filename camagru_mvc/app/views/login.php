	<form id="login" action="new" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign in & have fun!</h3>
			<div class="put-data">
				<input class="focus-input" type="email" name="uemail" autofocus value="<?php echo $view_data['uemail'] ?? '';?>" placeholder="Email" required>
				<div class="passwd">
					<input class="focus-input" type="password" name="passwd" value="" placeholder="Password"  minlength="8" maxlength="20" required>
					<a href="#">Forget your password?</a>
				</div>
				<input type="submit" name="btn-signin" value="Go!">
			</div>
		</div>
		<p>Don't have an account? <a href="<?php echo 'signup'; ?>">Sign up here</a></p>
	</form>


