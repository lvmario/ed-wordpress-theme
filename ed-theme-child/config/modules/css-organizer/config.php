<?php
/* Runtime configuration for the css organizer enqueue system */

return $css_assets_config = array (

		'bootstrap-reboot' => array (
						'handle'  			=> 'bootstrap-reboot',
						'src' 	  			=>  VENDOR_ASSETS_URL . 'bootstrap/bootstrap-reboot.min.css',
						'deps'    			=>  array(),
						'ver'     			=>  AUTOCITY_ASSETS_VERSION,
						'media'   			=>  "all",
						'condition'	 		=>  false,
						'register_only' 	=>  false
		),

		'bootstrap' => array (
						'handle'  			=> 'bootstrap',
						'src' 	  			=>  VENDOR_ASSETS_URL . 'bootstrap/bootstrap.min.css',
						'deps'    			=>  array(),
						'ver'     			=>  '5.0.2',
						'media'   			=>  "all",
						'condition'	 		=>  false,
						'register_only' 	=>  false
		),

		'home' => array (
						'handle'  			=> 'home',
						'src' 	  			=>  CSS_ASSETS_URL . 'pages/home.css',
						'deps'    			=>  array(),
						'ver'     			=>  AUTOCITY_ASSETS_VERSION,
						'media'   			=>  "all",
						'condition'			=>  array (
														'type'				=>  'front_page',
														'template_name' 	=>  ''		
												),
						'register_only' 	=>  false
		
		),
		
		'owl' => array (
						'handle'  			=> 'owl',
						'src' 	  			=>  CSS_ASSETS_URL . 'theme/owl/owl.carousel.min.css',
						'deps'    			=>  array(),
						'ver'     			=>  AUTOCITY_ASSETS_VERSION,
						'media'   			=>  "all",
						'condition'			=>  array (
														'type'				=>  'front_page',
														'template_name' 	=>  ''		
												),
						'register_only' 	=>  false
		
		),

		'owl-theme' => array (
						'handle'  			=> 'owl-theme',
						'src' 	  			=>  CSS_ASSETS_URL . 'theme/owl/owl.theme.default.min.css',
						'deps'    			=>  array(),
						'ver'     			=>  AUTOCITY_ASSETS_VERSION,
						'media'   			=>  "all",
						'condition'			=>  array (
														'type'				=>  'front_page',
														'template_name' 	=>  ''		
												),
						'register_only' 	=>  false
		
		)		
		
);