<?php if( is_page() ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image');
	$inner_banner_title = get_field('inner_banner_title');
	$inner_banner_content = get_field('inner_banner_content');
}else if( is_singular('team-member') ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
	$inner_banner_title = get_the_title();
	$inner_banner_content = '<p>'.get_field('member_position').'</p>';
}else if( is_singular('testimonial') ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
    $inner_banner_title = get_the_title();
    $inner_banner_content = '';
}else if( is_singular('resource') ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
    $inner_banner_title = get_the_title();
    $inner_banner_content = '';
}else if( is_single() ){

    global $post;
    $author_id = $post->post_author;

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
    $inner_banner_title = get_the_title();
    $inner_banner_content = '<p class="post-meta">
            <span>'. get_the_author_meta('display_name', $author_id) .'</span> | <span>'. get_the_date('d M, Y') .'</span>
        </p>';
}else if( is_home() ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
    $inner_banner_title = 'Blogs'; 
    $inner_banner_content = get_field('inner_banner_content', 'option');
}else if( is_archive() ){

    $inner_banner_bg_image = get_field('inner_banner_bg_image', 'option');
    $inner_banner_title = single_cat_title( '', false ); 
    $inner_banner_content = '';
}else if( is_404() ){

    $inner_banner_bg_image = get_field('404_banner_image', 'option'); 
    $inner_banner_title = get_field('404_banner_title', 'option'); 
    $inner_banner_content = get_field('404_banner_content', 'option');
}

if( empty($inner_banner_title) || !$inner_banner_title ){

    $inner_banner_title = get_field('inner_banner_title', 'option');
}

if( !is_search() ){

    $background_html = null;
    if( isset($inner_banner_bg_image) && !empty($inner_banner_bg_image) ){

        $background_html = ' style="background-image:url('. $inner_banner_bg_image .');"';
    } ?>

    <!-- call-to-action-section-start -->
    <section class="call-to-action-section inner-banner"<?php echo $background_html; ?>>
        <div class="full-width-wysiwyg text-left">
            <div class="container">
                <?php luca_breadcrumb(); ?>
                
                <div class="editor-design">

                    <?php if( !empty($inner_banner_title) ) { ?>

                        <h1><?php echo do_shortcode($inner_banner_title); ?></h1>
                    <?php }

                    if( !empty($inner_banner_content) ) {

                        echo $inner_banner_content;
                    } ?>
                </div>
            </div>
        </div>      
    </section>
    <!-- call-to-action-section-end --> 
<?php } ?>