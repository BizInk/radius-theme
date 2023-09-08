<?php 
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$accordions_title = get_sub_field('accordions_title');

if( have_rows('accordions_accordion_items') ){
?>
  <section class="accordion-section text-center<?= $general_class; ?>">
    <div class="container">
      
      <?php if( !empty($accordions_title) ){ ?>
        
        <h2><?= $accordions_title; ?></h2>
      <?php } ?>

      <div class="accordion" id="accordionItems">

        <?php $counter = 1;
        while( have_rows('accordions_accordion_items') ){
          the_row();

          $accordions_item_title = get_sub_field('accordions_item_title');
          $accordions_item_content = get_sub_field('accordions_item_content');

          if( !empty($accordions_item_content) && !empty($accordions_item_title) ){
            ?>

            <div class="accordion-item">
              <h2 class="accordion-header" id="heading<?= $counter; ?>">
                <button class="accordion-button<?= $counter == 1 ? null : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $counter; ?>" aria-expanded="<?= $counter == 1 ? 'true' : 'false'; ?>" aria-controls="collapse<?= $counter; ?>">
                  <?= $accordions_item_title; ?>
                </button>
              </h2>
              <div id="collapse<?= $counter; ?>" class="accordion-collapse collapse<?= $counter == 1 ? ' show' : null; ?>" aria-labelledby="heading<?= $counter; ?>" data-bs-parent="#accordionItems">
                <div class="accordion-body">
                  <?= $accordions_item_content; ?>
                </div>
              </div>
            </div>
          <?php }
          $counter++;
        } ?>
        
      </div>
    </div>
  </section>
<?php } ?>