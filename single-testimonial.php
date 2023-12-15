<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

get_template_part('global-templates/inner-banner');

$rating_count = get_field('rating_count');
$reviewer_designation = get_field('reviewer_designation');
$reviewer_name = get_field('reviewer_name');
?>

<section class="single-testimonial-banner comman-margin">
    <div class="container bg-img-position" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/testimonial-banner.png);">
        <div class="row align-items-center">
            <?php if( has_post_thumbnail() ){ ?>

                <div class="col-md-5">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid" alt="<?php echo $reviewer_name; ?>">
                </div>
            <?php } ?>

            <div class="col-md-12">
                <div class="col-md-12 our-word text-center mt-5 mt-md-0">
                    <div class="card-wrap text-decoration-none d-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" class="img-fluid quote-img" alt="<?php echo $reviewer_name; ?>">
                        
                        <div class="star-wrap">
                            <?php luca_star_rating($rating_count); ?>
                        </div>

                        <div class="client-word-full-wrap"><?php the_content(); ?></div>
                        
                        <div class="client-details">                            
                            <div class="client-content">
                                <?php if( !empty($reviewer_designation) ){ ?>

                                    <span><?php echo $reviewer_designation; ?></span>
                                <?php }

                                if( !empty($reviewer_name) ){ ?>

                                    <h5><?php echo $reviewer_name; ?></h5>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$other_testimonials_title = get_field('other_testimonials_title', 'options');
$other_testimonials = get_field('other_testimonials', 'options');
$other_testimonials_button = get_field('other_testimonials_button', 'options');

if( !empty($other_testimonials) ){ ?>

    <section class="testimonial-list testimonial-all-list single-testimonial comman-margin">
        <div class="container">
            <?php if( !empty($other_testimonials_title) ){ ?>

                <h3><?php echo $other_testimonials_title; ?></h3>
            <?php } ?>

            <div class="row g-5">

                <?php foreach( $other_testimonials as $other_testimonial ){

                    $reviewer_image = get_field('reviewer_image', $other_testimonial);
                    $reviewer_name = get_field('reviewer_name', $other_testimonial);
                    $reviewer_designation = get_field('reviewer_designation', $other_testimonial);
                    $review_content = get_field('review_content', $other_testimonial);
                    $rating_count = get_field('rating_count', $other_testimonial);
                    $reviewer_button = get_field('reviewer_button', $other_testimonial);
                    ?>

                    <div class="col-md-6 col-xl-4 our-word">
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
                    </div>
                <?php } ?>
            </div>

            <?php if( !empty($other_testimonials_button['url']) && !empty($other_testimonials_button['title']) ){ ?>

                <a href="<?php echo $other_testimonials_button['url']; ?>" class="btn center-btn" target="<?php echo $other_testimonials_button['target']; ?>"><?php echo $other_testimonials_button['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            <?php } ?>
        </div>
    </section>
<?php }

get_footer(); ?>