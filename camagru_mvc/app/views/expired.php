<div class="message">
    <h3>Fail</h3>
    <div>
        <p>This link is invalid or expired.</p>
        <p>Please click

        <?php if ($view_data['page_title'] === 'Reset') {?>
            <a href="<?php echo WWW_ROOT . '/forgot'; ?>">here</a> if you want to reset your password
        <?php } else {?>
            <a href="<?php echo WWW_ROOT . '/requestConfirm'; ?>">here</a> if you need to confirm your account
        <?php }; ?>
        
        .</p>
    </div>
</div>
