<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
get_template_part('global-templates/inner-banner');

$price_full_description = get_field('price_full_description');
$price = get_field('price');
$show_price_per_period = get_field('show_price_per_period');
$package_details_button_1 = get_field('package_details_button_1');
$package_details_button_2 = get_field('package_details_button_2');

?>
<section class="package-details-section comman-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/package-details.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-md-8">
                <div class="package-details-wrap">
                    <h2><?php the_title(); ?></h2>
                    <h5>$<?php echo $price; ?> per <?php echo $show_price_per_period; ?></h5>
                    <div class="editor-design">
                        <?php echo $price_full_description; ?>
                    </div>

                    <?php if( have_rows('price_features') ){ ?>
                        <ul>
                            <?php while( have_rows('price_features') ){
                                the_row();
                                $features = get_sub_field('features');
                                if( !empty($features) ){ ?>
                                    <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-icon.svg" alt=""> <span><?php echo $features; ?></span></li>
                                <?php }
                            } ?>
                        </ul> 
                    <?php } ?>

                    <div class="btn-group-wrap">
                        <?php if( !empty($package_details_button_1['url']) && !empty($package_details_button_1['title']) ){ ?>

                            <a href="<?php echo $package_details_button_1['url']; ?>" class="btn" target="<?php echo $package_details_button_1['target']; ?>"><?php echo $package_details_button_1['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                        <?php }

                        if( !empty($package_details_button_2['url']) && !empty($package_details_button_2['title']) ){ ?>
                        
                            <a href="<?php echo $package_details_button_2['url']; ?>" class="btn btn-outline-navyblue" target="<?php echo $package_details_button_2['target']; ?>"><?php echo $package_details_button_2['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                        <?php } ?>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$package_left_col_title = get_field('package_left_col_title', 'options');
$package_left_col_desc = get_field('package_left_col_desc', 'options');
$gravity_forms = get_field('package_gravity_forms', 'options');
$package_right_col_title = get_field('package_right_col_title', 'options');
$package_right_col_desc = get_field('package_right_col_desc', 'options');

$company_address = get_field('company_address', 'options');
$company_phone = get_field('company_phone', 'options');
$company_email = get_field('company_email', 'options');
?>
<section class="contact-section comman-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="default-content contact-info">
                    <?php if( !empty($package_left_col_title) ){ ?>

                        <h3><?php echo $package_left_col_title; ?></h3>
                    <?php }

                    echo $package_left_col_desc; ?>
                    <ul>
                        <?php if( !empty($company_address) ){ ?>

                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/location-pin.svg">
                                <span><?php echo $company_address; ?></span>
                            </li>
                        <?php }

                        if( !empty($company_phone) ){ ?>
                        
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Phone.svg">
                                <span><?php echo $company_phone; ?></span>
                            </li>
                        <?php }

                        if( !empty($company_email) ){ ?>

                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Email.svg">
                                <span><?php echo $company_email; ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <?php if( !empty($gravity_forms) ){ ?>

                    <div class="default-content contact-form">
                        <h3>Contact Form</h3>
                        <?php echo do_shortcode('[gravityform id="'. $gravity_forms .'" title="true"]'); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-6">
                <div class="default-content">
                    <?php if( !empty($package_right_col_title) ){ ?>

                        <h3><?php echo $package_right_col_title; ?></h3>
                    <?php }

                    echo $package_right_col_desc;

                    if( !empty($company_address) ){ ?>

                        <div class="iframe-wrapp">
                            <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo urlencode($company_address); ?>&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer(); ?>