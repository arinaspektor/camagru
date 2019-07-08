<div class="top">
    <div class="ava">
        <img src="<?php echo IMAGES_PATH . '/pikachu_ava.svg';?>" width="75em" height="75em"/>
    </div>
    <h3><?php echo htmlentities($view_data['user']->username) . "'s"; ?> space</h3>
    <a class="edit-link" href="<?php echo WWW_ROOT . '/settings'; ?>">Edit profile</a>
</div>
<div id="camera_wrapper">



</div>

<a class="edit-link get-photo" onclick="openForm()">Upload photo</a>

<div class="layer"></div>
<form class="upload_photo" action="upload" method="post" enctype="multipart/form-data">
		<input type="file" name="uploaded">
        <button type="submit" name="submit">Upload</button>
        <a href="<?php echo WWW_ROOT . '/profile'; ?>">Cancel</a>
</form>
