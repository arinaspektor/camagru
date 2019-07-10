<section class="top">

    <div class="ava" style="background-image: url('<?php echo $view_data['user']->profile_img_src; ?>');"></div>
    
    <h3><?php echo htmlentities($view_data['user']->username) . "'s"; ?> space</h3>
    
    <a class="edit-link" href="<?php echo WWW_ROOT . '/settings'; ?>">Edit profile</a>
</section>
<section class="snap_container">
<!-- <a class="edit-link get-photo" onclick="openForm()">Upload photo</a> -->
    <div class="camera_wrapper">
        <video id="video"></video>
        <div class="images"></div>
    </div>
    <aside></aside>
</section>

<div class="layer"></div>
<form class="upload_photo" action="upload" method="post" enctype="multipart/form-data">
		<input type="file" name="uploaded" required>
        <button type="submit" name="submit">Upload</button>
        <a href="<?php echo WWW_ROOT . '/profile'; ?>">Cancel</a>
</form>
