<link rel="stylesheet" href=" <?php echo STYLES_PATH . '/forms.css'; ?> " >

	<form id="signup" action="create" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign up & have fun!</h3>
			<div class="put-data">
				<input class="focus-input" type="text" name="username" value="" placeholder="Username" required minlength="6" maxlength="20">
				<input class="focus-input" type="email" name="uemail" value="" placeholder="Email" required>
				<input class="focus-input" type="password" name="passwd" value="" placeholder="Password" required minlength="8" maxlength="20">
				<input class="focus-input" type="password" name="dup_passwd" value="" placeholder="Confirm password" required>
			</div>
			<input type="submit" name="btn-signup" value="Go!">
		</div>
	</form>
