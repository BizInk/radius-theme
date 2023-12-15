<?php 
$newsletter_background_color = get_sub_field('newsletter_background_color');
$newsletter_title = get_sub_field('newsletter_title');
$newsletter_content = get_sub_field('newsletter_content');
$gravity_forms = get_sub_field('gravity_forms');
?>
<section class="newsletter-section">
    <div class="container">
        <div class="row flex-column text-center">
            <div class="col-md-9">
                <div class="full-width-wysiwyg text-left">
                    <div class="editor-design"> 
                        <div class="xl-font-wrap">
                        	<?php if( !empty($newsletter_bg_title) ){ ?>

								<div class="xl-font"><?php echo $newsletter_bg_title; ?></div>
							<?php }

							if( !empty($newsletter_small__title) ){ ?>

								<h6><?php echo $newsletter_small__title; ?></h6>
							<?php } ?>
						</div>

                        <?php if( !empty($newsletter_title) ){ ?>
                            
                            <h2><?php echo $newsletter_title; ?></h2>
                        <?php }

                        echo $newsletter_content; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-6">
                <?php echo !empty($gravity_forms) ? do_shortcode('[gravityform id="'. $gravity_forms .'" title="false"]') : ''; ?>
            </div>
        </div>
        
    </div>
</section>