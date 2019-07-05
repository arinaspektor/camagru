<div class="top">
    <div class="ava">
        <img src="<?php echo IMAGES_PATH . '/pikachu_ava.svg';?>" width="90em" height="90em"/>
    </div>
    <h3><?php echo htmlentities($view_data['user']->username) . "'s"; ?> space</h3>
    <a class="edit-link" href="<?php echo WWW_ROOT . '/settings'; ?>">Edit profile</a>
</div>