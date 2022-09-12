<?php

/*Customizing WP Sitemap (https://make.wordpress.org/core/2020/07/22/new-xml-sitemaps-functionality-in-wordpress-5-5)*/

/*Keep only post object provider*/

function keep_only_post_object_provider ($provider, $name){

	 	if ( 'posts' !== $name ) {
            return false;
        }
 
       	return $provider;
}

add_filter( 'wp_sitemaps_add_provider',  'keep_only_post_object_provider', 10, 2 );

/*And keep only pages within post objects*/

function filter_pages ($post_types){

		foreach ( $post_types as $key => $post_type) {
			if (  "page" !== $post_type->name ){
				unset( $post_types[$key] );
			}

		}

       	return $post_types;
}

add_filter( 'wp_sitemaps_post_types',  'filter_pages', 10, 1 );