<?php

/**
 * Template Name: OLD Resource
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

get_template_part('global-templates/inner-banner');

$resources_acf = get_field('resources');

if( !empty($resources_acf) ){ ?>

    <section class="infobox-section resource-infobox services-infobox">        
        <div class="container">
            <div class="infobox-warp">
                <div class="row g-3">

                    <?php
                    foreach( $resources_acf as $resource ){

                        $icon = get_field('resource_video_info_icon', $resource); ?>

                        <a href="<?php echo get_permalink($resource); ?>" class="col-md-6 col-lg-4 text-decoration-none">
                            <div class="info-box h-100">
                                
                                <?php if( !empty($icon['url']) ){ ?>
                                    
                                    <img src="<?php echo $icon['url']; ?>" class="img-fluid" alt="<?php echo $icon['alt']; ?>" title="<?php echo $icon['title']; ?>">
                                <?php } ?>

                                <h5><?php echo $resource->post_title; ?></h5>
                            </div>
                        </a>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php }


get_footer(); ?>