<?php
$general_settings = get_sub_field('general_settings');
$background_image = get_sub_field('background_image');
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

$team_bg_title = get_sub_field('team_bg_title');
$team_small_title = get_sub_field('team_small_title');
$team_title = get_sub_field('team_title');
$team_content = get_sub_field('team_content');
$team_members = get_sub_field('team_members');

if( !empty($team_members) ){ ?>

	<section class="team-section<?php echo $general_class; ?>"<?php echo $background_tag; ?>>
		<div class="container">		
			<div class="row align-items-center">
				<div class="col-md-8 col-lg-6">
					<div class="default-content">
						<div class="xl-font-wrap">
							<?php if( !empty($team_bg_title) ){ ?>

								<div class="xl-font"><?php echo $team_bg_title; ?></div>
							<?php }

							if( !empty($team_small_title) ){ ?>

								<h6><?php echo $team_small_title; ?></h6>
							<?php } ?>
						</div>
						
						<?php if( !empty($team_title) ){ ?>

							<h2><?php echo do_shortcode($team_title); ?></h2>
						<?php }

						echo do_shortcode($team_content); ?>
						
					</div>
				</div>

				<div class="col-md-12 col-lg-6">
					<div class="row g-5">
						<?php foreach( $team_members as $team_member ){

							$member_image = get_field('member_image', $team_member);
							$member_position = get_field('member_position', $team_member); ?>

							<div class="col-md-6 team-member">
								<?php if( !empty($member_image) ){ ?>

									<div class="member-img">						
										<img src="<?php echo $member_image; ?>" class="img-fluid" alt="<?php echo $team_member->post_title; ?>">
									</div>
								<?php } ?>

								<div class="two-col-badge">							
									<div class="member-details">
										<h3><?php echo $team_member->post_title; ?></h3>
										
										<?php if( !empty($member_position) ){ ?>

											<p><?php echo $member_position; ?></p>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</section>
<?php } ?>