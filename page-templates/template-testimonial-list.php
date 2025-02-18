<?php
/**
* Template Name: Testimonial List
*
* Template to display listing of team members page
*
* @package Understrap
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
include get_template_directory() . '/inc/password-check.php';
get_header();

get_template_part('global-templates/inner-banner');

$testimonial_list_testimonials = get_field('testimonial_list_testimonials');

if( !empty($testimonial_list_testimonials) ){

    $testimonial_list_testimonials_arr = array_chunk($testimonial_list_testimonials, 3); ?>

    <section class="testimonial-list testimonial-all-list comman-margin">   
        <div class="container">
            <div class="row"> 
                <?php foreach( $testimonial_list_testimonials_arr as $testimonial_list_testimonial_chunk ){ ?>

                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <?php foreach( $testimonial_list_testimonial_chunk as $testimonial_list_testimonial ){

                            $reviewer_image = get_field('reviewer_image', $testimonial_list_testimonial);
                            $reviewer_name = get_field('reviewer_name', $testimonial_list_testimonial);
                            $reviewer_designation = get_field('reviewer_designation', $testimonial_list_testimonial);
                            $review_content = get_field('review_content', $testimonial_list_testimonial);
                            $rating_count = get_field('rating_count', $testimonial_list_testimonial);
                            $reviewer_button = get_field('reviewer_button', $testimonial_list_testimonial);
                            ?>

                            <div class="our-word">
                                <a href="<?php echo get_permalink($testimonial_list_testimonial); ?>" class="card-wrap text-decoration-none d-block">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" class="img-fluid quote-img" alt="<?php echo $testimonial_list_testimonial->post_title; ?>">                    
                                        
                                    <?php if( !empty($rating_count) ){ ?>

                                        <div class="star-wrap">
                                            <?php luca_star_rating($rating_count); ?>
                                        </div>
                                    <?php }

                                    if( !empty($review_content) ){ ?>

                                        <div class="client-word-wrap"><p><?php echo $review_content; ?></p></div>
                                    <?php } ?>

                                    <div class="client-details">
                                        <?php if( !empty($reviewer_image) ){ ?>

                                            <div class="icon-wrap">
                                                <img src="<?php echo $reviewer_image; ?>" alt="<?php echo $reviewer_name; ?>">
                                            </div>
                                        <?php } ?>

                                        <div class="client-content">
                                            <?php if( !empty($reviewer_designation) ){ ?>

                                                <span><?php echo $reviewer_designation; ?></span>
                                            <?php }

                                            if( !empty($reviewer_name) ){ ?>

                                                <h5><?php echo $reviewer_name; ?></h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a> 

                                <a href="<?php echo get_permalink($testimonial_list_testimonial); ?>" class="btn center-btn">Read More<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>                                           
            </div>       
        </div>
    </section>
<?php }

get_footer(); ?>