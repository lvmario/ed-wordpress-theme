<?php

namespace Eina\Module\Schema;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}


/**
 * Autoload modules files.
 *
 * @since 
 *
 * @return void
 */

function autoload() {
	$files = array(
		'src/class-schema-item.php'
	);

	foreach( $files as $file ) {
		include( __DIR__ . '/' . $file );
	}
}

autoload();