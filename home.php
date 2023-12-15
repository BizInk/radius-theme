<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
get_template_part('global-templates/inner-banner');

$categories = get_terms([
  'taxonomy' => 'category',
  'hide_empty' => true,
]); ?>

<section class="four-col-team-section blog-listing-section comman-margin">    
    

    <div class="container">
		<?php if( !empty($categories) ){ ?>

			<div class="filter-wrap">
				<h4><?php _e('Select Category','radius-theme');?></h4>
					<span class="d-flex justify-content-between align-items-center dropdown"><?php _e('Select','radius-theme');?></span>
				<ul>
					<li class="active" data-cat="">ALL</li>
					<?php foreach( $categories as $category ){ ?>

						<li data-cat="<?= $category->term_id; ?>"><?= $category->name; ?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
		<div class="team-wrap blog-posts-cont">
			<?php _e('Loading...','radius-theme');?>
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