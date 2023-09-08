<?php 
$general_settings = get_sub_field('general_settings'); 
$counter_title = get_sub_field('counter_add_title');
$counter_description = get_sub_field('counter_add_description');

$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

?>
<!-- counter-section-start -->
<section class="counter-section<?= $general_class; ?>">
  <div class="full-width-wysiwyg text-center">
    <div class="container">
      <div class="editor-design">
        <h2>
          <?php
            if(!empty($counter_title)){
              echo $counter_title;
            }
          ?>

        </h2>
        <p>
          <?php
            if(!empty($counter_description)){
              echo $counter_description;
            }
          ?>
        </p>
      </div>
    </div>
  </div>  
  <div class="container">
    <div class="row text-center gy-5 g-md-0">
      <?php if( have_rows('counter') ): ?>
      <?php while( have_rows('counter') ): the_row(); ?>
      <?php
      $counter_text = get_sub_field('counter_text');
      $icon = get_sub_field('icon');
      $counter_description = get_sub_field('counter_description');
      ?>
      <div class="col-md-4">
        <div id="counter-box" class="counter-box">
          <div class="counter-wrap">
            <?php if($counter_text) { ?>
            <h2 class="counter plus" data-number="<?php echo $counter_text; ?>"></h2>
            <?php } ?>
            <?php if($icon) { ?>
            <span><?php echo $icon; ?></span>
            <?php } ?>
          </div>
          <?php if($counter_description) { ?>
          <?php  echo $counter_description; ?>
          <?php } ?>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
      
    </div>
  </div>
</section>
<!-- counter-section-end -->