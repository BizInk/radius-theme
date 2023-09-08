<?php
$general_settings = get_sub_field('general_settings');
$background_image = get_sub_field('background_image');
$tesimonials_post_obj = get_sub_field('tesimonials_post_obj');
$general_class = '';
$background_tag = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

if( !empty($background_image) ){

	$background_tag = ' style="background-image:url('. $background_image .')"';
}

$testimonial_section_bg_title = get_sub_field('testimonial_section_bg_title');
$testimonial_section_small_title = get_sub_field('testimonial_section_small_title');
$testimonial_section_title = get_sub_field('testimonial_section_title');
$testimonial_section_content = get_sub_field('testimonial_section_content');
$testimonial_section_button = get_sub_field('testimonial_section_button');

if ( !empty($tesimonials_post_obj) ) { ?>

	<section class="testimonial-list bg-img-position<?php echo $general_class; ?>"<?php echo $background_tag; ?>>
		<div class="full-width-wysiwyg text-center">
			<div class="container">
				<div class="editor-design">

						<div class="xl-font-wrap">
							<?php if( !empty($testimonial_section_bg_title) ){ ?>

								<div class="xl-font"><?php echo $testimonial_section_bg_title; ?></div>
							<?php }

							if( !empty($testimonial_section_small_title) ){ ?>
								
								<h6><?php echo $testimonial_section_small_title; ?></h6>
							<?php } ?>
						</div>
					<?php 
					if( !empty($testimonial_section_title) ){ ?>

						<h2><?php echo $testimonial_section_title; ?></h2>
					<?php }

					echo $testimonial_section_content; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row g-md-5">
				<?php foreach( $tesimonials_post_obj as $tesimonial ){

			        $reviewer_image = get_field('reviewer_image', $tesimonial);
					$reviewer_name = get_field('reviewer_name', $tesimonial);
					$reviewer_designation = get_field('reviewer_designation', $tesimonial);
					$review_content = get_field('review_content', $tesimonial);
					$rating_count = get_field('rating_count', $tesimonial); ?>
			        
			        <div class="col-md-6 col-lg-4 our-word">
						<a href="<?php echo get_permalink($tesimonial);?>" class="card-wrap text-decoration-none d-block">
							<?php if( !empty($rating_count) ){ ?>

								<div class="star-wrap">
									<?php luca_star_rating($rating_count); ?>
								</div>
							<?php }

							if( !empty($review_content) ){ ?>

								<div class="client-word-wrap"> <p><?php echo $review_content; ?></p></div>
							<?php } ?>

							<div class="client-details">
								<?php if( !empty($reviewer_image) ){ ?>

									<div class="icon-wrap">
										<img src="<?php echo $reviewer_image; ?>" alt="<?php echo $reviewer_name; ?>">
									</div>
								<?php } ?>

								<div class="client-content">
									<?php if( !empty($reviewer_name) ){ ?>

										<span><?php echo $reviewer_name; ?></span>
									<?php }

									if( !empty($reviewer_designation) ){ ?>

										<h5><?php echo $reviewer_designation; ?></h5>
									<?php } ?>
								</div>
							</div>
						</a>
					</div>
			    <?php } ?>			    
			</div>

			<?php if( !empty($testimonial_section_button['url']) && !empty($testimonial_section_button['title']) ){ ?>

				<a href="<?php echo $testimonial_section_button['url']; ?>" class="btn bg-img-position center-btn" target="<?php echo $testimonial_section_button['target']; ?>"><?php echo $testimonial_section_button['title']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
			<?php } ?>
		</div>
	</section>
<?php } ?>