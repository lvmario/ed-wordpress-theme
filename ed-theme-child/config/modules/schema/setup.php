<?php

	//Add schema object to Faq Modal
	// add_action ( 'autocity_faq_modal_rendered' , 'autocity_render_schema_faq_object', 10, 1 );

	function autocity_render_schema_faq_object( $config_faq_schema_object ){

		$schema_FAQ_object = new Schema_Item( $config_faq_schema_object	);
	}

	//Add WebPage schema object on head, for all pages 
	// add_action ( 'wp_head', 'autocity_render_web_page_object');

	function autocity_render_web_page_object(){

		if ( is_front_page() ) {	

		
			$config_webpage_schema_object =  array ( 
				'type' 	  => 'WebPage',
				'content' => array (
					"headline"  => "",
					"url"		=> site_url(),
					"publisher" => array (
						"@type"  => "Organization",
						"name"   => "",
						"sameAs" => array(),
						"logo"   => array (
								"@type"  => "ImageObject",
								"url"    => get_stylesheet_directory_uri() . "/assets/images/favicon/apple-icon-180x180.png",
								"width"  => 180,
								"height" => 180
							)
						)
					)
			);

			$schema_WebPage_object = new Schema_Item( $config_webpage_schema_object );

		}	

	}


?>