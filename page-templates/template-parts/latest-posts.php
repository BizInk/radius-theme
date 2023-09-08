<?php
$general_settings = get_sub_field('general_settings');
$general_class = '';
$background_tag = '';

if( in_array('Add Common Padding', $general_settings) ){

    $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

    $general_class .= ' comman-margin';
}

if( !empty($background_image) ){

    $background_tag = ' style="background-image:url('. $background_image .')"';
}

$latest_posts_bg_title = get_sub_field('latest_posts_bg_title');
$latest_posts_small_title = get_sub_field('latest_posts_small_title');
$latest_posts_title = get_sub_field('latest_posts_title');
$latest_posts_content = get_sub_field('latest_posts_content');
$latest_posts_button = get_sub_field('latest_posts_button');
$background_image = get_sub_field('background_image');

$latest_posts_args = array(
    'post_type' => 'post',
    'posts_per_page'  => 4, 
    'order' => 'DESC',
    'post_status' => 'publish',
);

$latest_posts_query = new WP_Query($latest_posts_args);

if ( $latest_posts_query->have_posts() ) { ?>

    <section class="four-col-team-section<?php echo $general_class; ?>">  
        <div class="post-bg-img bg-img-position"<?php echo $background_tag; ?>>
        </div>      
        <div class="full-width-wysiwyg text-center">
            <div class="container">
                <div class="editor-design">

                        <div class="xl-font-wrap">
                            <?php if( !empty($latest_posts_bg_title) ){ ?>

                                <div class="xl-font"><?php echo $latest_posts_bg_title; ?></div>
                            <?php }

                            if( !empty($latest_posts_small_title) ){ ?>
                                
                                <h6><?php echo $latest_posts_small_title; ?></h6>
                            <?php } ?>
                        </div>                      
                    <?php
                    if( !empty($latest_posts_title) ){ ?>

                        <h2><?php echo $latest_posts_title; ?></h2>
                    <?php }

                    echo $latest_posts_content; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="team-wrap">
                <div class="latest-post-slider">
                    <?php while ( $latest_posts_query->have_posts() ) {

                        $latest_posts_query->the_post();
                        $excerpt = get_the_excerpt();
                        $latest_posts_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG;
                        $categories = get_the_category();
                        $categories_display = '';

                        if( !empty($categories) ){
                            
                            foreach( $categories as $category ){
                                if( !empty($categories_display) ){

                                    $categories_display .= ', ' . $category->name;
                                }else{
                                    $categories_display .= $category->name;
                                }
                            }
                        } ?>

                        <div class="team-member">
                            <div class="team-member-wrap">

                                <?php if( !empty($latest_posts_image) ){ ?>

                                    <a href="<?php the_permalink(); ?>" class="member-img">
                                        <img src="<?php echo $latest_posts_image; ?>" alt="<?php the_title(); ?>">
                                    </a>
                                <?php } ?>
                                
                                <div class="member-details">

                                    <?php if( !empty($categories_display) ){ ?>

                                        <span><?php echo $categories_display; ?></span>
                                    <?php } ?>

                                    <a href="<?php the_permalink(); ?>">
                                        <h4 class="member-name"><?php the_title(); ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_query(); ?>
                </div>
            </div>

            <?php if( !empty($latest_posts_button['url']) && !empty($latest_posts_button['title']) ){ ?>

                <a href="<?php echo $latest_posts_button['url']; ?>" class="btn orange-btn" target="<?php echo $latest_posts_button['target']; ?>"><?php echo $latest_posts_button['title']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            <?php } ?>
        </div>
    </section>
<?php } ?>