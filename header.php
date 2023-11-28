<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$bootstrap_version = get_theme_mod('understrap_bootstrap_version', 'bootstrap5');
$navbar_type       = get_theme_mod('understrap_navbar_type', 'collapse');

$company_phone = get_field('company_phone', 'options');
$company_email = get_field('company_email', 'options');

$facebook = get_field('facebook', 'options'); 
$twitter = get_field('twitter', 'options'); 
$linkedin = get_field('linkedin', 'options'); 
$instagram = get_field('instagram', 'options');
$youtube = get_field('youtube', 'options');
$header_client_button = get_field('header_client_button', 'options');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php
	$header_custom_css = get_field('header_custom_css', 'option');
	
	if( !empty($header_custom_css) ){

		echo '<style>'. $header_custom_css .'</style>';
	} ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<!-- ******************* The Navbar Area ******************* -->
		<header id="wrapper-navbar" class="">


			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>
			<div class="top-nav">
				<div class="container">																
					<div class="header-contact">
						<ul>
							<?php if( !empty($company_phone) ){ ?>
								
								<li><a href="tel:<?= $company_phone; ?>" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i><?= $company_phone; ?></a></li>						
							<?php }
							
							if( !empty($company_email) ){ ?>
							
								<li><a href="mailto:<?= $company_email; ?>" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i><?= $company_email; ?></a></li>
							<?php } ?>
						</ul>

						<!-- Social icons -->
						<nav class="social-nav">
							<ul>
								<?php if( !empty($facebook) ){ ?>
									
									<li><a href="<?= $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<?php }

								if( !empty($twitter) ){ ?>
									
									<li><a href="<?= $twitter; ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
  									<path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
									</svg></a></li>
								<?php }

								if( !empty($linkedin) ){ ?>
									
									<li><a href="<?= $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<?php }

								if( !empty($instagram) ){ ?>
									
									<li><a href="<?= $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<?php } 

								if( !empty($youtube) ){ ?>
									
									<li><a href="<?= $youtube; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
								<?php }

								 ?>
							</ul>
						</nav>
					</div>	
					<div class="client-btn-wrap">					
						<div class="client-area-wrap">
							<div class="client-area-anchor">Client <i class="fa fa-bars" aria-hidden="true"></i></div>
							<div class="client-area-cont">
								<?php
								if( has_nav_menu('client-area') ){

									wp_nav_menu(
										array(
											'theme_location' => 'client-area',
											'menu_class' => 'menu',
											'menu_id'	=> 'menu-client-area',
											'fallback_cb' => false
										)
									);
								} ?>
							</div>
						</div>

						<?php if( !empty($header_client_button['url']) && !empty($header_client_button['title']) ){ ?>

							<a href="<?php echo $header_client_button['url']; ?>" class="btn" target="<?php echo $header_client_button['target']; ?>"><?php echo $header_client_button['title']; ?></a>
						<?php } ?>
					</div>										
				</div>
			</div>
			<?php get_template_part('global-templates/navbar', $navbar_type . '-' . $bootstrap_version); ?>
		</header>