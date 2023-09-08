<?php

/**
 * Template Name: Resource
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

get_template_part('global-templates/inner-banner');

$ppp = 4;
$resources_acf = get_field('resources');

if( !empty($resources_acf) ){ ?>

    <section class="infobox-section resource-infobox services-infobox">        
        <div class="container">
            <div class="infobox-warp">
                <div class="row g-3">

                    <?php
                    $resource_counter = 1;
                    $resources_arr = array_chunk($resources_acf, $ppp);
                    foreach( $resources_arr as $resources ){

                        foreach( $resources as $resource ){

                            $icon = get_field('resource_video_info_icon', $resource); ?>

                            <a href="<?php echo get_permalink($resource); ?>" class="col-md-6 col-lg-4 text-decoration-none" <?php echo $resource_counter > $ppp ? 'style="display:none;"' : ''; ?> data-pagenumber="topics<?php echo ceil($resource_counter/$ppp); ?>">
                                <div class="info-box h-100">
                                    
                                    <?php if( !empty($icon['url']) ){ ?>
                                        
                                        <img src="<?php echo $icon['url']; ?>" class="img-fluid" alt="<?php echo $icon['alt']; ?>" title="<?php echo $icon['title']; ?>">
                                    <?php } ?>

                                    <h5><?php echo $resource->post_title; ?></h5>
                                </div>
                            </a>
                        <?php $resource_counter++;
                        }
                    } ?>
                </div>

                <?php if( count($resources_acf) > $ppp ){ ?>

                    <a href="javascript:void(0);" class="btn red-btn topics-load-more" data-pagenumber="1">Load More</a>
                <?php } ?>

                <script>
                    // Script to load more topics
                    jQuery(document).on('click', '.topics-load-more', function(e){
                        e.preventDefault();

                        var pagenumber = parseInt(jQuery(this).attr('data-pagenumber'));
                        pagenumber = parseInt(pagenumber+1);

                        jQuery('[data-pagenumber="topics'+ pagenumber +'"]').show();

                        jQuery(this).attr('data-pagenumber', pagenumber);

                        pagenumber = parseInt(pagenumber+1);
                        
                        if( jQuery('[data-pagenumber="topics'+ pagenumber +'"]').length == 0 ){

                            jQuery(this).remove();
                        }
                    });
                </script>
            </div>
        </div>
    </section>
<?php }


get_footer(); ?>