<section class="camagru">
    
    <div class="snap_container">
        <div class="camera_wrapper">
            <video id="video" autoplay="true">
                Unfortunetly, your browser doesn't support video. Try another one...
            </video>
            <div class="button-container">
                <button class="take-photo" onclick="takePhoto()"><div class="circle"></div></button>
                <button class="upload-picture" onclick="openForm()"></button>
            </div>
        </div>
        <div class="images">
            <?php foreach ($view_data['masks'] as $src) {?>
                <div class="wrapper">
                    <img src="<?php echo $src?>">
                </div>
            <?php };?>
        </div>
    </div>

    <aside>
        <div class="top">

            <div class="ava" style="background-image: url('<?php echo $view_data['user']->profile_img_src; ?>');"></div>

            <h3><?php echo htmlentities($view_data['user']->username) . "'s"; ?> space</h3>

            <a class="edit-link" href="<?php echo WWW_ROOT . '/settings'; ?>">Edit profile</a>
        </div>
        <div class="photos">
            <?php foreach ($view_data['posts'] as $src) {?>
                <img src="<?php echo $src?>">
            <?php };?>
        </div>
        <footer></footer>
    </aside>
    
</section>

<div class="layer"></div>
<form class="upload_photo" action="upload" method="post" enctype="multipart/form-data">
        <span class="close" onclick="closeForm()"></span>
		<input type="file" name="uploaded" required>
        <button type="submit" name="submit">Upload</button>
</form>
