<!-- logo-section-start -->
<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';
$layout_type = get_sub_field('layout_type') ?? 'slider';
if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$logo_title = get_sub_field('logo_title');

if( have_rows('logo') ): ?>

    <section class="logo-section text-center<?php echo $general_class; ?>">
        <div class="full-width-wysiwyg text-center">
            <div class="container">
                <div class="editor-design">
                    <?php echo !empty($logo_title) ? '<h2>'. $logo_title .'</h2>' : null; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="<?php if($layout_type == 'grid'): echo 'logo-grid'; else: echo 'logo-slider'; endif; ?>">
                <?php while( have_rows('logo') ):
                    the_row();

                    $slider_image = get_sub_field('slider_image');
                    $logo_url = get_sub_field('add_logo_url');
                    $alt_text = get_sub_field('alt_text');

                    if( !empty($slider_image) ){ ?>

                        <div class="logo">
                            <?php if( !empty($logo_url) ){ ?>
                                
                                <a href="<?php echo $logo_url; ?>">
                            <?php } ?>
                                
                                <img src="<?php echo $slider_image; ?>" class="img-fluid" alt="<?php echo !empty($alt_text) ? $alt_text : 'Logo'; ?>">
                                
                            <?php if( !empty($logo_url) ){ ?>
                                
                                </a>
                            <?php } ?>
                        </div>
                    <?php }
                endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- logo-section-end -->