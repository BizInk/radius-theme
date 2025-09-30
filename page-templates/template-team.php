<?php
/**
* Template Name: Our Team
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

$team_members = get_field('team_members');

if( !empty($team_members) ){ ?>

    <section id="content" class="teamlist-section comman-margin">
        <div class="container">
            <div class="row g-lg-5">
                <?php foreach( $team_members as $team_member ){

                    $member_image = get_field('member_image', $team_member);
                    $member_position = get_field('member_position', $team_member);
                    $member_company = get_field('member_company', $team_member);
                    $member_facebook = get_field('member_facebook', $team_member);
                    $member_linkedin = get_field('member_linkedin', $team_member);
                    $member_instagram = get_field('member_instagram', $team_member); ?>

                    <div class="col-md-6 col-lg-4 col-xl-3 team-member">
                        <a href="<?php echo get_permalink($team_member); ?>">
                            <div class="team-member-wrap">
                                <div class="member-img">
                                    <?php if( !empty($member_image) ){ ?>
                                        
                                        <img src="<?php echo $member_image; ?>" class="img-fluid" alt="<?php echo $team_member->post_title; ?>">
                                    <?php } ?>

                                    <div class="team-social-wrap">
                                        <div class="plus-icon"> 
                                            +
                                        </div>
                                        <div class="team-social">
                                            <?php if( !empty($member_facebook) ){ ?>

                                                <a href="<?php echo $member_facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>   
                                            <?php }

                                            if( !empty($member_linkedin) ){ ?>
                                            
                                                <a href="<?php echo $member_linkedin; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <?php }

                                            if( !empty($member_instagram) ){ ?>
                                            
                                                <a href="<?php echo $member_instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="member-details">
                                    <?php if( !empty($member_position) ){ ?>
                                        
                                        <h6><?= $member_position; ?></h6>
                                    <?php } ?>

                                    <h4><?php echo $team_member->post_title; ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php }

get_footer(); ?>