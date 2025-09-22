<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
get_template_part('global-templates/inner-banner'); ?>

<section id="content" class="four-col-team-section blog-listing-section comman-margin">    
    

    <div class="container">
		<div class="team-wrap blog-posts-cont">
			Loading...
		</div>

		<script>
			// Script to load more posts
			jQuery(document).on('click', '.posts-loadmore', function(e){
				e.preventDefault();

				var pagenumber = parseInt(jQuery(this).attr('data-pagenumber'));
				pagenumber = parseInt(pagenumber+1);

				jQuery('[data-pagenumber="posts'+ pagenumber +'"]').show();

				jQuery(this).attr('data-pagenumber', pagenumber);

				pagenumber = parseInt(pagenumber+1);

				if( jQuery('[data-pagenumber="posts'+ pagenumber +'"]').length == 0 ){

					jQuery(this).remove();
				}
			});
		</script>  
    </div>
</section>

<?php
get_footer(); ?>