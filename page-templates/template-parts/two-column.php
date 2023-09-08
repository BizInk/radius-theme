<?php 
$general_settings = get_sub_field('general_settings');  
$background_color = get_sub_field('background_color');  
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

if( have_rows('column_section') ):

	while( have_rows('column_section') ):
		the_row();

		$gravity_forms_show = get_sub_field('gravity_forms_show');
		$column_bg_title = get_sub_field('column_bg_title');
		$gravity_forms = get_sub_field('gravity_forms');
		
		$column_trophy_image = get_sub_field('column_trophy_image');
		$column_trophy_title = get_sub_field('column_trophy_title');
		$column_trophy_subtitle = get_sub_field('column_trophy_subtitle');
		 ?>

		<section class="two-col-section<?= $general_class; ?>"<?= !empty($background_color) ? ' style="background-color:'. $background_color .';"' : null; ?> >
			<div class="container">  
				<?php $column_image_position = '';

				if( get_sub_field('column_image_position') == 'right' ){

					$column_image_position = 'flex-md-row';
				} else if( get_sub_field('column_image_position') == 'left' ){

					$column_image_position = 'flex-md-row-reverse';
				} ?>

				<div class="row align-item-center <?php echo $column_image_position; ?> flex-column-reverse">
					<div class="col-md-6 col-left mb-5 mb-md-0">
						<div class="col-content default-content">

							<div class="xl-font-wrap">
								<?php if( !empty($column_bg_title) ) { ?>

									<div class="xl-font"><?= $column_bg_title; ?></div>
								<?php }

								if( get_sub_field('column_small_title') ) { ?>
								
									<h6><?php echo get_sub_field('column_small_title'); ?></h6>
								<?php } ?>
							</div>

							<?php
							if( get_sub_field('column_hero_title') ) { ?>
								
								<h2><?php echo do_shortcode(get_sub_field('column_hero_title')); ?></h2>
							<?php }

							if( get_sub_field('column_hero_description') ) {

								echo get_sub_field('column_hero_description');
							}

							if( !empty($gravity_forms_show) ){

								echo do_shortcode('[gravityform id="'. $gravity_forms .'" title="false"]');
							}

							$column_hero_button = get_sub_field('column_hero_button');

							if( !empty($column_hero_button['url']) && !empty($column_hero_button['title']) ){ ?>

								<a href="<?= $column_hero_button['url']; ?>" class="btn orange-btn" target="<?= $column_hero_button['target']; ?>"><?= $column_hero_button['title']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							<?php } ?>

						</div>
					</div>
					<div class="col-md-6 col-right mb-5 mb-md-0">

						<?php if( get_sub_field('column_hero_image') ) { ?>
							<div class="two-col-img-wrap">				
								<img src="<?php echo get_sub_field('column_hero_image'); ?>" class="img-fluid" alt="">

								<?php if( !empty($column_trophy_image['url']) || !empty($column_trophy_title) || !empty($column_trophy_subtitle) ){ ?>
									
									<div class="two-col-badge">
										<?php if( !empty($column_trophy_image['url']) ){ ?>

											<img src="<?php echo $column_trophy_image['url']; ?>" alt="<?php echo $column_trophy_image['alt']; ?>" title="<?php echo $column_trophy_image['title']; ?>">
										<?php } ?>

										<div>
											<?php if( !empty($column_trophy_title) ){ ?>

												<h3><?= $column_trophy_title; ?></h3>
											<?php }

											if( !empty($column_trophy_subtitle) ){ ?>

												<p><?= $column_trophy_subtitle; ?></p>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile;
endif; ?>