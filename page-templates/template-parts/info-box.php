<!-- infobox-section-start -->
<?php
$general_settings = get_sub_field('general_settings');
$alignment = get_sub_field_object('alignment');
$column_count = get_sub_field('column_count');
$info_box_bg_title = get_sub_field('info_box_bg_title');
$info_box_small_title = get_sub_field('info_box_small_title');
$info_box_title = get_sub_field('info_box_title');
$info_box_content = get_sub_field('info_box_content');
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

if( $alignment['value'] == "Align left" ){
	$align_class .= 'text-start';
}

if( $alignment['value'] == "Align right"  ){
	$align_class .= 'text-end';
}

if( $alignment['value'] == "Align center" ){
	$align_class .= 'text-center';
}

if( have_rows('information_box') ):
	?>
	<section class="infobox-section<?= $general_class; ?>">
		<div class="section-inner-wrapper">		
			<div class="full-width-wysiwyg text-center">
				<div class="container">
					<div class="editor-design">

						<div class="xl-font-wrap">
							<?php if( !empty($info_box_bg_title) ){ ?>
								
								<div class="xl-font"><?= $info_box_bg_title; ?></div>
							<?php }

							if( !empty($info_box_small_title) ){ ?>

								<h6><?= $info_box_small_title; ?></h6>
							<?php } ?>
						</div>

						<?php
						if( !empty($info_box_title) ){ ?>
							
							<h2><?= do_shortcode($info_box_title); ?></h2>
						<?php }

						echo $info_box_content; ?>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="infobox-warp">
					<div class="row gy-5 g-md-5">
						<?php if( have_rows('information_box') ):

							while( have_rows('information_box') ):
								the_row();

								$info_image = get_sub_field('info_image');
								$info_title = get_sub_field('info_title');
								$info_description = get_sub_field('info_description'); 
								$info_button = get_sub_field('info_button');
								?>
								<div class="<?php echo $column_count; ?>">
									<div class="info-box h-100 <?php echo $align_class ?>">

										<?php if( !empty($info_image) ) { ?>

											<img src="<?php echo $info_image; ?>" class="img-fluid" alt="">
										<?php }

										if( !empty($info_title) ) { ?>

											<h5><?php echo $info_title; ?></h5>
										<?php }

										if( !empty($info_description) ) { ?>

											<div class="info-description"><?php echo $info_description; ?></div>
										<?php }

										if( !empty($info_button['url']) && !empty($info_button['title']) ) { ?>

											<a href="<?php echo $info_button['url']; ?>" class="mt-2"><?php echo $info_button['title']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
										<?php } ?>
									</div>
								</div>
							<?php endwhile;
						endif; ?>
					</div>
				</div>
			</div>

			<?php
			$info_box_bottom_text = get_sub_field('info_box_bottom_text');
			$info_box_bottom_button = get_sub_field('info_box_bottom_button');

			if( !empty($info_box_bottom_text) || !empty($info_box_bottom_button['url']) ){
			?>
				<div class="cta">
					<?php if( !empty($info_box_bottom_text) ){ ?>

						<div class="editor-design">
							<?= $info_box_bottom_text; ?>
						</div>
					<?php }

					if( !empty($info_box_bottom_button['url']) && !empty($info_box_bottom_button['title']) ){ ?>

						<a href="<?= $info_box_bottom_button['url']; ?>" target="<?= $info_box_bottom_button['target']; ?>"> <?= $info_box_bottom_button['title']; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</section>
<?php endif; ?>
<!-- infobox-section-end -->