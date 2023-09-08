<!-- logo-section-start -->
<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$logo_title = get_sub_field('logo_title');

if( have_rows('logo') ): ?>

    <section class="logo-section text-center<?= $general_class; ?>">
        <div class="full-width-wysiwyg text-center">
            <div class="container">
                <div class="editor-design">
                    <?= !empty($logo_title) ? '<h2>'. $logo_title .'</h2>' : null; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="logo-slider">
                <?php while( have_rows('logo') ):
                    the_row();

                    $slider_image = get_sub_field('slider_image');
                    $logo_url = get_sub_field('add_logo_url');

                    if( !empty($slider_image) ){ ?>

                        <div class="logo">
                            <a href="<?= $logo_url ?>">
                                <img src="<?php echo $slider_image; ?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    <?php }
                endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- logo-section-end -->