<form id="reset" method="post" action="">
    <h3>Reset password</h3>
    <input class="focus-input" type="password" name="passwd"  value="" placeholder="New password" minlength="8" maxlength="20" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="Must contain at least one number, one uppercase and lowercase letter, 8-20 characters long" required />
	<input class="focus-input" type="password" name="dup_passwd" value="" placeholder="Confirm password" required />

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

    <button type="submit">Reset my password</button>
</form>
