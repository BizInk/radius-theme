<?php
/**
* Template Name: Videos
*
* Template to display listing of team members page
*
* @package Understrap
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
include get_template_directory() . '/inc/password-check.php';

get_header();
get_template_part('global-templates/inner-banner');

$videos_top_small_title = get_field('videos_top_small_title');
$videos_top_title = get_field('videos_top_title');
$videos_top_desc = get_field('videos_top_desc');

$videos_featured_video = get_field('videos_featured_video');
if( !empty($videos_featured_video) ){

	$featured_video_url = get_field('video_url', $videos_featured_video);
} ?>

<section class="featured-video-section comman-margin">
	<div class="full-width-wysiwyg text-center">
		<div class="container">
			<div class="editor-design">
				<?php if( !empty($videos_top_small_title) ){ ?>

					<h6><?= $videos_top_small_title; ?></h6>
				<?php }

				if( !empty($videos_top_title) ){ ?>

					<h2><?= $videos_top_title; ?></h2>
				<?php }

				echo $videos_top_desc; ?>
			</div>
		</div>
	</div>
	
	<?php if( !empty($videos_featured_video) && !empty($featured_video_url) && has_post_thumbnail($videos_featured_video) ){ ?>

		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<a href="<?= $featured_video_url; ?>" data-fancybox="">
						<div class="video-wrap">
							<img src="<?= get_the_post_thumbnail_url($videos_featured_video); ?>" class="img-fluid lazyloaded" alt="">
							<i class="fa fa-play-circle" aria-hidden="true"></i>
						</div>
					</a>
				</div>
				<div class="col-md-6 video-content">
					<h2><?= $videos_featured_video->post_title; ?></h2>
					<div class="editor-design">
						<?= $videos_featured_video->post_content; ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</section>

<?php 
$categories = get_terms( array(
    'taxonomy'   => 'video_cat',
    'hide_empty' => true,
) );

$ppp = 12;
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
$prev = $pageno-1;
$next = $pageno+1;
$select_cat = isset($_GET['cat']) ? $_GET['cat'] : '';

$videos_args = array(
	'post_type' => 'video',
	'post_status' => 'publish',
	'posts_per_page' => $ppp,
	'order' => 'DESC',
	'offset' => ($ppp*($pageno-1)),
);

if( !empty($select_cat) ){

	$videos_args['tax_query'] = array(
		'relation' => 'AND',
		array(
            'taxonomy' => 'video_cat',
            'field' => 'slug',
            'terms' => array($_GET['cat']),
            'operator' => 'IN'
        ),
	);
}

$videos = new WP_Query($videos_args);

$total_videos = $videos->found_posts;
$total_pages = ceil($total_videos/$ppp);

if( $videos->have_posts() ){ ?>

	<section class="four-col-team-section blog-listing-section video-section comman-margin">
		<div class="container">

			<?php if( !empty($categories) ){ ?>

				<div class="filter-wrap">
					<h4>Select Category</h4>
					<span class="d-flex justify-content-between align-items-center dropdown"><?= !empty($select_cat) ? ucfirst($select_cat) : 'ALL'; ?></span>
					<ul class="video-filter">
						<li<?= $select_cat == '' ? ' class="active"' : null; ?> data-cat="" data-url="<?php the_permalink(); ?>">ALL</li>
						
						<?php foreach( $categories as $category ){ ?>
							
							<li<?= $select_cat == $category->slug ? ' class="active"' : null; ?> data-cat="<?= $category->slug; ?>" data-url="?cat=<?= $category->slug; ?>"><?= $category->name; ?></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>

			<div class="team-wrap">
				<div class="row g-lg-5">
					<?php while( $videos->have_posts() ){
						$videos->the_post();

						$video_url = get_field('video_url', get_the_id());

						if( !empty($video_url) && has_post_thumbnail() ){ ?>
						
							<div class="col-md-6 col-xl-4 team-member">
								<div class="team-member-wrap">												
									<a href="<?= $video_url; ?>" data-fancybox="" class="member-img">
										<div class="video-wrap">
											<img src="<?= get_the_post_thumbnail_url(); ?>" class="img-fluid lazyloaded" alt="<?php the_title(); ?>">
											<i class="fa fa-play-circle" aria-hidden="true"></i>
										</div>
									</a>
									<div class="member-details">							
										<h4><?php the_title(); ?></h4>
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						<?php }
					} ?>			
				</div>

				<?php if( $total_videos > $ppp ){ ?>

					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<?php if( $prev > 0 ){ ?>
								
								<li class="page-item"><a class="page-link" href="?pageno=<?= $prev; ?><?= !empty($select_cat) ? '&cat=' . $select_cat : null; ?>">Previous</a></li>
							<?php }

							for( $i=1; $i<=$total_pages; $i++ ){ ?>

								<li class="page-item<?= $pageno == $i ? ' active' : null; ?>">
									<a class="page-link" 
										<?php if( $i != $pageno ){ ?>

											href="?pageno=<?= $i; ?><?= !empty($select_cat) ? '&cat=' . $select_cat : null; ?>"
										<?php }else{ ?>

											href="javacript:void(0);"
										<?php } ?>
										>
										<?= $i; ?>
									</a>
								</li>
							<?php }

							if( $next > $pageno && $next <= $total_pages ){ ?>

								<li class="page-item"><a class="page-link" href="?pageno=<?= $next; ?><?= !empty($select_cat) ? '&cat=' . $select_cat : null; ?>">Next</a></li>
							<?php } ?>
						</ul>
					</nav>
				<?php } ?>
			</div>
		</div>
	</section>
<?php }

wp_reset_query(); ?>

<script>
	if( jQuery('.video-filter').length > 0 ){

		jQuery(document).on('click', '.video-filter li', function(){
			var cat = jQuery(this).attr('data-cat');
			var url = jQuery(this).attr('data-url');

			window.location.href = url;
		});
	}
</script>

<?php get_footer(); ?>