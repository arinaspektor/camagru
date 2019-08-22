<?php include (ROOT . '/app/views/header.php'); ?>

<main>

    <?php if (isset($view_data['flash'])) { ?>
        <div class="alert">
            <?php echo $view_data['flash']; ?>
        </div>
    <?php }; ?>

    <?php include(ROOT . '/app/views/' . $content_view); ?>

</main>

<?php include (ROOT . '/app/views/footer.php'); ?>