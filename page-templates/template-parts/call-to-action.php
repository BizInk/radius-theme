<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$background_imagecolor = get_sub_field('background_imagecolor');
$background_image = get_sub_field('background_image');
$background_color = get_sub_field('background_color');
$background_image_url = isset($background_image['url']) ? $background_image['url'] : '';
$button_with_color = get_sub_field('button_with_color');
$call_to_action_second_btn = get_sub_field('call_to_action_second_btn');
$call_to_action_small_title = get_sub_field('call_to_action_small_title');
$call_to_action_title = get_sub_field('call_to_action_title');
$call_to_action_description = get_sub_field('call_to_action_description');

if( $background_imagecolor == 'Image' && !empty($background_image_url) ){

    $background_html = 'style="background-image: url('. $background_image_url .');"';
}else if( $background_imagecolor == 'Color' ){

    $background_html = 'style="background-color: '. $background_color .';"';
} ?>

<!-- call-to-action-section-start -->
<section class="call-to-action-section<?= $general_class; ?>" <?= $background_html; ?>>   

    <div class="full-width-wysiwyg text-left">
        <div class="container">
            <div class="editor-design">

                <?php if( !empty($call_to_action_small_title) ){ ?>

                    <p><?= $call_to_action_small_title; ?></p>
                <?php }

                if( !empty($call_to_action_title) ) { ?>

                    <h1><?php echo do_shortcode($call_to_action_title); ?></h1>
                <?php }

                if( !empty($call_to_action_description) ) { ?>

                    <p><?php echo $call_to_action_description; ?></p>
                <?php } ?>
            </div>
            <div class="d-md-flex btn-wrap">
                <?php if( !empty($button_with_color['url']) && !empty($button_with_color['title']) ) { ?>
                    
                    <a href="<?php echo $button_with_color['url']; ?>" target="<?php echo $button_with_color['target']; ?>" class="btn"><?php echo $button_with_color['title']; ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <?php }

                if( !empty($call_to_action_second_btn['url']) && !empty($call_to_action_second_btn['title']) ) { ?>
                    
                    <a href="<?= $call_to_action_second_btn['url']; ?>" target="<?= $call_to_action_second_btn['target']; ?>" class="btn ms-md-5 orange-btn"><?= $call_to_action_second_btn['title']; ?></a>
                <?php } ?>

            </div>
        </div>
    </div>          
</section>
<!-- call-to-action-section-end -->