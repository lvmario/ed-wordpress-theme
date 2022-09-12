<?php

// namespace Eina\Modules\;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Autoload modules bootstrap files.
 *
 * @since 
 *
 * @return void
 */

function ed_load_modules( $modules_to_load ) {

		$ed_modules = array (
			'wp-customization' => array (
				'path' => 'wp-customization/module.php' 
			),
			'robots' => array (
				'path' => 'robots/functions.php', 
			),
			'schema' => array (
				'path' => 'schema/module.php', 
			),
			'web-vitals' => array (
				'path'=> 'web-vitals/module.php',
			)
		);	

		$loaded = array();

		foreach ( (array) $modules_to_load as $module ) {

			if ( in_array( $module, $loaded, true ) ){
				continue;
			}

			if ( array_key_exists( $module, $ed_modules ) ){
				$module_to_load_path = wp_normalize_path ( $ed_modules[$module]['path'] );
				require_once( get_template_directory() . '/modules/' . $module_to_load_path );
				array_push ( $loaded, $module );
			}	
			
		}
}	