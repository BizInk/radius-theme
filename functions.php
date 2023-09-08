<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('DEFAULT_IMG', get_stylesheet_directory_uri().'/images/default.jpg');


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
// if( function_exists('acf_add_options_sub_page') ) {
	
// 	$parent = acf_add_options_sub_page(array(
//             'page_title'  => __('Website Settings'),
//             'menu_title'  => __('Website Settings'),
//             'parent'     => 'options-general.php',
//             'redirect'    => false,
//         ));
// 	$parent = acf_add_options_sub_page(array(
//             'page_title'  => __('Admin Settings'),
//             'menu_title'  => __('Admin Settings'),
//             'parent'     => 'options-general.php',
//             'redirect'    => false,
//         ));
// }

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


//$new_color = get_field('primary_color', 'option');
// require_once(get_stylesheet_directory() . '/inc/scssphp/scss.inc.php');
// use ScssPhp\ScssPhp\Compiler;
// $compiler = new Compiler();
// echo $compiler->compileString('
//   $primary: '.$new_color.'')->getCss();

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
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $paths;
    
}

add_action( 'init', 'wpdocs_custom_init' );
function wpdocs_custom_init() {
	remove_post_type_support('post','excerpt');
	remove_post_type_support('fixed-price-packages','excerpt');
	remove_post_type_support('testimonial','excerpt');
	remove_post_type_support('team-member','excerpt');
	remove_post_type_support('mail-template','excerpt');
	remove_post_type_support('checklist','excerpt');

	// Remove editor from only flexible page template
	if ( isset($_GET['post']) ) {

        $page_id = $_GET['post'];
		$template = get_post_meta($page_id, '_wp_page_template', true);
		
		if( $template == 'page-templates/flexible-content.php' ){	

	        remove_post_type_support('page', 'editor');
		}
	}

	// Fixed Price Packages CPT
	$fixed_price_packages_labels = array(
		'name'                  => _x( 'Fixed Price Packages', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Fixed Price Package', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Fixed Price Packages', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Fixed Price Package', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Fixed Price Package', 'luca' ),
		'new_item'              => __( 'New Fixed Price Package', 'luca' ),
		'edit_item'             => __( 'Edit Fixed Price Package', 'luca' ),
		'view_item'             => __( 'View Fixed Price Package', 'luca' ),
		'all_items'             => __( 'All Fixed Price Packages', 'luca' ),
		'search_items'          => __( 'Search Fixed Price Packages', 'luca' ),
		'parent_item_colon'     => __( 'Parent Fixed Price Packages:', 'luca' ),
		'not_found'             => __( 'No fixed price packages found.', 'luca' ),
		'not_found_in_trash'    => __( 'No fixed price packages found in Trash.', 'luca' ),
	);

	$fixed_price_packages_args = array(
		'labels'             => $fixed_price_packages_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-analytics',
		'rewrite'            => array( 'slug' => 'fixed-price-packages' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'fixed-price-packages', $fixed_price_packages_args );

	// Resources CPT
	$resources_labels = array(
		'name'                  => _x( 'Resources', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Resource', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Resources', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Resource', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Resource', 'luca' ),
		'new_item'              => __( 'New Resource', 'luca' ),
		'edit_item'             => __( 'Edit Resource', 'luca' ),
		'view_item'             => __( 'View Resource', 'luca' ),
		'all_items'             => __( 'All Resources', 'luca' ),
		'search_items'          => __( 'Search Resources', 'luca' ),
		'parent_item_colon'     => __( 'Parent Resources:', 'luca' ),
		'not_found'             => __( 'No Resources found.', 'luca' ),
		'not_found_in_trash'    => __( 'No Resources found in Trash.', 'luca' ),
	);

	$resources_args = array(
		'labels'             => $resources_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-book',
		'rewrite'            => array( 'slug' => 'resource' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'resource', $resources_args );

	// Taxonomies for Resource Content Topic
	$content_topic_labels = array(
		'name'              => _x( 'Content Topics', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Content Topic', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Content Topics', 'luca' ),
		'all_items'         => __( 'All Content Topics', 'luca' ),
		'parent_item'       => __( 'Parent Content Topic', 'luca' ),
		'parent_item_colon' => __( 'Parent Content Topic:', 'luca' ),
		'edit_item'         => __( 'Edit Content Topic', 'luca' ),
		'update_item'       => __( 'Update Content Topic', 'luca' ),
		'add_new_item'      => __( 'Add New Content Topic', 'luca' ),
		'new_item_name'     => __( 'New Content Topic Name', 'luca' ),
		'not_found'         => __( 'No Content Topics Found', 'luca' ),
		'back_to_items'     => __( 'Back to Content Topics', 'luca' ),
		'menu_name'         => __( 'Content Topics', 'luca' ),
	);

	$content_topic_args = array(
		'hierarchical'      => true,
		'labels'            => $content_topic_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'content-topic' ),
	);

	register_taxonomy( 'content-topic', array( 'resource' ), $content_topic_args );

	// Taxonomies for Resource Content Type
	$content_type_labels = array(
		'name'              => _x( 'Content Types', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Content Type', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Content Types', 'luca' ),
		'all_items'         => __( 'All Content Types', 'luca' ),
		'parent_item'       => __( 'Parent Content Type', 'luca' ),
		'parent_item_colon' => __( 'Parent Content Type:', 'luca' ),
		'edit_item'         => __( 'Edit Content Type', 'luca' ),
		'update_item'       => __( 'Update Content Type', 'luca' ),
		'add_new_item'      => __( 'Add New Content Type', 'luca' ),
		'new_item_name'     => __( 'New Content Type Name', 'luca' ),
		'not_found'         => __( 'No Content Types Found', 'luca' ),
		'back_to_items'     => __( 'Back to Content Types', 'luca' ),
		'menu_name'         => __( 'Content Types', 'luca' ),
	);

	$content_type_args = array(
		'hierarchical'      => true,
		'labels'            => $content_type_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'content-type' ),
	);

	register_taxonomy( 'content-type', array( 'resource' ), $content_type_args );

	// Testimonials CPT
	$testimonials_labels = array(
		'name'                  => _x( 'Testimonials', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Testimonials', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Testimonial', 'luca' ),
		'new_item'              => __( 'New Testimonial', 'luca' ),
		'edit_item'             => __( 'Edit Testimonial', 'luca' ),
		'view_item'             => __( 'View Testimonial', 'luca' ),
		'all_items'             => __( 'All Testimonials', 'luca' ),
		'search_items'          => __( 'Search Testimonials', 'luca' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'luca' ),
		'not_found'             => __( 'No testimonials found.', 'luca' ),
		'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'luca' ),
	);

	$testimonials_args = array(
		'labels'             => $testimonials_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-testimonial',
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'testimonial', $testimonials_args );

	// Team Members CPT
	$team_members_labels = array(
		'name'                  => _x( 'Team Members', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Team Member', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Team Members', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Team Members', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Team Member', 'luca' ),
		'new_item'              => __( 'New Team Member', 'luca' ),
		'edit_item'             => __( 'Edit Team Member', 'luca' ),
		'view_item'             => __( 'View Team Member', 'luca' ),
		'all_items'             => __( 'All Team Members', 'luca' ),
		'search_items'          => __( 'Search Team Members', 'luca' ),
		'parent_item_colon'     => __( 'Parent Team Member:', 'luca' ),
		'not_found'             => __( 'No team Members found.', 'luca' ),
		'not_found_in_trash'    => __( 'No team Members found in Trash.', 'luca' ),
	);

	$team_members_args = array(
		'labels'             => $team_members_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-groups',
		'rewrite'            => array( 'slug' => 'team-member' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'team-member', $team_members_args );


	// Taxonomies for Team members Location
	$location_labels = array(
		'name'              => _x( 'Locations', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Location', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Locations', 'luca' ),
		'all_items'         => __( 'All Locations', 'luca' ),
		'parent_item'       => __( 'Parent Location', 'luca' ),
		'parent_item_colon' => __( 'Parent Location:', 'luca' ),
		'edit_item'         => __( 'Edit Location', 'luca' ),
		'update_item'       => __( 'Update Location', 'luca' ),
		'add_new_item'      => __( 'Add New Location', 'luca' ),
		'new_item_name'     => __( 'New Location Name', 'luca' ),
		'not_found'         => __( 'No Locations Found', 'luca' ),
		'back_to_items'     => __( 'Back to Locations', 'luca' ),
		'menu_name'         => __( 'Locations', 'luca' ),
	);

	$location_args = array(
		'hierarchical'      => true,
		'labels'            => $location_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'locations' ),
	);

	register_taxonomy( 'locations', array( 'team-member' ), $location_args );

	// Taxonomies for Team members Firms
	$firms_labels = array(
		'name'              => _x( 'Firms', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Firm', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Firms', 'luca' ),
		'all_items'         => __( 'All Firms', 'luca' ),
		'parent_item'       => __( 'Parent Firm', 'luca' ),
		'parent_item_colon' => __( 'Parent Firm:', 'luca' ),
		'edit_item'         => __( 'Edit Firm', 'luca' ),
		'update_item'       => __( 'Update Firm', 'luca' ),
		'add_new_item'      => __( 'Add New Firm', 'luca' ),
		'new_item_name'     => __( 'New Firm Name', 'luca' ),
		'not_found'         => __( 'No Firms Found', 'luca' ),
		'back_to_items'     => __( 'Back to Firms', 'luca' ),
		'menu_name'         => __( 'Firms', 'luca' ),
	);

	$firms_args = array(
		'hierarchical'      => true,
		'labels'            => $firms_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'firms' ),
	);

	register_taxonomy( 'firms', array( 'team-member' ), $firms_args );

	// Taxonomies for Team members Services
	$services_labels = array(
		'name'              => _x( 'Services', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Service', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Services', 'luca' ),
		'all_items'         => __( 'All Services', 'luca' ),
		'parent_item'       => __( 'Parent Service', 'luca' ),
		'parent_item_colon' => __( 'Parent Service:', 'luca' ),
		'edit_item'         => __( 'Edit Service', 'luca' ),
		'update_item'       => __( 'Update Service', 'luca' ),
		'add_new_item'      => __( 'Add New Service', 'luca' ),
		'new_item_name'     => __( 'New Service Name', 'luca' ),
		'not_found'         => __( 'No Services Found', 'luca' ),
		'back_to_items'     => __( 'Back to Services', 'luca' ),
		'menu_name'         => __( 'Services', 'luca' ),
	);

	$services_args = array(
		'hierarchical'      => true,
		'labels'            => $services_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'services' ),
	);

	register_taxonomy( 'services', array( 'team-member' ), $services_args );

	// Taxonomies for Team members Specialisations
	$specialisations_labels = array(
		'name'              => _x( 'Specialisations', 'taxonomy general name', 'luca' ),
		'singular_name'     => _x( 'Specialisation', 'taxonomy singular name', 'luca' ),
		'search_items'      => __( 'Search Specialisations', 'luca' ),
		'all_items'         => __( 'All Specialisations', 'luca' ),
		'parent_item'       => __( 'Parent Specialisation', 'luca' ),
		'parent_item_colon' => __( 'Parent Specialisation:', 'luca' ),
		'edit_item'         => __( 'Edit Specialisation', 'luca' ),
		'update_item'       => __( 'Update Specialisation', 'luca' ),
		'add_new_item'      => __( 'Add New Specialisation', 'luca' ),
		'new_item_name'     => __( 'New Specialisation Name', 'luca' ),
		'not_found'         => __( 'No Specialisations Found', 'luca' ),
		'back_to_items'     => __( 'Back to Specialisations', 'luca' ),
		'menu_name'         => __( 'Specialisations', 'luca' ),
	);

	$specialisations_args = array(
		'hierarchical'      => true,
		'labels'            => $specialisations_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'specialisations' ),
	);

	register_taxonomy( 'specialisations', array( 'team-member' ), $specialisations_args );

	// Mail Templates CPT
	$mail_templates_labels = array(
		'name'                  => _x( 'Mail Templates', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Mail Template', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Mail Templates', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Mail Templates', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Mail Template', 'luca' ),
		'new_item'              => __( 'New Mail Template', 'luca' ),
		'edit_item'             => __( 'Edit Mail Template', 'luca' ),
		'view_item'             => __( 'View Mail Template', 'luca' ),
		'all_items'             => __( 'All Mail Templates', 'luca' ),
		'search_items'          => __( 'Search Mail Templates', 'luca' ),
		'parent_item_colon'     => __( 'Parent Mail Template:', 'luca' ),
		'not_found'             => __( 'No mail templates found.', 'luca' ),
		'not_found_in_trash'    => __( 'No mail templates found in Trash.', 'luca' ),
	);

	$mail_templates_args = array(
		'labels'             => $mail_templates_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-book-alt',
		'rewrite'            => array( 'slug' => 'mail-template' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'mail-template', $mail_templates_args );

	// Checklists CPT
	$checklist_labels = array(
		'name'                  => _x( 'Checklists', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Checklist', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Checklists', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Checklists', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Checklist', 'luca' ),
		'new_item'              => __( 'New Checklist', 'luca' ),
		'edit_item'             => __( 'Edit Checklist', 'luca' ),
		'view_item'             => __( 'View Checklist', 'luca' ),
		'all_items'             => __( 'All Checklists', 'luca' ),
		'search_items'          => __( 'Search Checklists', 'luca' ),
		'parent_item_colon'     => __( 'Parent Checklist:', 'luca' ),
		'not_found'             => __( 'No checklists found.', 'luca' ),
		'not_found_in_trash'    => __( 'No checklists found in Trash.', 'luca' ),
	);

	$checklist_args = array(
		'labels'             => $checklist_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-yes',
		'rewrite'            => array( 'slug' => 'checklist' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'checklist', $checklist_args );

	// Landing Pages CPT
	$landing_page_labels = array(
		'name'                  => _x( 'Landing Pages', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Landing Page', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Landing Pages', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Landing Pages', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Landing Page', 'luca' ),
		'new_item'              => __( 'New Landing Page', 'luca' ),
		'edit_item'             => __( 'Edit Landing Page', 'luca' ),
		'view_item'             => __( 'View Landing Page', 'luca' ),
		'all_items'             => __( 'All Landing Pages', 'luca' ),
		'search_items'          => __( 'Search Landing Pages', 'luca' ),
		'parent_item_colon'     => __( 'Parent Landing Page:', 'luca' ),
		'not_found'             => __( 'No landing pages found.', 'luca' ),
		'not_found_in_trash'    => __( 'No landing pages found in Trash.', 'luca' ),
	);

	$landing_page_args = array(
		'labels'             => $landing_page_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-desktop',
		'rewrite'            => array( 'slug' => 'landing-page' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'landing-page', $landing_page_args );
}

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

            echo '<li class="breadcrumb-item">The Directors</a></li>';
        }

        if( is_singular('post') ){

            echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title() .'</a></li>';
        }

        if( is_singular('testimonial') ){

            echo '<li class="breadcrumb-item active" aria-current="page">Testimonials</li>';
        }

        if( is_singular('resource') ){

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

        echo '</ol>
            </nav>';
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

// Theme Updater
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker('https://github.com/BizInk/radius-theme',__FILE__,'radius-theme');
// Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
// Using a private repository, specify the access token 
$myUpdateChecker->setAuthentication('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');