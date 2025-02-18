<?php
function process_scss(){
    if( !function_exists('get_fields') ){
        return;
    }
    // Get newly saved values for the theme settings page.
    $theme_version = wp_get_theme()->get( 'Version' );
    $values = get_fields( 'options' );
    $global_theme_color1 = !empty($values['global_theme_color1']) ? $values['global_theme_color1'] : '#272343';
    $global_theme_color2 = !empty($values['global_theme_color2']) ? $values['global_theme_color2'] : '#dc3f14';
    $global_theme_color3 = !empty($values['global_theme_color3']) ? $values['global_theme_color3'] : '#ffffff';
    $global_theme_color4 = !empty($values['global_theme_color4']) ? $values['global_theme_color4'] : '#000000';
    $global_theme_color5 = !empty($values['global_theme_color5']) ? $values['global_theme_color5'] : '#f6b720';
    $global_theme_color6 = !empty($values['global_theme_color6']) ? $values['global_theme_color6'] : '#f9f9f9';
    $global_theme_color7 = !empty($values['global_theme_color7']) ? $values['global_theme_color7'] : '#e6f0ff';

    $cached_colors = get_transient('saved_theme_colors');
    $run_scss = false;
    if( $cached_colors != false ){
        if( 
            $cached_colors['global_theme_color1'] != $global_theme_color1 || 
            $cached_colors['global_theme_color2'] != $global_theme_color2 || 
            $cached_colors['global_theme_color3'] != $global_theme_color3 || 
            $cached_colors['global_theme_color4'] != $global_theme_color4 || 
            $cached_colors['global_theme_color5'] != $global_theme_color5 || 
            $cached_colors['global_theme_color6'] != $global_theme_color6 || 
            $cached_colors['global_theme_color7'] != $global_theme_color7 ||
            ($cached_colors['theme_version']??$cached_colors['theme_version']) != $theme_version
            ){
            $run_scss = true;
        }
    }
    else{
        $run_scss = true;
    }
    $run_scss = true;
    if($run_scss){
        require "scss.inc.php";
        $scss = new scssc();
        $output_file =  get_stylesheet_directory() . '/css/stylesheet.css';
        $path = get_stylesheet_directory() . '/src/sass/settings.scss';
        
        $compiled_css = $scss->compile('
            $primary: ' . $global_theme_color1 . ';
            $yellow: ' . $global_theme_color2 . ';
            $red: '.$global_theme_color2.';
            $white: ' . $global_theme_color3 . ';
            $dark: ' . $global_theme_color4 . ';
            $neutral-blue: ' . $global_theme_color5 . ';
            $orange: '.$global_theme_color5.';
            $light-gray: ' . $global_theme_color6 . ';
            $neutral-light-blue: ' . $global_theme_color7 . ';
            $font-family: "Roboto Slab", serif;
            $font-family2: "Poppins, sans-serif";
            @import "' . $path . '";
        ');

        file_put_contents($output_file, $compiled_css);

        set_transient('saved_theme_colors', array(
            'global_theme_color1' => $global_theme_color1,
            'global_theme_color2' => $global_theme_color2,
            'global_theme_color3' => $global_theme_color3,
            'global_theme_color4' => $global_theme_color4,
            'global_theme_color5' => $global_theme_color5,
            'global_theme_color6' => $global_theme_color6,
            'global_theme_color7' => $global_theme_color7,
            'theme_version' => $theme_version
        ));
    }
}

add_action('acf/options_page/save', 'radius_save_options_page', 10, 2);
function radius_save_options_page( $post_id, $menu_slug ) {

    if ( 'admin-settings' == $menu_slug || 'website-settings' == $menu_slug ) {
        process_scss();
    }
}

function radius_update_completed( $upgrader_object, $options){
    if($options['action'] == 'update' && $options['type'] == 'theme'){
        process_scss();
    }
}
add_action( 'upgrader_process_complete', 'radius_update_completed', 10, 2 );