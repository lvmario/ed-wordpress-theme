<?php

add_action( 'wp_enqueue_scripts', 'ed_process_css_assets_config' );

function ed_process_css_assets_config() {

	$configs = array();

	$configs = (array) apply_filters( 'ed_add_css_organizer_enqueue_config', $configs );

	$templates_loaded = array();

	foreach ($configs as $config => $asset) {

		//Do not load the default theme asset unless no template has been loaded 
		if ( $asset['handle'] === 'theme-default' )
			continue; 

		if ( $asset['condition'] !== false ){

			$template_function_name = (string) 'is_' . $asset['condition']['type'];	
			if ( call_user_func( $template_function_name , array ( $asset['condition']['template_name'] ) ) ){

				ed_register_and_enqueue_css_asset( $asset );
				array_push ( $templates_loaded, $asset['handle'] );

			}

		}else{
			
			ed_register_and_enqueue_css_asset( $asset );

		}
	}

	if ( empty ( $templates_loaded ) ){
		ed_register_and_enqueue_css_asset( $configs['theme-default'] );
	}

}

function ed_register_and_enqueue_css_asset( $asset ) {

	//Register Asset
	wp_register_style 	(	$asset['handle'], 
							$asset['src'],
							$asset['deps'], 
							$asset['ver'], 
							$asset['media']
						);

	//Enqueue Asset
	if ( isset ( $asset['register_only'] ) && ! $asset['register_only'] ){
		wp_enqueue_style ( $asset['handle'] );
	}


}