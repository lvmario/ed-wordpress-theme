<?php

//noindex/nofollow/nosnippet config (or robots directives in general, check https://developers.google.com/search/docs/advanced/robots/robots_meta_tag#directives)

function ed_set_robots_directives(){

	$config = (array) apply_filters( 'ed_add_robots_directives_config', $config );

	foreach ($config as $template => $value) {
		$template_function_name = (string) 'is_' . $template;
		if ( call_user_func($template_function_name) ){
			$noindex_metatag = '<meta name="robots" content="' . esc_attr($value) . '" />' . PHP_EOL;
		}
	}

	echo $noindex_metatag;

}

add_action ('wp_head', 'ed_set_robots_directives', 0, 10);