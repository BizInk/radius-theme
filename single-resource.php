<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

get_template_part('global-templates/inner-banner');

$resource_video_thumbnail = get_field('resource_video_thumbnail');
$resource_video_url = get_field('resource_video_url');
$resource_video_info_icon = get_field('resource_video_info_icon');
$resource_video_info_text = get_field('resource_video_info_text');
$resource_left_column_content = get_field('resource_left_column_content');
$resource_right_column_content = get_field('resource_right_column_content');
$resource_first_button = get_field('resource_first_button');
$resource_second_button = get_field('resource_second_button');
?>

<section id="content" class="resource-video-section comman-margin">
    <div class="container">

        <?php if( !empty($resource_video_url) && !empty($resource_video_thumbnail['url']) ){ ?>
            <div class="resource-video">
                <a href="<?php echo $resource_video_url; ?>" target="" data-fancybox="">
                    <img src="<?php echo $resource_video_thumbnail['url']; ?>" title="<?php echo $resource_video_thumbnail['title']; ?>" class="img-fluid" alt="<?php echo $resource_video_thumbnail['alt']; ?>">
                    <i class="fa fa-play-circle" aria-hidden="true"></i>

                    <?php if( !empty($resource_video_info_icon['url']) || !empty($resource_video_info_text) ){ ?>

                        <div class="video-info">
                            <?php if( !empty($resource_video_info_icon['url']) ){ ?>

                                <img src="<?php echo $resource_video_info_icon['url']; ?>" title="<?php echo $resource_video_info_icon['title']; ?>" class="img-fluid" alt="<?php echo $resource_video_info_icon['alt']; ?>">
                            <?php }

                            if( !empty($resource_video_info_text) ){ ?>

                                <h5><?php echo do_shortcode($resource_video_info_text); ?></h5>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </a>
            </div>
        <?php } ?>

        <?php if( !empty($resource_left_column_content) && !empty($resource_right_column_content) ):  ?>
        <div class="resource-content comman-margin">        
            <div class="row">
                <?php if( !empty($resource_left_column_content) ){ ?>

                    <div class="col-md-12 col-lg-6">
                        <div class="editor-design">
                            <?php echo $resource_left_column_content; ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-12 col-lg-6 mt-5 mt-lg-0">
                    <?php if( !empty($resource_right_column_content) ){ ?>

                        <div class="editor-design">
                            <?php echo $resource_right_column_content; ?>
                        </div>
                    <?php }

                    if( have_rows('resource_list') ){ ?>

                        <ul class="resource-list">
                        <?php while( have_rows('resource_list') ){
                            the_row();

                            $resource_list_item = get_sub_field('resource_list_item');
                            if( !empty($resource_list_item) ){ ?>

                                <li>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check_circle_red.png" class="img-fluid" alt="">
                                    <a href="<?php echo $resource_list_item['url']; ?>"><?php echo $resource_list_item['title']; ?></a>
                                </li>
                            <?php }
                        } ?>
                        </ul>
                    <?php } ?>

                    <div class="btn-group-wrap">
                        <?php if( !empty($resource_first_button['url']) && !empty($resource_first_button['title']) ){ ?>

                            <a href="<?php echo $resource_first_button['url']; ?>" class="btn mb-3"><?php echo $resource_first_button['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <?php }

                        if( !empty($resource_second_button['url']) && !empty($resource_second_button['title']) ){ ?>

                            <a href="<?php echo $resource_second_button['url']; ?>" class="btn btn-outline-navyblue mb-3"><?php echo $resource_second_button['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="resource-content comman-margin">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php
get_footer(); ?>