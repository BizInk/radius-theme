<?php
/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after
*
* @package Understrap
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;
$container = get_theme_mod('understrap_container_type');
get_template_part('sidebar-templates/sidebar', 'footerfull');

$footer_logo = get_field('footer_logo', 'options');
$footer_text = get_field('footer_text', 'options');
$column_1_title = get_field('column_1_title', 'options');
$column_2_title = get_field('column_2_title', 'options');
$column_3_title = get_field('column_3_title', 'options');
$column_4_title = get_field('column_4_title', 'options');

$footer_shape_color_1 = get_field('footer_shape_color_1', 'options');
$footer_shape_color_2 = get_field('footer_shape_color_2', 'options');

$company_phone = get_field('company_phone', 'options');
$company_email = get_field('company_email', 'options');

$facebook = get_field('facebook', 'options'); 
$twitter = get_field('twitter', 'options'); 
$linkedin = get_field('linkedin', 'options');
$instagram = get_field('instagram', 'options');
$youtube = get_field('youtube', 'options');

$disclaimer_information = get_field('disclaimer_information', 'options');
$copyright_information = get_field('copyright_information', 'options');

$global_logo_bg_title = get_field('global_logo_bg_title', 'options');
$global_logo_small_title = get_field('global_logo_small_title', 'options');
?>

<footer>
	<div class="container">
		<div class="row footer-wrap mb-5 pb-md-5 text-center">
			<?php if( !empty($footer_logo['url']) ){ ?>

					<div class="footer-logo">
						<a href="<?php echo site_url(); ?>"><img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt'] ? $footer_logo['alt'] : bloginfo( 'name' ); ?>"></a>
					</div>
				<?php } ?>
		</div>
		<div class="row footer-wrap">
			<div class="col-12 col-md-6 col-xl-3 mb-4 mb-lg-0 pe-md-5">
				<?php if( !empty($column_1_title) ){ ?>

					<h5><?php echo $column_1_title; ?></h5>
				<?php }

				if( !empty($footer_text) ){ ?>

					<address>
						<?php echo $footer_text; ?>
					</address>
				<?php } ?>
			</div>

			<div class="col-12 col-md-6 col-xl-4 col-xxl-3 mb-5 mb-lg-0">
				<?php if( !empty($column_2_title) ){ ?>

					<h5><?php echo $column_2_title; ?></h5>
				<?php } ?>

				<nav class="contact-details">
					<ul>
						<?php if( !empty($company_phone) ){ ?>
								
							<li><a href="tel:<?php echo $company_phone; ?>" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $company_phone; ?></a></li>						
						<?php }
						
						if( !empty($company_email) ){ ?>
						
							<li><a href="mailto:<?php echo $company_email; ?>" target="_blank"> <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $company_email; ?></a></li>
						<?php } ?>
					</ul>
				</nav>
			</div>

			<div class="col-12 col-md-6 col-xl-2 col-xxl-3 mb-5 mb-lg-0">
				<?php if( !empty($column_3_title) ){ ?>

					<h5><?php echo $column_3_title; ?></h5>
				<?php } ?>

				<nav class="social-nav">
					<ul>
						<?php if( !empty($facebook) ){ ?>
								
							<li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
						<?php }

						if( !empty($twitter) ){ ?>
							
							<li><a href="<?php echo $twitter; ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
 							 <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
							</svg></a></li>
						<?php }

						if( !empty($linkedin) ){ ?>
							
							<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
						<?php }

						if( !empty($instagram) ){ ?>

							<li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<?php } 
						
						if( !empty($youtube) ){ ?>
						
							<li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>	
						<?php } ?>
						
					</ul>
				</nav>
			</div>

			<div class="col-12 col-md-6 col-xl-3 col-xxl-3">
				<?php if( !empty($column_4_title) ){ ?>

					<h5><?php echo $column_4_title; ?></h5>
				<?php }

				if( has_nav_menu('footer-menu') ){

					wp_nav_menu(
						array(
							'container'		  => 'nav',
							'theme_location'  => 'footer-menu',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => '',
							'fallback_cb'     => '',
							'menu_id'         => 'footer-menu'
						)
					);
				} ?>
			</div>
		</div>

		<?php if( !empty($disclaimer_information) ){ ?>

			<div class="disclamer-wrap">
				<p><?php echo $disclaimer_information; ?></p>
			</div>
		<?php } ?>
	</div>

	<?php if( !empty($copyright_information) ){ ?>

		<div class="social-wrap">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="copyright-wrap" style="color:<?php echo get_field('copyright_color', 'options') ? get_field('copyright_color', 'options') : '#fefefe'; ?>;">
							<?php echo do_shortcode($copyright_information); ?> | <a style="color:<?php echo get_field('copyright_color', 'options') ? get_field('copyright_color', 'options') : '#fefefe'; ?>;" target="_blank" href="https://www.bizinkonline.com"><?php _e('Website By Bizink','radius-theme');?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</footer>
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>

<script>

	function fetch_blog_posts(category='', pagenumber=1){

		var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
        
		// Check if we are on correct page
		if( jQuery('.blog-posts-cont').length ){

			if( pagenumber == 1 ){

				jQuery('.blog-posts-cont').html('Loading...');
			}else{
				jQuery('.load-more').text('Loading...');
			}
           
			jQuery.ajax({
				type : "post",
				url  : ajaxurl,
				data : {action: "fetch_blog_posts", category: category, pagenumber: pagenumber},
				success: function(response) {
					var result = JSON.parse(response);

					if( pagenumber == 1 ){
						jQuery('.blog-posts-cont').html(result.content);
					}else{
						jQuery('.load-more').remove();
						jQuery('.blog-posts-cont .row').append(result.content);
					}
					jQuery('.blog-posts-cont').append(result.load_more);
				}
			}); 
		}
	}
</script>

<?php if( is_home() ){ ?>

	<script>

		fetch_blog_posts(); 

		jQuery(document).on('click', '.filter-wrap li', function(e){
			e.preventDefault();

			jQuery('.filter-wrap li.active').removeClass('active');
			jQuery(this).addClass('active');

			fetch_blog_posts(jQuery(this).attr('data-cat'));
		});

		jQuery(document).on('click', '.load-more', function(e){
			e.preventDefault();

			fetch_blog_posts(jQuery('.filter-wrap li.active').attr('data-cat'), jQuery(this).attr('data-pagenumber'));
		});
	</script>
<?php }

if( is_category() ){

	$current_category = get_query_var('cat'); ?>

	<script>
		var current_cat = '<?php echo $current_category; ?>';
		fetch_blog_posts(current_cat);

		jQuery(document).on('click', '.load-more', function(e){
			e.preventDefault();

			fetch_blog_posts(current_cat, jQuery(this).attr('data-pagenumber'));
		});
	</script>
<?php } ?>

</body>
</html>