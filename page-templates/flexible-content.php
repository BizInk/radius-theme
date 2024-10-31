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

if (function_exists('have_rows') && function_exists('get_row_layout')):
  if (have_rows('page_flexible_content')):
      while (have_rows('page_flexible_content')):
          the_row();

          switch (get_row_layout()) {
              case 'info_box':
                  get_template_part('page-templates/template-parts/info-box');
                  break;
              case 'hero_section':
                  get_template_part('page-templates/template-parts/hero-section');
                  break;
              case 'two_column':
                  get_template_part('page-templates/template-parts/two-column');
                  break;
              case 'logo':
                  get_template_part('page-templates/template-parts/logo');
                  break;
              case 'counter':
                  get_template_part('page-templates/template-parts/counter');
                  break;
              case 'form-block':
                  get_template_part('page-templates/template-parts/form-block');
                  break;
              case 'call_to_action':
                  get_template_part('page-templates/template-parts/call-to-action');
                  break;
              case 'testimonial':
                  get_template_part('page-templates/template-parts/testimonial');
                  break;
              case 'full_width_section':
                  get_template_part('page-templates/template-parts/full-width');
                  break;
              case 'pricing':
                  get_template_part('page-templates/template-parts/pricing');
                  break;
              case 'sign_up':
                  get_template_part('page-templates/template-parts/sign-up');
                  break;
              case 'get_to_know_section':
                  get_template_part('page-templates/template-parts/get-to-know-section');
                  break;
              case 'accordions':
                  get_template_part('page-templates/template-parts/accordions');
                  break;
              case 'latest-posts':
                  get_template_part('page-templates/template-parts/latest-posts');
                  break;
              case 'newsletter':
                  get_template_part('page-templates/template-parts/newsletter');
                  break;
              case 'full_width_section_contents':
                  get_template_part('page-templates/template-parts/full-width-contents');
                  break;
              case 'four_column_videos':
                  get_template_part('page-templates/template-parts/four-col-videos');
                  break;
              case 'team':
                  get_template_part('page-templates/template-parts/team');
                  break;
              case 'wideteam':
                  get_template_part('page-templates/template-parts/wideteam');
                  break;
          }
      endwhile;
  endif;
endif;

get_footer();
?>