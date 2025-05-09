<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('DEFAULT_IMG', get_stylesheet_directory_uri().'/images/default.jpg');

include 'inc/savecss.php';
include 'inc/cpt.php';

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

/*Website Settings*/
if( function_exists('acf_add_options_page') ){

	acf_add_options_page(array(
		'page_title' => 'Website Settings',
		'menu_title' => 'Website Settings',
		'menu_slug' => 'website-settings',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-layout',
		'redirect' => false
	));

	acf_add_options_page(array(
		'page_title' => 'Admin Settings',
		'menu_title' => 'Admin Settings',
		'menu_slug' => 'admin-settings',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-admin-generic',
		'redirect' => false
	));
}


// This theme uses wp_nav_menu() in two locations.  
register_nav_menus( array(  
  'footer-menu' => __( 'Footer Menu', 'understrap-child' ),
  'client-area' => __( 'Client Area', 'understrap-child' )
) );

/**
 * Add a new dashboard widget.
 */
function wpdocs_add_dashboard_widgets() {
	$feed_url = get_field('feed_title', 'option');
    wp_add_dashboard_widget( 'dashboard_widget', $feed_url, 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );


/*
*	Re-usable RSS feed reader with shortcode
*/
if ( !function_exists('base_rss_feed') ) {
	$feed_url = get_field('feed_url', 'option');
	function base_rss_feed($size = 5, $feed = '$feed_url', $date = false, $cache_time = 1800)
	{
		// Include SimplePie RSS parsing engine
		include_once ABSPATH . WPINC . '/feed.php';
 
		// Set the cache time for SimplePie
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', "return $cache_time;" ) );
 
		// Build the SimplePie object
		$rss = fetch_feed($feed);

		// Check for errors in the RSS XML
		if ( !is_wp_error( $rss ) ) {
 
			// Set a limit for the number of items to parse
			$maxitems = $rss->get_item_quantity($size);
			$rss_items = $rss->get_items(0, $maxitems);
 
			// Store the total number of items found in the feed
			$i = 0;
			$total_entries = count($rss_items);
            
			// Output HTML
			$html = "<ul class='rss-widget'>";
            // echo '<ul class="rss-widget">';
			foreach ($rss_items as $item) {
				 
				$i++;
 
				// Add a class of "last" to the last item in the list
				if( $total_entries == $i ) {
					$last = " class='last'";
				} else {
					$last = "";
				}
 
				// Store the data we need from the feed
				$title = $item->get_title();
				$link = $item->get_permalink();
				$desc = $item->get_description();
				$date_posted = $item->get_date('F j, Y');
 
				// Output
				$html .= "";
				$html .= '<li class="rss-widget-title"><a href="'.$link.'"><b>'."$title".'</b></a><span clas="rss-date">&nbsp;'.$date_posted.'</span></li>';
				// if( $date == true ) $html .= "$date_posted";
				// $html .= '<li class="rss-widget-description">'."$desc".'</li>';
				$html .= '<li class="rss-widget-description">'.wp_trim_words( $desc, 50, '&nbsp[...]' ).'</li>';
				$html .= "";
			 
			}
			// echo '</ul>';
           
            $html .= "</ul>";

             

		} else {
 
			$html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";
 
		}
 

		return $html;

	}
}

/** Define [rss] shortcode */
if( function_exists('base_rss_feed') && !function_exists('base_rss_shortcode') ) {

	$feed_url = get_field('feed_url', 'option');

	function base_rss_shortcode($atts) {
		extract(shortcode_atts(array(
			'size' => '3',
			'feed' => $feed_url,
			'date' => false,
		), $atts));
		
		$content = base_rss_feed($size, $feed, $date);
		return $content;
	}
	add_shortcode("rss", "base_rss_shortcode");
}

/**
 * Output the contents of the dashboard widget
 */
function dashboard_widget_function( $post, $callback_args ) {
    // esc_html_e( "Hello World, this is my first Dashboard Widget!", "textdomain" );
    $feed_url = get_field('feed_url', 'option');
   if( function_exists('base_rss_feed') ) echo base_rss_feed(3, $feed_url, true);

}

add_filter( 'gform_enable_password_field', '__return_true' );


function radius_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'radius_json_save_point');

function radius_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'radius_json_load_point');

// Adding option to select gravity form in ACF
add_filter( 'acf/load_field/name=gravity_forms', 'luca_acf_populate_gf_forms_ids' );
function luca_acf_populate_gf_forms_ids( $field ) {
	if ( class_exists( 'GFFormsModel' ) ) {
		$choices = [];

		foreach ( \GFFormsModel::get_forms() as $form ) {
			$choices[ $form->id ] = $form->title;
		}

		$field['choices'] = $choices;
	}

	return $field;
}

// Function to show star rating
function luca_star_rating($rating){
	if( $rating > 0 && $rating <= 5 ){

	    $rating_round = (int)$rating;
	    $half = $rating - $rating_round;
	    $half = $half > 0 ? true : false;

	    while( $rating_round > 0 ){
	    	echo '<i class="fa fa-star" aria-hidden="true"></i>';

	    	$rating_round--;
	    }

	    echo $half ? '<i class="fa fa-star-half-o" aria-hidden="true"></i>' : null;
	}
}

// Breadcrumb function
function luca_breadcrumb(){

	if( !is_front_page() ){

        // Start the breadcrumb with a link to your homepage
        echo '<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="'. site_url() .'">Home</a></li>';

        if( is_tax() ){

            echo '<li class="breadcrumb-item active" aria-current="page">'. single_term_title('', false) .'</li>';
        }

        // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if( is_category() || is_single() ){

            if(  'post' == get_post_type() ){

                echo '<li class="breadcrumb-item"><a href="'. get_the_permalink(get_option('page_for_posts')) .'" title="'. get_the_title(get_option('page_for_posts')) .'">'. get_the_title(get_option('page_for_posts')) .'</a></li>'; 
            }

            if(  'resource' == get_post_type() ){

                echo '<li class="breadcrumb-item"><a href="'. get_the_permalink(get_page_by_path('resources')) .'" title="'. get_the_title(get_option('page_for_posts')) .'">'. get_the_title(get_page_by_path('resources')) .'</a></li>'; 
            } 
        }

        // If the current page is a single post, show its title with the separator
        if( is_singular('team-member') ){
            echo '<li class="breadcrumb-item">Team Members</a></li>';
			echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</a></li>';
        }
		else if( is_singular('weekly-digest') ){
            echo '<li class="breadcrumb-item">Weekly Digests</a></li>';
			// echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</a></li>';
        }

		if( is_post_type_archive('weekly-digest') ){
			echo '<li class="breadcrumb-item">Weekly Digests</a></li>';
		}
		else if( is_post_type_archive('team-member') ){
			echo '<li class="breadcrumb-item">Team Members</a></li>';
		}
		else if( is_post_type_archive('post') ){
			echo '<li class="breadcrumb-item">Blog</a></li>';
		}
		/*
        if( is_singular('post') ){
            echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</a></li>';
        }
        else
		*/
		if( is_singular('testimonial') ){

            echo '<li class="breadcrumb-item active" aria-current="page">Testimonials</li>';
        }
        else if( is_singular('resource') ){
            echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</li>';
        }

        // If the current page is a static page, show its title.
        if( is_page() ){ 
            global $post;

            if( $post->post_parent ){

                $page_parent = get_post($post->post_parent); 

                echo '<li class="breadcrumb-item"><a href="'. get_the_permalink($page_parent) .'" title="'. $page_parent->post_title .'">'. $page_parent->post_title .'</a></li>
                <li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</li>';
            }else{

                echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</li>';
            }

        }

        // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if( is_home() ){

            global $post;
            $page_for_posts_id = get_option('page_for_posts');

            if( $page_for_posts_id ){

                $post = get_post($page_for_posts_id);
                setup_postdata($post);
                echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</a></li>';
            }
        }

        if( is_search() ){

            echo '<li class="breadcrumb-item active" aria-current="page">Search</li>';
        }

        echo '</ol></nav>';
    }
}

// Shortcode for yellow text
add_shortcode('yellow-text', 'yellow_text_cb');
function yellow_text_cb($atts, $content = null ){
    return '<span class="yellow">' . $content . '</span>';
}

// Shortcode for line break
add_shortcode('br', 'br_cb');
function br_cb(){
    return '<br>';
}

// Shortcode for current year
add_shortcode('current-year', 'current_year_cb');
function current_year_cb(){
    return date('Y');
}

// Ajax callback function to fetch and load more posts on blog page
add_action("wp_ajax_fetch_blog_posts", "fetch_blog_posts");
add_action("wp_ajax_nopriv_fetch_blog_posts", "fetch_blog_posts");

function fetch_blog_posts() {

	$category = $_POST['category'];
	$pagenumber = $_POST['pagenumber'];
    $ppp = 3;

	$posts_args = array(
	    'post_status' => 'publish', 
	    'order' => 'DESC',
	    'paged'	=> $pagenumber,
	    'posts_per_page' => $ppp, 
	);

	if( !empty($category) ){

		$posts_args['cat'] = $category;
	}

	$posts_loop = new WP_Query( $posts_args );

	$return_content = array('content' => '', 'load_more' => '');

	if( $posts_loop->have_posts() ){

		ob_start();

		if( $pagenumber == 1 ){ ?>

			<div class="row g-lg-5">
		<?php }
			while( $posts_loop->have_posts() ){
				$posts_loop->the_post();
 
				$excerpt = wp_trim_words( get_the_excerpt(), 25, '...' );
				$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

				<div class="col-md-6 col-xl-4 team-member">
	                    <div class="team-member-wrap">
	                        
	                        <a href="<?php the_permalink(); ?>" class="member-img">
	                        	<img src="<?= $post_image; ?>" alt="blog-post-img">
	                        </a>
	                        <div class="member-details">
	                        	
	                            <a href="<?php the_permalink(); ?>" class="member-name"><h4><?php the_title(); ?></h4></a>
	                            <?php echo $excerpt; ?>
	   
	                            <a href="<?php the_permalink(); ?>" class="readmore">Read More</a>                           
	                        </div>
	                    </div>
	            </div>
			<?php }
		if( $pagenumber == 1 ){ ?>
			
			</div>
		<?php }
		$return_content['content'] = ob_get_contents();
		ob_end_clean();

		if( $posts_loop->found_posts > ($ppp*$pagenumber) ){
			
			$return_content['load_more'] = ' <div class="d-flex justify-content-center"><a href="#" class="btn blue-btn load-more" data-pagenumber="'. ($pagenumber+1) .'">Load More<img src="'. get_stylesheet_directory_uri() .'/images/arrow-right.png" class="img-fluid btn-arrow" alt=""></a></div>';
		}

	}

	wp_reset_query();
	echo json_encode($return_content);

die();
}

add_filter('excerpt_more', 'luca_excerpt_more');
function luca_excerpt_more( $more ) {
    return '...';
}

add_filter('get_the_excerpt', 'luca_change_excerpt');
function luca_change_excerpt( $text ){

    return rtrim( str_replace(array('[', ']'), array('', ''), $text));
}

add_filter( 'excerpt_length', 'luca_excerpt_length' );
function luca_excerpt_length( $length ) {
    return 25;
}

include_once('inc/custom-widget.php');

/**
 * Show BizInk logo on login page
 */
add_action('login_head', 'radius_login_page_styles');
function radius_login_page_styles() { 
	?>
	<style>
		#login h1 a {
			background: url(<?php echo get_stylesheet_directory_uri() . '/images/login-logo.png' ?>) no-repeat center center;
			padding-bottom: 30px;
			height: 70px;
			width: 310px;
			background-size: 310px 80px;
		}
	</style>
	<?php 
}

// Theme Updater
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker('https://github.com/BizInk/radius-theme',__FILE__,'radius-theme');
$myUpdateChecker->setBranch('master');
$myUpdateChecker->setAuthentication('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');