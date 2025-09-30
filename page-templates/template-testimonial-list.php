<?php

/**
 * Template Name: Testimonial List
 *
 * Template to display listing of team members page
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
// include get_template_directory() . '/inc/password-check.php';
get_header();

get_template_part('global-templates/inner-banner');

if (function_exists('get_field')):

    $testimonial_list_testimonials = get_field('testimonial_list_testimonials');
    if (!empty($testimonial_list_testimonials)) {
?>

        <section id="content" class="testimonial-list testimonial-all-list comman-margin">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($testimonial_list_testimonials as $testimonial) {
                        $reviewer_image = get_field('reviewer_image', $testimonial);
                        $reviewer_name = get_field('reviewer_name', $testimonial);
                        $reviewer_designation = get_field('reviewer_designation', $testimonial);
                        $review_content = get_field('review_content', $testimonial);
                        $rating_count = get_field('rating_count', $testimonial);
                        $reviewer_button = get_field('reviewer_button', $testimonial);
                    ?>
                        <div class="col col-12 col-md-4">
                            <div class="our-word">
                                <a href="<?php echo get_permalink($testimonial); ?>" class="card-wrap text-decoration-none d-block">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" class="img-fluid quote-img" alt="<?php echo $testimonial->post_title; ?>">

                                    <?php if (!empty($rating_count)) { ?>
                                        <div class="star-wrap">
                                            <?php luca_star_rating($rating_count); ?>
                                        </div>
                                    <?php }

                                    if (!empty($review_content)) { ?>
                                        <div class="client-word-wrap">
                                            <p><?php echo $review_content; ?></p>
                                        </div>
                                    <?php } ?>

                                    <div class="client-details">
                                        <?php if (!empty($reviewer_image)) { ?>
                                            <div class="icon-wrap">
                                                <img src="<?php echo $reviewer_image; ?>" alt="<?php echo $reviewer_name; ?>">
                                            </div>
                                        <?php } ?>

                                        <div class="client-content">
                                            <?php if (!empty($reviewer_designation)) { ?>
                                                <span><?php echo $reviewer_designation; ?></span>
                                            <?php }

                                            if (!empty($reviewer_name)) { ?>
                                                <h5><?php echo $reviewer_name; ?></h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>

                                <a href="<?php echo get_permalink($testimonial); ?>" class="btn center-btn"> <?php _e('Read More', 'radius-theme'); ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </section>
<?php
    }
endif;
get_footer();
?>