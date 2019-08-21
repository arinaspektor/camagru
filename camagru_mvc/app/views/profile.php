<div class="top">

    <div class="ava" style="background-image: url('<?php echo $view_data['user']->profile_img_src; ?>');"></div>

    <h3><?php echo htmlentities($view_data['user']->username) . "'s"; ?> space</h3>

    <a class="edit-link" href="<?php echo WWW_ROOT . '/settings'; ?>">Edit profile</a>
</div>

<section class="camagru">
    <div class="post-container">
        <div class="post">
            <header><?php echo htmlentities($view_data['user']->username)?>
                <span class="del" onclick="deletePost()"></span>
            </header>
            
            <img src="" alt="">
            <div class="wrapper">
                <div class="likes">
                    <img src="<?php echo IMAGES_PATH . '/unliked.svg'?>" alt="" width="15em" height="15em" onclick="addLike(this)">
                    <p></p>
                </div>
                <div class="comments">
                </div>
                <form id="add-comment" method='post' onsubmit="addComment(event, this)" >
                        <textarea name="" id="" cols="" rows="2" placeholder='Add a comment...' maxlength='200' required
                ></textarea>
                        <button type="submit">Post</button>
                </form>
            </div>
        </div>
    </div>
    <div class="snap_container">
        <div class="camera_wrapper">
            <video id="video" autoplay="true">
                Unfortunetly, your browser doesn't support video.
                You can upload your image.
            </video>
            <div class="img-container">
                <img class="uploaded" src="">
            </div>
            <div class="button-container">
                <button class="video-on" onclick="changeMode(this)"></button>
                <button class="take-photo" onclick="takePhoto()"><div class="circle"></div></button>
                <button class="upload-picture" onclick="openForm()"></button>
            </div>
        </div>
        <div class="images">

            <?php foreach ($view_data['masks'] as $src) {?>
                <div class="wrapper">
                    <img src="<?php echo $src?>" onclick="createMask(this)">
                </div>
            <?php }?>

        </div>
    </div>

    <aside>
        <div class="photos">

            <?php if (isset($view_data['posts'])) {
                    foreach ($view_data['posts'] as $post) {?>
                        <img src="<?php echo $post['src']; ?>" onclick="viewPost(this, <?php echo $post['id']; ?>)"> 
            <?php   }
                  };?>

        </div>
        <footer></footer>
    </aside>
    
</section>

<div class="layer"></div>
<form class="upload_photo" method="post" enctype="multipart/form-data" action="javascript:;" onsubmit="uploadPhoto(event)">
        <span class="close" onclick="closeForm(this)"></span>
		<input type="file" name="uploaded" required onchange="validateFile(event)">
        <button type="submit" name="submit">Upload</button>
</form>
 