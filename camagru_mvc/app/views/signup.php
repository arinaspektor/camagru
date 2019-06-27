	<form id="signup" action="create" method="post" autocomplete="on">
		<div class="centered">
			<h3>sign up & have fun!</h3>

			<div class="put-data">

				<?php if (isset($view_data['user']->errors)) { ?>
				<div class="errors">
					<p>Errors: </p>
					<ul >
						<?php foreach ($view_data['user']->errors as $error) {
							echo "<li>" . $error . "</li>";
						}?>
					</ul>
				</div>
				<?php };?>

				<input class="focus-input" type="text" name="username" autofocus value="<?php echo $view_data['user']->username ?? '';?>" placeholder="Username" minlength="6" maxlength="20" required  />
				<input class="focus-input" type="email" name="uemail" autofocus value="<?php echo $view_data['user']->uemail ?? '';?>" placeholder="Email" required />
				<input class="focus-input" type="password" name="passwd"  value="" placeholder="Password" minlength="8" maxlength="20" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="Must contain at least one number, one uppercase and lowercase letter, 8-20 characters long" required />
				<input class="focus-input" type="password" name="dup_passwd" value="" placeholder="Confirm password" required />
			</div>
			<input type="submit" name="btn-signup" value="Go!">
		</div>
	</form>
