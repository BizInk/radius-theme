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
$columns_number = get_sub_field('columns_number');
$columns_classes = 'col-md-6 col-lg-4';
if( $columns_number == 4 ){
$columns_classes = 'col-md-6 col-lg-3';
}
?>

<?php get_template_part('global-templates/inner-banner'); ?>


<section class="pricing-section<?php echo $general_class; ?>">
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
        <div class="row gy-5 g-md-5 <?php echo $columns_number == 5 ? 'row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5' : null; ?>">
                <?php
                if( $choose_pricing_packeges ){
                  
                    foreach( $choose_pricing_packeges as $post ){
                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post);

                        $most_popular = get_field('most_popular_item');
                        $most_popular = $most_popular ? $most_popular : false;
                        $price_from = get_field('price_from');
                        $gstvat = get_field('gstvat');
                        $price_button = get_field('price_button');
                        $price = get_field('price');
                        $price_features_alignment = get_field( 'price_features_alignment' );
                        $show_decimals = get_field( 'show_decimals' );
                        $show_price_per_period = get_field( 'show_price_per_period' ); 
                        
                        $use_custom_colours = get_field('use_custom_colours');
                        $title_color = get_field('title_color');
                        $title_color_hover = get_field('title_color_hover');
                        $text_color = get_field('text_color');
                        $text_color_hover = get_field('text_color_hover');
                        $background_color = get_field('background_color');
                        $background_color_hover = get_field('background_color_hover');
                        $price_color = get_field('price_color');
                        $price_color_hover = get_field('price_color_hover');
                        $currency_symbol_color = get_field('currency_symbol_color');
                        $currency_symbol_color_hover = get_field('currency_symbol_color_hover');
                        $tax__vat__gst_color = get_field('tax__vat__gst_color');
                        $tax__vat__gst_color_hover = get_field('tax__vat__gst_color_hover');
                        $most_popular_text_color = get_field('most_popular_text_color');
                        $most_popular_text_color_hover = get_field('most_popular_text_color_hover');
                        $most_popular_background_color = get_field('most_popular_background_color');
                        $most_popular_background_color_hover = get_field('most_popular_background_color_hover');
                        $pricefrom_color = get_field('pricefrom_color');
                        $pricefrom_color_hover = get_field('pricefrom_color_hover');
                        $priceper_color = get_field('priceper_color');
                        $priceper_color_hover = get_field('priceper_color_hover');
                        $checkmark_color = get_field('checkmark_color');
                        $checkmark_color_hover = get_field('checkmark_color_hover');
                        if( $use_custom_colours ){
                            ?>
                            <style>
                                #package-<?php echo $post->ID; ?> .card .card-inner{
                                    background-color: <?php echo $background_color; ?>;
                                    color: <?php echo $text_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .card-inner{
                                    background-color: <?php echo $background_color_hover; ?>;
                                    color: <?php echo $text_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .card-body, #package-<?php echo $post->ID; ?> .card h5, #package-<?php echo $post->ID; ?> .card ul{
                                    color: <?php echo $text_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .card-body, #package-<?php echo $post->ID; ?> .card:hover h5, #package-<?php echo $post->ID; ?> .card:hover ul{
                                    color: <?php echo $text_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .most_popular_header{
                                    color: <?php echo $most_popular_text_color; ?>;
                                    background-color: <?php echo $most_popular_background_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .most_popular_header{
                                    color: <?php echo $most_popular_text_color_hover; ?>;
                                    background-color: <?php echo $most_popular_background_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .currency_symbol{
                                    color: <?php echo $currency_symbol_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .currency_symbol{
                                    color: <?php echo $currency_symbol_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .pricefrom{
                                    color: <?php echo $pricefrom_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .pricefrom{
                                    color: <?php echo $pricefrom_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .priceper{
                                    color: <?php echo $pricefrom_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .priceper{
                                    color: <?php echo $pricefrom_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .price, #package-<?php echo $post->ID; ?> .card .decimals{
                                    color: <?php echo $priceper_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .price, #package-<?php echo $post->ID; ?> .card:hover .decimals{
                                    color: <?php echo $priceper_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card .gstvat{
                                    color: <?php echo $tax__vat__gst_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover .gstvat{
                                    color: <?php echo $tax__vat__gst_color_hover; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card svg .check{
                                    fill: <?php echo $checkmark_color; ?>;
                                }
                                #package-<?php echo $post->ID; ?> .card:hover svg .check{
                                    fill: <?php echo $checkmark_color_hover; ?>;
                                }
                            </style>
                            <?php
                        }
                        ?>
                        <div id="package-<?php echo $post->ID; ?>" class="<?php echo $columns_classes; ?>">

                            <div class="card box-shadow">
                                <?php if( $most_popular ) { ?>
                                    <div class="most_popular_header text-center">
                                        <?php echo get_field('most_popular_item_text') ? get_field('most_popular_item_text'):"Most Popular"; ?>
                                    </div>
                                <?php } ?>
                                <div class="card-inner">
                                    <div class="card-header">
                                        <h5><?php echo get_the_title(); ?></h5>
                                        <?php if(get_field('price_description')): ?>
                                            <p><?php echo get_field('price_description'); ?></p>
                                        <?php endif;
                                        if( $price ) {
                                            echo $price_from ? '<span class="pricefrom">From: </span>' : null; 
                                            $decimals = floatval($price) - floor(floatval($price));
                                            $currency_symbol = get_field('currency_symbol');
                                            $currency_symbol = $currency_symbol ? $currency_symbol : '$';
                                            ?>
                                            <h2 class="mb-1 pb-0 card-title pricing-card-title<?php echo $show_decimals ? ' show-decimals' : null; ?>">
                                                <span class="currency_symbol"><?php echo get_field('currency_symbol') ? get_field('currency_symbol'):"$"; ?></span>
                                                <span class="price"><?php if($show_decimals): echo str_replace(" ","",floor(floatval($price))); else: echo $price; endif; ?></span>

                                            <?php if( $show_decimals ){ ?>
                                                <sub style="bottom:0;left:-10px;font-size:.6em;" class="decimals">.<?php echo $decimals == 0 ? "00":($decimals*100); ?></sub>
                                            <?php }
                                            if($show_price_per_period != 'none'):
                                            ?>
                                                <small style="left:-10px;" class="priceper">/ <?php
                                                switch($show_price_per_period){
                                                    case 'day':
                                                        _e('day','wave');
                                                        break;
                                                    case 'week':
                                                        _e('week','wave');
                                                        break;
                                                    case 'year':
                                                        _e('year','wave');
                                                        break;
                                                    case 'month':
                                                    default:
                                                        _e('month','wave');
                                                        break;
                                                }
                                                ?></small>
                                            <?php
                                            endif;
                                            if(empty($gstvat) || $gstvat != 'no'){
                                                echo '<small style="left:-10px;" class="gstvat"> +';
                                                switch($gstvat){
                                                    case 'gst':
                                                        _e('GST','wave');
                                                        break;
                                                    case 'vat':
                                                        _e('VAT','wave');
                                                        break;
                                                    case 'tax':
                                                    default:
                                                        _e('Tax','wave');
                                                        break;
                                                }
                                                echo '</small>';
                                            }
                                        }
                                        ?>
                                        </h2>
                                    </div>
                                    <?php
                                    if( have_rows('price_features') ){ ?>
                                        <div class="card-body pt-0 <?php echo $price_features_alignment; ?>">
                                            <ul>
                                                <?php while( have_rows('price_features') ){
                                                    the_row();
                                                    
                                                    $features = get_sub_field('features');
                                                    if( !empty($features) ) { ?>
                                                        <li>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path class="check" id="Path_6077" data-name="Path 6077" d="M20,10A10,10,0,1,1,10,0,10,10,0,0,1,20,10ZM15.037,6.213a.938.938,0,0,0-1.35.027L9.346,11.771,6.73,9.154a.938.938,0,0,0-1.325,1.325l3.307,3.308a.938.938,0,0,0,1.349-.025l4.99-6.238a.938.938,0,0,0-.012-1.313Z" fill="#427cd4" fill-rule="evenodd"/></svg>
                                                            <span><?php echo $features; ?></span>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
    
                                    <div class="card-footer">
                                        <?php                                            
                                        if( !empty($price_button['url']) && !empty($price_button['title']) ) { ?>
                                            
                                            <a href="<?php echo $price_button['url']; ?>" class="btn navyblue-btn mt-2 ms-5"><?php echo $price_button['title']; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }

                    // Reset the global post object so that the rest of the page works correctly.
                    wp_reset_postdata();
                } ?>
        </div>
    </div>
</section>