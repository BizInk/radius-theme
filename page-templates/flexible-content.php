<?php

/**
 * Template Name: Flexible Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 * @package Understrap
 *
 */

// Require below variable for change value from db

// Require below library for compile
require "scss.inc.php";

$scss = new scssc();

$output_file =  get_stylesheet_directory().'/css/stylesheet.css';
$path = get_stylesheet_directory().'/src/sass/settings.scss';

$global_theme_color1 = get_field('global_theme_color1', 'option') ? get_field('global_theme_color1', 'option') : '#272343';
$global_theme_color2 = get_field('global_theme_color2', 'option') ? get_field('global_theme_color2', 'option') : '#dc3f14';
$global_theme_color3 = get_field('global_theme_color3', 'option') ? get_field('global_theme_color3', 'option') : '#ffffff';
$global_theme_color4 = get_field('global_theme_color4', 'option') ? get_field('global_theme_color4', 'option') : '#000000';
$global_theme_color5 = get_field('global_theme_color5', 'option') ? get_field('global_theme_color5', 'option') : '#f6b720';
$global_theme_color6 = get_field('global_theme_color6', 'option') ? get_field('global_theme_color6', 'option') : '#f9f9f9';
$global_theme_color7 = get_field('global_theme_color7', 'option') ? get_field('global_theme_color7', 'option') : '#e6f0ff';


$compiled_css = $scss->compile('
  $primary: '.$global_theme_color1.';
  $red: '.$global_theme_color2.';
  $white: '.$global_theme_color3.';
  $dark: '.$global_theme_color4.';
  $orange: '.$global_theme_color5.';
  $light-gray: '.$global_theme_color6.';
  $neutral-light-blue: '.$global_theme_color7.';
  @import "'.$path.'";
');

file_put_contents($output_file, $compiled_css);


get_header();

if( !is_front_page() ){
  get_template_part('global-templates/inner-banner');
}

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

get_footer();
?>