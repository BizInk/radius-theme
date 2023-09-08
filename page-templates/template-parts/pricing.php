<?php
$general_settings = get_sub_field('general_settings'); 
$choose_pricing_packeges = get_sub_field('choose_pricing_packeges');
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$pricing_sub_title = get_sub_field('pricing_sub_title');
$pricing_title = get_sub_field('pricing_title');
$pricing_description = get_sub_field('pricing_description');
$columns_classes = 'col-md-6 col-lg-4';
?>


<section class="pricing-section<?= $general_class; ?>">
    <div class="full-width-wysiwyg text-center">
        <div class="container">
            <div class="editor-design">
                <?php if($pricing_sub_title) { ?>
                <h6><?php echo $pricing_sub_title; ?></h6>
                <?php }
                if($pricing_title) { ?>
                <h2><?php echo $pricing_title; ?></h2>
                <?php }
                if($pricing_description) { ?>
                <p><?php echo $pricing_description; ?></p>
                <?php } ?>                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-5 g-md-3">
                <?php 

                    if( $choose_pricing_packeges ):
                      
                        foreach( $choose_pricing_packeges as $post ): 

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post);

                            $price_from_text = get_field('price_from_text');
                            $price = get_field('price');
                            $show_price_per_period = get_field( 'show_price_per_period' ); ?>
                            
                                <div class="<?= $columns_classes; ?>">
                                    <div class="card box-shadow">
                                        <div class="card-header">
                                            <h2><?php echo get_the_title(); ?></h2>
                                            <?php if( !empty($price_from_text) ){ ?>

                                                <h3><?php echo $price_from_text; ?></h3>
                                            <?php }

                                            if($price) { ?>

                                                <h6 class="card-title pricing-card-title">$<?php echo $price; ?><small>per <?php echo $show_price_per_period; ?></small></h6>
                                            <?php } ?> 

                                            <p><?php echo get_field('price_description')?></p>                                           
                                        </div>

                                        <?php if( have_rows('price_features') ): ?>

                                            <div class="card-body">
                                                <ul>
                                                    <?php while( have_rows('price_features') ): the_row();
                                                        $features = get_sub_field('features');

                                                        if($features) { ?>

                                                        <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-icon.svg" alt=""> <span><?php echo $features; ?></span></li>
                                                    <?php }
                                                    endwhile; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card-footer">
                                            <?php
                                            $price_button_label = get_field('price_button_label');
                                            $price_button_url = get_field('price_button_url');
                                            
                                            if( $price_button_label ) { ?>

                                                <a href="<?php echo $price_button_url; ?>" class="btn navyblue-btn mt-2"><?php echo $price_button_label; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach;

                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata();
                    endif; ?>
        </div>
    </div>
</section>