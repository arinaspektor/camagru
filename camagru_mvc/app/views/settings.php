	<form id="settings" action="edit" method="post">
			<div class="centered">

				<div class="ava">
					<img src="<?php echo IMAGES_PATH . '/pikachu_ava.svg';?>" width="85em" height="85em"/>
				</div>

				<a class="edit-link get-photo" onclick="openForm()">Edit photo</a>

				<div class="put-data">

						<?php if (!empty($view_data['user']->errors)) { ?>
						<div class="errors">
							<p>Errors: </p>
							<ul >
								<?php foreach ($view_data['user']->errors as $error) {
									echo "<li>" . $error . "</li>";
								}?>
							</ul>
						</div>
						<?php };?>

					<input class="focus-input" type="text" name="username" autofocus value="<?php echo htmlentities($view_data['user']->username) ?? '';?>" placeholder="Username" minlength="6" maxlength="20" />
					<input class="focus-input" type="email" name="user_email" autofocus value="<?php echo $view_data['user']->user_email ?? '';?>" placeholder="Email" />
					<input class="focus-input" type="password" name="passwd"  value="" placeholder="Password" minlength="8" maxlength="20" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$" title="Must contain at least one number, one uppercase and lowercase letter, 8-20 characters long"/>
					<input class="focus-input" type="password" name="dup_passwd" value="" placeholder="Confirm password" />

					<label>
						<input type="checkbox" name="email_notes" checked="checked">
					I want to receive email notifications about comments</label>
				</div>
			</div>
			<input type="submit" name="btn-edit" value="Save">
			<a href="profile">Cancel</a>

		</form>

		<div class="layer"></div>
		<form class="upload_photo" action="upload_ava" method="post" enctype="multipart/form-data">
			<input type="file" name="ava" required>
			<button type="submit" name="submit">Upload</button>
			<a href="<?php echo WWW_ROOT . '/settings'; ?>">Cancel</a>
		</form>
