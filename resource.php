<?php
/**
 * Template Name: Resources
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

get_template_part('global-templates/inner-banner');

$content_topics_small_title = get_field('content_topics_small_title');
$content_topics_title = get_field('content_topics_title');
$content_topics_content = get_field('content_topics_content');
$content_types_small_title = get_field('content_types_small_title');
$content_types_title = get_field('content_types_title');
$content_types_content = get_field('content_types_content');

$ppp = 18;
$content_topics = get_terms(array(
    'taxonomy' => 'content-topic',
    'hide_empty' => false,
));
?>
<section class="infobox-section resource-infobox services-infobox">
<?php
if( !empty($content_topics) ){ ?>

    
        <div class="container">
            <div class="infobox-warp">
                <div class="row g-3 my-4">
                    <?php if( !empty($content_topics_small_title) ){ ?>
                        <h6><?php echo $content_topics_small_title; ?></h6>
                    <?php }
                    
                    if( !empty($content_topics_title) ){ ?>
                        <h2><?php echo $content_topics_title; ?></h2>
                    <?php }
                    echo $content_topics_content; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="infobox-warp">
                <div class="row gy-5 g-md-5">

                    <?php
                    $topics_counter = 1;

                    foreach( $content_topics as $content_topic ){

                        $icon = get_field('content_topic_icon', $content_topic); ?>

                        <a href="<?php echo get_term_link($content_topic); ?>" class="col-md-6 col-lg-4 text-decoration-none" <?php echo $topics_counter > $ppp ? 'style="display:none;"' : ''; ?> data-pagenumber="topics<?php echo ceil($topics_counter/$ppp); ?>">
                            <div class="info-box text-center h-100">
                                
                                <?php if( !empty($icon) ){ ?>
                                    
                                    <img src="<?php echo $icon; ?>" class="img-fluid" alt="">
                                <?php } ?>
                                <h4><?php echo $content_topic->name; ?></h4>

                                <?php if( !empty($content_topic->description) ){ ?>

                                    <div class="info-description">
                                        <p><?php echo do_shortcode($content_topic->description); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                    <?php $topics_counter++;
                    } ?>
                </div>

                <?php if( count($content_topics) > $ppp ){ ?>

                    <a href="javascript:void(0);" class="btn red-btn topics-load-more" data-pagenumber="1"><?php _e('Load More','radius-theme'); ?></a>
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
<?php }

$content_types = get_terms(array(
    'taxonomy' => 'content-type',
    'hide_empty' => false,
));

if( !empty($content_types) ){ ?>
     
        <div class="container">
            <div class="infobox-warp">
                <div class="row g-3 my-4">
                    
                    <?php if( !empty($content_types_small_title) ){ ?>
                        
                        <h6><?php echo $content_types_small_title; ?></h6>
                    <?php }

                    if( !empty($content_types_title) ){ ?>
                        
                        <h2><?php echo $content_types_title; ?></h2>
                    <?php }

                    echo $content_types_content; ?>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="infobox-warp">
                <div class="row gy-5 g-md-5">

                    <?php
                    $types_counter = 1;
                    foreach( $content_types as $content_type ){ ?>

                        <div class="col-md-6 col-lg-4" <?php echo $types_counter > $ppp ? 'style="display:none;"' : ''; ?> data-pagenumber="types<?php echo ceil($types_counter/$ppp); ?>">
                            <div class="info-box text-center h-100">                        
                                <h4><?php echo $content_type->name; ?></h4>
                                <div class="info-description">

                                    <?php if( !empty($content_type->description) ){ ?>

                                        <p><?php echo do_shortcode($content_type->description); ?></p>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo get_term_link($content_type); ?>" class="btn"><?php _e('View more','radius-theme');?></a>
                            </div>
                        </div>
                    <?php $types_counter++;
                    } ?>
                </div>

                <?php if( count($content_types) > $ppp ){ ?>

                    <a href="javascript:void(0);" class="btn red-btn types-load-more" data-pagenumber="1"><?php _e('Load More','radius-theme'); ?></a>
                <?php } ?>

                <script>
                    // Script to load more types
                    jQuery(document).on('click', '.types-load-more', function(e){
                        e.preventDefault();

                        var pagenumber = parseInt(jQuery(this).attr('data-pagenumber'));
                        pagenumber = parseInt(pagenumber+1);

                        jQuery('[data-pagenumber="types'+ pagenumber +'"]').show();

                        jQuery(this).attr('data-pagenumber', pagenumber);

                        pagenumber = parseInt(pagenumber+1);
                        
                        if( jQuery('[data-pagenumber="types'+ pagenumber +'"]').length == 0 ){

                            jQuery(this).remove();
                        }
                    });
                </script>
            </div>
        </div>
<?php
}
?>
</section>
<?php get_footer(); ?>