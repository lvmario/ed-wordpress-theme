<?php

/* WP customization functions */

/**
 * EDIT Esta función agrega los parámetros "async" y "defer" a recursos de Javascript.
 * Solo se debe agregar "async" o "defer" en cualquier parte del nombre del 
 * recurso (atributo "handle" de la función wp_register_script).
 *
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
function ed_add_async_defer_attributes( $tag, $handle ) {

	if( strpos( $handle, "async" ) ):
		$tag = str_replace(" src", " async='async' src", $tag);
	endif;

	if( strpos( $handle, "defer" ) ):
		$tag = str_replace(" src", " defer='defer' src", $tag);
	endif;

	return $tag;
}
add_filter('script_loader_tag', 'ed_add_async_defer_attributes', 10, 2);

/**
 * EDIT Esta función añade el parámetro type="module"  
 * Solo se debe agregar "module" en cualquier parte del nombre del 
 * recurso (atributo "handle" de la función wp_register_script).
 *
 * @param $tag
 * @param $handle
 *
 * @return mixed
 */
 
 
 
// esta function esta desactivada porque genera un conflicto en elementor que no permite abrirlo 
/*
function ed_add_module_type_attribute( $tag, $handle ) {

	if( strpos( $handle, "module" ) ):
		$tag = str_replace(" src", " type='module' src", $tag);
	endif;

	return $tag;

}
add_filter('script_loader_tag', 'ed_add_module_type_attribute', 10, 2);
*/