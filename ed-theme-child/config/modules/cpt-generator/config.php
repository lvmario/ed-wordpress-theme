<?php

return array(
	'mensaje' => array(
		'post_type' => 'mensaje',
		'labels' => array(
			'custom_type'       => 'contacto',
			'singular_label'    => 'Mensaje',
			'plural_label'      => 'Mensajes',
			'in_sentence_label' => 'mensajes',
			'text_domain'       => 'autocity',
		),

		/**=====================================
		 * Supported features for this post type.
		 *======================================*/
		'features' => array(
			'base_post_type' => 'post',
			'exclude'        => array(
				'excerpt',
				'comments',
				'trackbacks',
				'custom-fields',
				'thumbnail',
			),
			'additional'     => array(
				'page-attributes',
			),
		),

		/**=====================================
		 * Registration arguments.
		 *======================================*/
		'args' => array(
			'description' => 'Mensajes recibidos a través del formulario de contacto (FAQ)',
			'label'       => 'Mensajes',
			'labels'      => '', // automatically generate the labels.
			'public'      => true,
			'supports'    => '', // automatically generate the support features.
			'menu_icon'   => 'dashicons-email',
			'has_archive' => false,
		)
	)	
);
