<?php
if (post_password_required($post)) {
?>
    <section class="full-width-section common-padding">
        <div class="full-width-wysiwyg">
            <div class="container">
                <div class="editor-design text-center">
                    <?php echo get_the_password_form(); ?>
                </div>
            </div>
        </div>
    </section>
<?php
    get_footer();
    die();
}
?>