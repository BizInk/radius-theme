<?php

/**
 * Template Name: Large Team
 *
 * Template to display listing of team members page
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
include get_template_directory() . '/inc/password-check.php';

get_header();

get_template_part('global-templates/inner-banner');

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
