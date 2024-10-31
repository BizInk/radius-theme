<?php
defined('ABSPATH') || exit;
get_header();
get_template_part('global-templates/inner-banner');

$member_image = get_field('member_image');
$member_image = !empty($member_image) ? $member_image : get_stylesheet_directory_uri() . '/images/testimonial-default.jpg';

$member_position = get_field('member_position'); 
$member_full_profile = get_field('member_full_profile'); 
$member_skillset = get_field('member_skillset'); 

$member_phone = get_field('member_phone'); 
$member_email = get_field('member_email'); 
$member_address = get_field('member_address'); 

$member_facebook = get_field('member_facebook');
$member_twitter = get_field('member_twitter');
$member_linkedin = get_field('member_linkedin'); 
$member_instagram = get_field('member_instagram');
?>

<section class="member-details-section comman-margin">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div class="member-img">
                    <img src="<?php echo $member_image; ?>" class="img-fluid" alt="<?php the_title(); ?>">         

                    <?php if( !empty($member_phone) || !empty($member_email) || !empty($member_address) ){ ?>

                        <div class="address-wrpal">
                            <ul>
                                <?php if( !empty($member_phone) ){ ?>

                                    <li><a href="tel:<?php echo $member_phone; ?>"><?php _e('Tel:','radius-theme'); echo $member_phone; ?> <i class="fa fa-phone" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($member_email) ){ ?>

                                    <li><a href="mailto:<?php echo $member_email; ?>"><?php _e('Email:','radius-theme'); echo $member_email; ?><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($member_address) ){ ?>

                                    <li><a href="https://maps.google.com/q=<?php echo urlencode($member_address); ?>" target="_blank"><?php _e('Address:','radius-theme'); echo $member_address; ?> <i class="fa fa-map" aria-hidden="true"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>          
                </div>
            </div>

            <div class="col-md-7">
                <div class="editor-design">
                    <div class="mb-4">
                        <?php if( !empty($member_position) ){ ?>

                            <h6><?php echo $member_position; ?></h6>
                        <?php } ?>

                        <h2><?php the_title(); ?></h2>                      
                    </div>
                    <?php echo $member_full_profile; ?>

                    <?php if( !empty($member_facebook) || !empty($member_twitter) || !empty($member_instagram) || !empty($member_linkedin) ){ ?>

                        <div class="social-wrap">
                          <h5><?php _e('Follow me:','radius-theme'); ?></h5>
                          <ul class="social-icons">
                                
                                <?php if( !empty($member_facebook) ){ ?>

                                    <li><a href="<?php echo $member_facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php }
                                
                                if( !empty($member_twitter) ){ ?>

                                    <li><a href="<?php echo $member_twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($member_linkedin) ){ ?>

                                    <li><a href="<?php echo $member_linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <?php }

                                if( !empty($member_instagram) ){ ?>

                                    <li><a href="<?php echo $member_instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }

                    if( !empty($member_skillset) ){ ?>

                        <div class="skillset">
                             <div class="editor-design">
                                <?php echo $member_skillset; ?>
                             </div>
                        </div>
                    <?php } ?>
                </div>
            </div>            
        </div>
    </div>
</section>

<?php
get_footer();
?>