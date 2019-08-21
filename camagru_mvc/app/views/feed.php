<!-- <style>
    ::-webkit-scrollbar {
        display: none;
    }
</style> -->

<?php
    if (! empty($view_data['posts'])) { ?>
       
    <div class="feed-container">
       <?php foreach ($view_data['posts'] as $post) { ?>
            <article class='post' id="<?php echo $post['post_id']?>">
                <header> <?php echo htmlentities($post['author'])?> </header>
                <img src=" <?php echo  POSTS_WWW_PATH . '/' .  $post['user_id'] . '/' . $post['filename']?> " alt="">
                <div class="wrapper">

                    <div class="likes">
                        <img id="like" width="15em" height="15em" src="<?php echo IMAGES_PATH . ($post['liked'] ? '/liked.svg' : '/unliked.svg');?>" <?php if (isset($_SESSION['user_id'])) {?> onclick="addLike(this)"<?php }?>>
                        <p><?php echo $post['likes'];?></p>
                    </div>

                    <div class="comments">
                        <?php if (isset($post['comments'])) {
                            foreach ($post['comments'] as $comment) { ?>
                            <p><span> <?php echo  htmlentities($comment['author']) ?></span>
                                <?php echo  htmlentities($comment['text']) ?></p>
                        <?php }
                            } ?>
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