<form id="reset" method="post" action="reConfirm">
    <h3>Confirm email</h3>
    <input class="focus-input" type="email" name="user_email" autofocus value='' placeholder="Email" required>

    <?php if (isset($view_data['error'])) { ?>
		<p class="error">Invalid email. You need to <a href="<?php echo WWW_ROOT . '/signup'; ?>">sign up</a> first</p>
	<?php };?>

    <button type="submit">Confirm my email</button>
</form>