<?php

namespace Eina\Module\WpCustomization;

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

function autoload() {
	$files = array (
		'assets-enqueue/helper-functions.php',
		'css-organizer/functions.php',
		'cpt-generator/functions.php',
		'label-generator/functions.php'
	);

	foreach( $files as $file ) {
		require_once( __DIR__ . '/' . $file );
	}
}

autoload();