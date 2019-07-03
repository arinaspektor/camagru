
<form id="reset" method="post" action="reset">
    <h3>Reset password</h3>
    <input class="focus-input" type="email" name="uemail" autofocus value='' placeholder="Email" required>

    <?php if (isset($view_data['error'])) { ?>
		<p class="error">Invalid email</p>
	<?php };?>

    <button type="submit">Reset my password</button>
</form>
