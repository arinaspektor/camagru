<style>
    ::-webkit-scrollbar {
        display: none;
    }
</style>

<?php
    if (! empty($view_data['posts'])) { ?>
       
    <div class="feed-container">
       <?php foreach ($view_data['posts'] as $post) { ?>
            <article class='post'>
                <header> <?php echo $post['author']?> </header>
                <img src=" <?php echo  POSTS_WWW_PATH . '/' .  $post['user_id'] . '/' . $post['filename']?> " alt="">
                <div class="wrapper">
                    <div class="likes">
                        <img src="<?php echo IMAGES_PATH . '/heart.svg'?>" alt="" width="15em" height="15em" <?php if (isset($_SESSION['user_id'])) {?> onclick="addLike()"<?php }?>>
                        <p>22</p>
                    </div>
                    <div class="comments">
                        <p><span></span></p>
                    </div>

                    <?php if (isset($_SESSION['user_id'])) {?>
                        <form id="add-comment" method='post' onsubmit="addComment(event, this)">
                                <textarea name="" id="" cols="" rows="2" placeholder='Add a comment...' maxlength='200' required
                                ></textarea>
                                <button type="submit">Post</button>
                        </form>
                    <?php }?>
                </div>
            </article>
<?php } ?>
    </div>

<?php } else {
        echo "There is no posts yet...";
    }
?>