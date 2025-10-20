<?php

// Makes sure Css is saved
if (function_exists('process_scss')) {
  process_scss();
}

get_header();
echo '<div id="content">';
if( have_rows('page_flexible_content') ): 
  while( have_rows('page_flexible_content') ): the_row();
    if( get_row_layout() == 'info_box' ):
        get_template_part('page-templates/template-parts/info-box');
      elseif( get_row_layout() == 'hero_section' ):
        get_template_part('page-templates/template-parts/hero-section');
      elseif( get_row_layout() == 'two_column' ):
        get_template_part('page-templates/template-parts/two-column');
      elseif( get_row_layout() == 'logo' ):
        get_template_part('page-templates/template-parts/logo');       
      elseif( get_row_layout() == 'counter' ):
        get_template_part('page-templates/template-parts/counter');
      elseif( get_row_layout() == 'form-block' ):
        get_template_part('page-templates/template-parts/form-block');
      elseif( get_row_layout() == 'call_to_action' ):
          get_template_part('page-templates/template-parts/call-to-action');
      elseif( get_row_layout() == 'testimonial' ):
          get_template_part('page-templates/template-parts/testimonial');
      elseif( get_row_layout() == 'full_width_section' ):
          get_template_part('page-templates/template-parts/full-width');
      elseif( get_row_layout() == 'pricing' ):
          get_template_part('page-templates/template-parts/pricing');
      elseif( get_row_layout() == 'sign_up' ):
          get_template_part('page-templates/template-parts/sign-up');
      elseif( get_row_layout() == 'get_to_know_section' ):
          get_template_part('page-templates/template-parts/get-to-know-section');
      elseif( get_row_layout() == 'accordions' ):
          get_template_part('page-templates/template-parts/accordions');
      elseif( get_row_layout() == 'latest-posts' ):
          get_template_part('page-templates/template-parts/latest-posts');
      elseif( get_row_layout() == 'newsletter' ):
          get_template_part('page-templates/template-parts/newsletter');
      elseif( get_row_layout() == 'full_width_section_contents' ):
          get_template_part('page-templates/template-parts/full-width-contents');
      elseif( get_row_layout() == 'four_column_videos' ):
          get_template_part('page-templates/template-parts/four-col-videos');
      elseif( get_row_layout() == 'team' ):
          get_template_part('page-templates/template-parts/team');
      
    endif;  
  endwhile;
endif;
echo '</div>';
get_footer();
?>