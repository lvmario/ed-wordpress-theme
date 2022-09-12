<?php

namespace Eina\Module\WebVitals;

add_action ('wp_head',  __NAMESPACE__ . '\ed_add_web_vitals_polyfill_inline', 0, 10);

function ed_add_web_vitals_polyfill_inline(){

    ob_start(); 
    require_once ( wp_normalize_path ( get_template_directory() . "/modules/web-vitals/polyfill.php" ) );
    echo ob_get_clean();
        
}

/**
 * Enqueue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\ed_web_vitals_scripts' );


function ed_web_vitals_scripts(){
    wp_register_script( 'web-vitals-base', get_stylesheet_directory_uri() . "/node_modules/web-vitals/dist/web-vitals.iife.js", array(), EINA_VERSION, false );
    wp_enqueue_script( 'web-vitals-base' );
    wp_register_script( 'web-vitals-set-up-and-reporting', get_stylesheet_directory_uri() . "/config/modules/web-vitals/setup.js", array(), EINA_VERSION, false );
    wp_enqueue_script( 'web-vitals-set-up-and-reporting' );
}