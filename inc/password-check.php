<?php
if (post_password_required($post)) {
    echo get_the_password_form();
    get_footer();
    die();
}
?>