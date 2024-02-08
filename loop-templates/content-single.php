<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if(get_post_type() != "weekly-digest"): echo get_the_post_thumbnail( $post->ID, 'large' ); endif; ?>

	<div class="entry-content default-content">
		<?php
		the_content();
		understrap_link_pages();
		?>
	</div><!-- .entry-content --> 

</article><!-- #post-## -->
