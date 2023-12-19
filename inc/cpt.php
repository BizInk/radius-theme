<?php

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

    $enable_weeklydigests = get_field('enable_weeklydigests', 'option') ?? true;
	$labels = array(
		'name'                  => _x( 'Weekly Digests', 'Weekly Digest General Name', 'radius-theme' ),
		'singular_name'         => _x( 'Weekly Digest', 'Weekly Digest Singular Name', 'radius-theme' ),
		'menu_name'             => __( 'Weekly Digests', 'radius-theme' ),
		'name_admin_bar'        => __( 'Weekly Digest', 'radius-theme' ),
		'archives'              => __( 'Weekly Digest Archives', 'radius-theme' ),
		'attributes'            => __( 'Digest Attributes', 'radius-theme' ),
		'parent_item_colon'     => __( 'Parent Digest:', 'radius-theme' ),
		'all_items'             => __( 'All Digests', 'radius-theme' ),
		'add_new_item'          => __( 'Add New Weekly Digest', 'radius-theme' ),
		'add_new'               => __( 'Add New', 'radius-theme' ),
		'new_item'              => __( 'New Digest', 'radius-theme' ),
		'edit_item'             => __( 'Edit Digest', 'radius-theme' ),
		'update_item'           => __( 'Update Digest', 'radius-theme' ),
		'view_item'             => __( 'View Weekly Digest', 'radius-theme' ),
		'view_items'            => __( 'View Weekly Digests', 'radius-theme' ),
		'search_items'          => __( 'Search Weekly Digest', 'radius-theme' ),
		'not_found'             => __( 'Not found', 'radius-theme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'radius-theme' ),
		'featured_image'        => __( 'Featured Image', 'radius-theme' ),
		'set_featured_image'    => __( 'Set featured image', 'radius-theme' ),
		'remove_featured_image' => __( 'Remove featured image', 'radius-theme' ),
		'use_featured_image'    => __( 'Use as featured image', 'radius-theme' ),
		'insert_into_item'      => __( 'Insert into Digest', 'radius-theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'radius-theme' ),
		'items_list'            => __( 'Weekly Digests list', 'radius-theme' ),
		'items_list_navigation' => __( 'Digests list navigation', 'radius-theme' ),
		'filter_items_list'     => __( 'Filter Digests list', 'radius-theme' ),
	);
	$args = array(
		'label'                 => __( 'Weekly Digest', 'radius-theme' ),
		'description'           => __( 'Weekly Digests', 'radius-theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'post-formats' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => $enable_weeklydigests,
		'show_ui'               => $enable_weeklydigests,
		'show_in_menu'          => $enable_weeklydigests,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-book-alt',
		'show_in_admin_bar'     => $enable_weeklydigests,
		'show_in_nav_menus'     => $enable_weeklydigests,
		'can_export'            => $enable_weeklydigests,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => $enable_weeklydigests,
		'rest_base'             => 'weekly_digests',
	);
	register_post_type( 'weekly-digest', $args );

	$labels = array(
		'name'                       => _x( 'Topics', 'Topics General Name', 'radius-theme' ),
		'singular_name'              => _x( 'Topic', 'Topic Singular Name', 'radius-theme' ),
		'menu_name'                  => __( 'Topic', 'radius-theme' ),
		'all_items'                  => __( 'All Topics', 'radius-theme' ),
		'parent_item'                => __( 'Parent Topic', 'radius-theme' ),
		'parent_item_colon'          => __( 'Parent Topic:', 'radius-theme' ),
		'new_item_name'              => __( 'New Topic Name', 'radius-theme' ),
		'add_new_item'               => __( 'Add New Topic', 'radius-theme' ),
		'edit_item'                  => __( 'Edit Topic', 'radius-theme' ),
		'update_item'                => __( 'Update Topic', 'radius-theme' ),
		'view_item'                  => __( 'View Topic', 'radius-theme' ),
		'separate_items_with_commas' => __( 'Separate Topics with commas', 'radius-theme' ),
		'add_or_remove_items'        => __( 'Add or remove Topics', 'radius-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'radius-theme' ),
		'popular_items'              => __( 'Popular Topics', 'radius-theme' ),
		'search_items'               => __( 'Search Topics', 'radius-theme' ),
		'not_found'                  => __( 'Not Found', 'radius-theme' ),
		'no_terms'                   => __( 'No Topics', 'radius-theme' ),
		'items_list'                 => __( 'Topics list', 'radius-theme' ),
		'items_list_navigation'      => __( 'Topics list navigation', 'radius-theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => $enable_weeklydigests,
		'show_ui'                    => $enable_weeklydigests,
		'show_admin_column'          => $enable_weeklydigests,
		'show_in_nav_menus'          => $enable_weeklydigests,
		'show_tagcloud'              => false,
		'show_in_rest'               => $enable_weeklydigests,
	);
	register_taxonomy( 'weekly-digest-topic', array( 'weekly-digest' ), $args );

	$labels = array(
		'name'                       => _x( 'Types', 'Types General Name', 'radius-theme' ),
		'singular_name'              => _x( 'Type Singular Name', 'Type', 'radius-theme' ),
		'menu_name'                  => __( 'Type', 'radius-theme' ),
		'all_items'                  => __( 'All Types', 'radius-theme' ),
		'parent_item'                => __( 'Parent Type', 'radius-theme' ),
		'parent_item_colon'          => __( 'Parent Type:', 'radius-theme' ),
		'new_item_name'              => __( 'New Type Name', 'radius-theme' ),
		'add_new_item'               => __( 'Add New Type', 'radius-theme' ),
		'edit_item'                  => __( 'Edit Type', 'radius-theme' ),
		'update_item'                => __( 'Update Type', 'radius-theme' ),
		'view_item'                  => __( 'View Type', 'radius-theme' ),
		'separate_items_with_commas' => __( 'Separate Types with commas', 'radius-theme' ),
		'add_or_remove_items'        => __( 'Add or remove Types', 'radius-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'radius-theme' ),
		'popular_items'              => __( 'Popular Types', 'radius-theme' ),
		'search_items'               => __( 'Search Types', 'radius-theme' ),
		'not_found'                  => __( 'Not Found', 'radius-theme' ),
		'no_terms'                   => __( 'No Types', 'radius-theme' ),
		'items_list'                 => __( 'Types list', 'radius-theme' ),
		'items_list_navigation'      => __( 'Types list navigation', 'radius-theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => $enable_weeklydigests,
		'show_ui'                    => $enable_weeklydigests,
		'show_admin_column'          => $enable_weeklydigests,
		'show_in_nav_menus'          => $enable_weeklydigests,
		'show_tagcloud'              => false,
		'show_in_rest'               => $enable_weeklydigests,
	);
	register_taxonomy( 'weekly-digest-type', array( 'weekly-digest' ), $args );

	$labels = array(
		'name'                       => _x( 'Regions', 'Regions', 'radius-theme' ),
		'singular_name'              => _x( 'Region', 'Region', 'radius-theme' ),
		'menu_name'                  => __( 'Region', 'radius-theme' ),
		'all_items'                  => __( 'All Regions', 'radius-theme' ),
		'parent_item'                => __( 'Parent Region', 'radius-theme' ),
		'parent_item_colon'          => __( 'Parent Region:', 'radius-theme' ),
		'new_item_name'              => __( 'New Region Name', 'radius-theme' ),
		'add_new_item'               => __( 'Add New Region', 'radius-theme' ),
		'edit_item'                  => __( 'Edit Region', 'radius-theme' ),
		'update_item'                => __( 'Update Region', 'radius-theme' ),
		'view_item'                  => __( 'View Region', 'radius-theme' ),
		'separate_items_with_commas' => __( 'Separate Regions with commas', 'radius-theme' ),
		'add_or_remove_items'        => __( 'Add or remove Regions', 'radius-theme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'radius-theme' ),
		'popular_items'              => __( 'Popular Regions', 'radius-theme' ),
		'search_items'               => __( 'Search Regions', 'radius-theme' ),
		'not_found'                  => __( 'Not Found', 'radius-theme' ),
		'no_terms'                   => __( 'No Regions', 'radius-theme' ),
		'items_list'                 => __( 'Regions list', 'radius-theme' ),
		'items_list_navigation'      => __( 'Regions list navigation', 'radius-theme' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => $enable_weeklydigests,
		'show_ui'                    => $enable_weeklydigests,
		'show_admin_column'          => $enable_weeklydigests,
		'show_in_nav_menus'          => $enable_weeklydigests,
		'show_tagcloud'              => false,
		'show_in_rest'               => $enable_weeklydigests,
	);
	register_taxonomy( 'weekly-digest-region', array( 'weekly-digest' ), $args );
    

	/**
	 * Post Type: Fixed Price Packages.
	 */
	$enable_fixedpricepackages = get_field('enable_packages', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Fixed Price Packages", "radius-theme" ),
		"singular_name" => esc_html__( "Fixed Price Package", "radius-theme" ),
		"menu_name" => esc_html__( "Fixed Price Packages", "radius-theme" ),
		"add_new" => esc_html__( "Add New Fixed Price Package", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Fixed Price Packages", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_fixedpricepackages,
		"publicly_queryable" => $enable_fixedpricepackages,
		"show_ui" => $enable_fixedpricepackages,
		"show_in_rest" => $enable_fixedpricepackages,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_fixedpricepackages,
		"show_in_nav_menus" => $enable_fixedpricepackages,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_fixedpricepackages,
		"rewrite" => [ "slug" => "fixed-price-packages", "with_front" => $enable_fixedpricepackages ],
		"query_var" => true,
		"menu_icon" => "dashicons-analytics",
		"supports" => [ "title", "thumbnail", "excerpt", "custom-fields", "author" ],
		"show_in_graphql" => $enable_fixedpricepackages,
	];

	register_post_type( "fixed-price-packages", $args );

	/**
	 * Post Type: Resources.
	 */
	$enable_resources = get_field('enable_resources', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Resources", "radius-theme" ),
		"singular_name" => esc_html__( "Resource", "radius-theme" ),
		"menu_name" => esc_html__( "Resources", "radius-theme" ),
		"all_items" => esc_html__( "All Resources", "radius-theme" ),
		"add_new" => esc_html__( "Add new", "radius-theme" ),
		"add_new_item" => esc_html__( "Add new Resource", "radius-theme" ),
		"edit_item" => esc_html__( "Edit Resource", "radius-theme" ),
		"new_item" => esc_html__( "New Resource", "radius-theme" ),
		"view_item" => esc_html__( "View Resource", "radius-theme" ),
		"view_items" => esc_html__( "View Resources", "radius-theme" ),
		"search_items" => esc_html__( "Search Resources", "radius-theme" ),
		"not_found" => esc_html__( "No Resources found", "radius-theme" ),
		"not_found_in_trash" => esc_html__( "No Resources found in trash", "radius-theme" ),
		"parent" => esc_html__( "Parent Resource:", "radius-theme" ),
		"featured_image" => esc_html__( "Featured image for this Resource", "radius-theme" ),
		"set_featured_image" => esc_html__( "Set featured image for this Resource", "radius-theme" ),
		"remove_featured_image" => esc_html__( "Remove featured image for this Resource", "radius-theme" ),
		"use_featured_image" => esc_html__( "Use as featured image for this Resource", "radius-theme" ),
		"archives" => esc_html__( "Resource archives", "radius-theme" ),
		"insert_into_item" => esc_html__( "Insert into Resource", "radius-theme" ),
		"uploaded_to_this_item" => esc_html__( "Upload to this Resource", "radius-theme" ),
		"filter_items_list" => esc_html__( "Filter Resources list", "radius-theme" ),
		"items_list_navigation" => esc_html__( "Resources list navigation", "radius-theme" ),
		"items_list" => esc_html__( "Resources list", "radius-theme" ),
		"attributes" => esc_html__( "Resources attributes", "radius-theme" ),
		"name_admin_bar" => esc_html__( "Resource", "radius-theme" ),
		"item_published" => esc_html__( "Resource published", "radius-theme" ),
		"item_published_privately" => esc_html__( "Resource published privately.", "radius-theme" ),
		"item_reverted_to_draft" => esc_html__( "Resource reverted to draft.", "radius-theme" ),
		"item_scheduled" => esc_html__( "Resource scheduled", "radius-theme" ),
		"item_updated" => esc_html__( "Resource updated.", "radius-theme" ),
		"parent_item_colon" => esc_html__( "Parent Resource:", "radius-theme" ),
	];
	$args = [
		"label" => esc_html__( "Resources", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_resources,
		"publicly_queryable" => $enable_resources,
		"show_ui" => $enable_resources,
		"show_in_rest" => $enable_resources,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_resources,
		"show_in_nav_menus" => $enable_resources,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_resources,
		"rewrite" => [ "slug" => "resource", "with_front" => $enable_resources ],
		"query_var" => $enable_resources,
		"menu_icon" => "dashicons-book",
		"supports" => [ "title", "editor", "thumbnail" ],
		"taxonomies" => [ "content-topic", "content-type" ],
		"show_in_graphql" => false,
	];

	register_post_type( "resource", $args );
	// Taxonomies for Resource Content Topic
	$content_topic_labels = array(
		'name'              => _x( 'Content Topics', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Content Topic', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Content Topics', 'radius-theme' ),
		'all_items'         => __( 'All Content Topics', 'radius-theme' ),
		'parent_item'       => __( 'Parent Content Topic', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Content Topic:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Content Topic', 'radius-theme' ),
		'update_item'       => __( 'Update Content Topic', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Content Topic', 'radius-theme' ),
		'new_item_name'     => __( 'New Content Topic Name', 'radius-theme' ),
		'not_found'         => __( 'No Content Topics Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Content Topics', 'radius-theme' ),
		'menu_name'         => __( 'Content Topics', 'radius-theme' ),
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
		'name'              => _x( 'Content Types', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Content Type', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Content Types', 'radius-theme' ),
		'all_items'         => __( 'All Content Types', 'radius-theme' ),
		'parent_item'       => __( 'Parent Content Type', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Content Type:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Content Type', 'radius-theme' ),
		'update_item'       => __( 'Update Content Type', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Content Type', 'radius-theme' ),
		'new_item_name'     => __( 'New Content Type Name', 'radius-theme' ),
		'not_found'         => __( 'No Content Types Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Content Types', 'radius-theme' ),
		'menu_name'         => __( 'Content Types', 'radius-theme' ),
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

	/**
	 * Post Type: Testimonials.
	 */
	$enable_testimonials = get_field('enable_testimonials', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Testimonials", "radius-theme" ),
		"singular_name" => esc_html__( "Testimonial", "radius-theme" ),
		"menu_name" => esc_html__( "Testimonials", "radius-theme" ),
		"add_new" => esc_html__( "Add New Testimonial", "radius-theme" ),
		"add_new_item" => esc_html__( "Add New Testimonial", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Testimonials", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_testimonials,
		"publicly_queryable" => $enable_testimonials,
		"show_ui" => $enable_testimonials,
		"show_in_rest" => $enable_testimonials,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_testimonials,
		"show_in_nav_menus" => $enable_testimonials,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_testimonials,
		"rewrite" => [ "slug" => "testimonial", "with_front" => $enable_testimonials ],
		"query_var" => $enable_testimonials,
		"menu_icon" => "dashicons-testimonial",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "author" ],
		"show_in_graphql" => false,
	];

	register_post_type( "testimonial", $args );

	/**
	 * Post Type: Team Members.
	 */
	$enable_teammembers = get_field('enable_teammembers', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Team Members", "radius-theme" ),
		"singular_name" => esc_html__( "Team Member", "radius-theme" ),
		"menu_name" => esc_html__( "Team Members", "radius-theme" ),
		"add_new" => esc_html__( "Add New Team Member", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Team Members", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_teammembers,
		"publicly_queryable" => $enable_teammembers,
		"show_ui" => $enable_teammembers,
		"show_in_rest" => $enable_teammembers,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_teammembers,
		"show_in_nav_menus" => $enable_teammembers,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_teammembers,
		"rewrite" => [ "slug" => "team-member", "with_front" => $enable_teammembers ],
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "team-member", $args );


	// Taxonomies for Team members Location
	$location_labels = array(
		'name'              => _x( 'Locations', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Location', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Locations', 'radius-theme' ),
		'all_items'         => __( 'All Locations', 'radius-theme' ),
		'parent_item'       => __( 'Parent Location', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Location:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Location', 'radius-theme' ),
		'update_item'       => __( 'Update Location', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Location', 'radius-theme' ),
		'new_item_name'     => __( 'New Location Name', 'radius-theme' ),
		'not_found'         => __( 'No Locations Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Locations', 'radius-theme' ),
		'menu_name'         => __( 'Locations', 'radius-theme' ),
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
		'name'              => _x( 'Firms', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Firm', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Firms', 'radius-theme' ),
		'all_items'         => __( 'All Firms', 'radius-theme' ),
		'parent_item'       => __( 'Parent Firm', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Firm:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Firm', 'radius-theme' ),
		'update_item'       => __( 'Update Firm', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Firm', 'radius-theme' ),
		'new_item_name'     => __( 'New Firm Name', 'radius-theme' ),
		'not_found'         => __( 'No Firms Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Firms', 'radius-theme' ),
		'menu_name'         => __( 'Firms', 'radius-theme' ),
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
		'name'              => _x( 'Services', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Service', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Services', 'radius-theme' ),
		'all_items'         => __( 'All Services', 'radius-theme' ),
		'parent_item'       => __( 'Parent Service', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Service:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Service', 'radius-theme' ),
		'update_item'       => __( 'Update Service', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Service', 'radius-theme' ),
		'new_item_name'     => __( 'New Service Name', 'radius-theme' ),
		'not_found'         => __( 'No Services Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Services', 'radius-theme' ),
		'menu_name'         => __( 'Services', 'radius-theme' ),
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
		'name'              => _x( 'Specialisations', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Specialisation', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Specialisations', 'radius-theme' ),
		'all_items'         => __( 'All Specialisations', 'radius-theme' ),
		'parent_item'       => __( 'Parent Specialisation', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Specialisation:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Specialisation', 'radius-theme' ),
		'update_item'       => __( 'Update Specialisation', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Specialisation', 'radius-theme' ),
		'new_item_name'     => __( 'New Specialisation Name', 'radius-theme' ),
		'not_found'         => __( 'No Specialisations Found', 'radius-theme' ),
		'back_to_items'     => __( 'Back to Specialisations', 'radius-theme' ),
		'menu_name'         => __( 'Specialisations', 'radius-theme' ),
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

	/**
	 * Post Type: Mail Templates.
	 */
	$enable_mailtemplates = get_field('enable_mail_posts_mail_templates', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Mail Templates", "radius-theme" ),
		"singular_name" => esc_html__( "Mail Template", "radius-theme" ),
		"menu_name" => esc_html__( "Mail Templates", "radius-theme" ),
		"add_new" => esc_html__( "Add New Mail Template", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Mail Templates", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_mailtemplates,
		"publicly_queryable" => $enable_mailtemplates,
		"show_ui" => $enable_mailtemplates,
		"show_in_rest" => $enable_mailtemplates,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_mailtemplates,
		"show_in_nav_menus" => $enable_mailtemplates,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_mailtemplates,
		"rewrite" => [ "slug" => "mail-template", "with_front" => $enable_mailtemplates ],
		"query_var" => $enable_mailtemplates,
		"menu_icon" => "dashicons-book-alt",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "mail-template", $args );

	/**
	 * Post Type: Checklists.
	 */
	$enable_checklists = get_field('enable_checklists', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Checklists", "radius-theme" ),
		"singular_name" => esc_html__( "Checklist", "radius-theme" ),
		"menu_name" => esc_html__( "Checklists", "radius-theme" ),
		"add_new" => esc_html__( "Add New Checklist", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Checklists", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_checklists,
		"publicly_queryable" => $enable_checklists,
		"show_ui" => $enable_checklists,
		"show_in_rest" => $enable_checklists,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => $enable_checklists,
		"show_in_nav_menus" => $enable_checklists,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => $enable_checklists,
		"rewrite" => [ "slug" => "checklist", "with_front" => $enable_checklists ],
		"query_var" => $enable_checklists,
		"menu_icon" => "dashicons-yes",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"show_in_graphql" => false,
	];

	register_post_type( "checklist", $args );

	/**
	 * Post Type: Landing Pages.
	 */
	$enable_landingpages = get_field('enable_landingpages', 'option') ?? true;
	$labels = [
		"name" => esc_html__( "Landing Pages", "radius-theme" ),
		"singular_name" => esc_html__( "Landing Page", "radius-theme" ),
		"menu_name" => esc_html__( "Landing Pages", "radius-theme" ),
		"add_new_item" => esc_html__( "Add New Landing Page", "radius-theme" ),
	];

	$args = [
		"label" => esc_html__( "Landing Pages", "radius-theme" ),
		"labels" => $labels,
		"description" => "",
		"public" => $enable_landingpages,
		"publicly_queryable" => $enable_landingpages,
		"show_ui" => $enable_landingpages,
		"show_in_rest" => $enable_landingpages,
		"has_archive" => false,
		"show_in_menu" => $enable_landingpages,
		"show_in_nav_menus" => $enable_landingpages,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"can_export" => $enable_landingpages,
		"rewrite" => [ "slug" => "landing-page", "with_front" => $enable_landingpages ],
		"query_var" => $enable_landingpages,
		"menu_icon" => "dashicons-desktop",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
	];

	register_post_type( "landing-page", $args );

	// Video registration
	$enable_videos = get_field('enable_videos', 'option') ?? true;
	$videos_labels = array(
		'name'                  => _x( 'Videos', 'Post type general name', 'radius-theme' ),
		'singular_name'         => _x( 'Video', 'Post type singular name', 'radius-theme' ),
		'menu_name'             => _x( 'Videos', 'Admin Menu text', 'radius-theme' ),
		'name_admin_bar'        => _x( 'Video', 'Add New on Toolbar', 'radius-theme' ),
		'add_new'               => __( 'Add New', 'radius-theme' ),
		'add_new_item'          => __( 'Add New Video', 'radius-theme' ),
		'new_item'              => __( 'New Video', 'radius-theme' ),
		'edit_item'             => __( 'Edit Video', 'radius-theme' ),
		'view_item'             => __( 'View Video', 'radius-theme' ),
		'all_items'             => __( 'All Videos', 'radius-theme' ),
		'search_items'          => __( 'Search Videos', 'radius-theme' ),
		'parent_item_colon'     => __( 'Parent Videos:', 'radius-theme' ),
		'not_found'             => __( 'No videos found.', 'radius-theme' ),
		'not_found_in_trash'    => __( 'No videos found in Trash.', 'radius-theme' )
	);

	$videos_args = array(
		'labels'             => $videos_labels,
		'public'             => $enable_videos,
		'publicly_queryable' => $enable_videos,
		'menu_icon'			 => 'dashicons-video-alt3',
		'show_ui'            => $enable_videos,
		'show_in_menu'       => $enable_videos,
		'query_var'          => $enable_videos,
		'rewrite'            => array( 'slug' => 'video' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'video', $videos_args );

	$videos_cat = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'radius-theme' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'radius-theme' ),
		'search_items'      => __( 'Search Categories', 'radius-theme' ),
		'all_items'         => __( 'All Categories', 'radius-theme' ),
		'parent_item'       => __( 'Parent Category', 'radius-theme' ),
		'parent_item_colon' => __( 'Parent Category:', 'radius-theme' ),
		'edit_item'         => __( 'Edit Category', 'radius-theme' ),
		'update_item'       => __( 'Update Category', 'radius-theme' ),
		'add_new_item'      => __( 'Add New Category', 'radius-theme' ),
		'new_item_name'     => __( 'New Category Name', 'radius-theme' ),
		'menu_name'         => __( 'Category', 'radius-theme' ),
	);

	$videos_cat_args = array(
		'hierarchical'      => true,
		'labels'            => $videos_cat,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'video_cat' ),
	);

	register_taxonomy( 'video_cat', array( 'video' ), $videos_cat_args );
}