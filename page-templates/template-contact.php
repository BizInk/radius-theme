<?php
/**
* Template Name: Contact
*
* Template to display listing of team members page
*
* @package Understrap
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
// include get_template_directory() . '/inc/password-check.php';

get_header();

get_template_part('global-templates/inner-banner');

$contact_left_title = get_field('contact_left_title');
$contact_left_desc = get_field('contact_left_desc');
$gravity_forms = get_field('gravity_forms');
$contact_right_title = get_field('contact_right_title');
$contact_right_desc = get_field('contact_right_desc');

$company_address = get_field('company_address', 'options');
$company_phone = get_field('company_phone', 'options');
$company_email = get_field('company_email', 'options');
?>
<section id="content" class="contact-section comman-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="default-content contact-info">
                    <?php if( !empty($contact_left_title) ){ ?>

                        <h3><?php echo $contact_left_title; ?></h3>
                    <?php }

                    echo $contact_left_desc; ?>
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
                    <?php if( !empty($contact_right_title) ){ ?>

                        <h3><?php echo $contact_right_title; ?></h3>
                    <?php }

                    echo $contact_right_desc;

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