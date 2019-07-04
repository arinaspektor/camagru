<div class="message">
    <img src="<?php echo IMAGES_PATH . '/success.svg'; ?>" width="15%">
    <h3><?php if ($view_data['page_title'] === 'Sign up') { echo "Registration ";} ?>success</h3>
    <div>
        <p>Thank you! We have sent you email to <?php echo $_SESSION['user_email']; ?>.</p>
        <p>Please click the link in that massage to
          <?php if (isset($view_data['text'])) { echo $view_data['text']; } else {echo "activate your account";} ?>.</p>
    </div>
</div>
