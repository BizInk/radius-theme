<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
get_template_part('global-templates/inner-banner');
?>

<div id="content" class="wrapper blog-wraper comman-margin" id="single-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

		<div class="row justify-content-between">
			<div class="col-8">
				<main class="site-main" id="main">
					<?php
					while (have_posts()) {
						the_post();
						get_template_part('loop-templates/content', 'single'); 

					}
					?>
				</main><!-- #main -->
			</div>

			<?php get_template_part('global-templates/right-sidebar-check'); ?>
		</div><!-- .row -->		
		
	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
