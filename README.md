# Introducción

El siguiente desarrollo consta conceptualmente de 3 partes: 
- 2 themes (uno parent y uno child) 
https://developer.wordpress.org/themes/getting-started/what-is-a-theme/
- 1 mu-plugin 
	https://wordpress.org/support/article/must-use-plugins/
- 1 archivo .htaccess.
	https://httpd.apache.org/docs/current/howto/htaccess.html

Se pueden utilizar de forma separada, así como en una instalación de WP completa.
Si el caso fuera el 2do, se recomienda obtener una versión actualizada de WP (https://wordpress.org/download/) y cargar los ficheros en el lugar correspondiente:
- .htaccess en el root de la instalación
	- el mu-plugin dentro de la carpeta wp-content/mu-plugins 
	- los themes dentro de la carpeta themes, borrando los themes que vengan por defecto.

Por último, para instalar los paquetes necesarios para las herramientas de automatización y web-vitals, se debe correr desde consola, situándose en el path del child-theme, el comando “npm install“.

# Secciones

# Indexación
	Sitemaps
Si bien existen muchos plugins que son capaces de generar sitemaps, a partir de la versión 5.5 Wordpress lo incorporó como una feature dentro del core (https://make.wordpress.org/core/2020/07/22/new-xml-sitemaps-functionality-in-wordpress-5-5)
Al parecer funciona muy bien y es super customizable. Al ser una customización propia de cada sitio, se la implementa desde el child-theme. En este caso ed-theme-child/wp-sitemap-functions.php
Documentación utiizada:
	
 Robots
Para definir los valores robots globales en robots.txt podemos usar el action hook do_robotstxt para añadir contenido (https://docs.wpvip.com/how-tos/modify-the-robots-txt-file/) asi como el filter hook robots_txt para filtrar el output final.

Por otro lado, para gestionar las directivas por template, se desarrolló modulo “robots” en parent theme.
El mismo se configura desde el child theme en ed-theme-child/robots/config.php enviándole un array simple con el nombre de template (considerando que se al nombre le va a anteceder el string “is_”, formando las template functions, “is_front_page()” por ejemplo) y el contenido para la etiqueta robots:

return	$config = array (

			'category' => 'noindex',
			'tag'      => 'noindex',
			'author'   => 'noindex'
);

Para activar a este módulo se lo puede llamar desde el functions.php del child por ejemplo:

add_filter ('ed_add_robots_directives_config', 'vg_set_robots_directives', 0, 10);

function vg_set_robots_directives(){

		$robots_config = (array) require( VG_CONFIG_PATH . 'modules/robots/config.php' );

		return $robots_config;
}


 Metatags
Readme del plugin utilizado (wp-seo)-> https://github.com/alleyinteractive/wp-seo

 Schema
Es un módulo creado en el parent theme a través de una clase llamada Schema_Item, la cual se la puede instanciar desde cualquier ubicación enviándole un archivo de configuración. El uso recomendado, sin embargo, es centralizar los objetos schema instanciados en un archivo localizado en ed-child-theme/modules/schema/setup.php que instancie el objeto enviándole una configuración y lo adjunte a un hook determinado. Por ejemplo:

//Add WebPage schema object on head, for all pages 
add_action ( 'wp_head', 'vg_render_web_page_object');
function vg_render_web_page_object(){
	if ( is_front_page() ) {	

		$config_webpage_schema_object =  array ( 
			'type' 	  => 'WebPage',
			'content' => array (
				"headline"  => "Vale Garrafa",
				"url"		=> site_url(),
				"publisher" => array (
					"@type"  => "Organization",
					"name"   => "Vale Garrafa",
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


 Estrategia de links internos

# Perfomance
	Assets/CSS
Para utilizar el módulo css-organizer (situado en parent-theme/modules/wp-customization/css-organizer), la implementación recomendada consiste en generar un archivo de configuración en child-theme/config/modules/css-organizer/config.php con el siguiente formato

	return $css_assets_config = array (

		'como-funciona' => array (
			'handle'  			=> 'como-funciona',
			'src' 	  			=>  CSS_ASSETS_URL . 'pages/como-funciona.min.css',
			'deps'    			=>  array(),
			'ver'     				=>  VG_ASSETS_VERSION,
			'media'   			=>  "all",
			'condition'			=>  array (
				'type'				=>  'page',
				'template_name' 		=>  'como-funciona'					),
			'register_only' 	=>  false
		),

);

Donde cada elemento ('como-funciona' en este caso) sería el archivo a incluir con los diferentes parámetros que requiere wp_register_style (https://developer.wordpress.org/reference/functions/wp_register_style/.) 
Hay dos parámetros extras, que son “condition”, el cual nos permite añadir una condición para que el archivo cargue en un determinado template (sino carga en todos) y 'register_only' que cuando está en ‘true’ nos permite registrarlo solamente de forma que funcione como una dependencia y no se inserte en ningún template a no ser que este lo añada en el parámetro ‘deps’.

 Assets/JS
Para minificar y hacer rolling up de archivos JS, se utiliza el comando ‘npm run js’, el cual está basado en la configuración cargada en child-theme/config/npm/rollup.config.js.

Para añadir los atributos defer o async a un script se debe añadir la expresión en cuestión al final del handle, ej:
wp_register_script( 'bootstrap-defer', VENDOR_ASSETS_URL . 'bootstrap/bootstrap.min.js', array('jquery-cdn'), '4.0.0', true );

wp_enqueue_script( 'bootstrap-defer' );

La lógica que interpreta el handle y en función de este añade el parámetro dentro del script embebido se encuentra dentro de parent-theme/modules/wp-customization/assets-enqueue/helper-functions.php


 Sprites

Para crear o actualizar los íconos de un sprite, se deben localizar los mismos dentro de la carpeta señalada como source dentro de la npm task ‘svg sprite’. En este caso en concreto la misma se define dentro de child-theme/package.json y tiene como source assets/images/layouts/**/*.svg (todos los archivos svg dentro de assets/images/layouts/ y sus directorios internos). El destino (--simbol-dest) en este caso es la carpeta sprites, y el archivo resultante es icons.svg, con su correspondiente html de ejemplo (icons-example.html) para chequear que se hayan generado correctamente. Estos parámetros pueden modificarse a conveniencia. Para ejecutar la tarea en sí misma se corre el comando ‘npm run svg-sprite’ parandonos con la consola sobre el child-theme, como con todos los comandos npm vinculados con la automatización.

Para insertarlos, por otro lado, utilizamos el siguiente formato:

<svg role="img" aria-labelledby="libere-espaco-title libere-espaco-desc">
<use xlink:href="<?php echo esc_url ( $sprites_dir . "/icons.svg#sem-nenhum-custo" ); ?>">
<title id="libere-espaco-title">Libere espaço</title>	
<desc id="libere-espaco-desc">Não acumule garrafas! Coloque suas garrafas vazias como Saldo Digital no Vale Garrafas e aproveite mais espaço em casa.</desc>
<image src="<?php echo esc_url ( $home_assets_src . "/sem-nenhum-custo.png" ); ?>" xlink:href=""/>
</svg>

	Donde:
 xlink:href es el source del sprite con el parámetro del icon en específico (#sem-nenhum-custo)
title y desc es contenido vinculado con la accesibilidad, similar a alt.
image src es el fallback que apunta al ícono en png en caso de que el browser no soporte svg
Preloading/Prefetching/Preconnect
Por el momento se añadió el preloading de las fuentes a través del hook wp_head en child-theme/functions.php

# Caché
	Automatización

En relación a las herramientas de automatización de procesos vinculados a recursos front-end, se eligió a npm como task runner.
Por ende, dentro del package.json del child-theme aparte de setear los paquetes utilizados, se crean y configuran las tasks en sí mismas.
En cada sección en especial se explica como usar cada una de las tareas en específico (CSS, JS, Sprites, etc.) pero a modo de explicación general, se puede decir que en el package.json del child-theme están definidas todas las tareas, que se ejecutan desde la consola parándose en el path del child-theme y que aquellas tareas que requieran un archivo de configuración extra, el mismo se encontrará en child-theme/config/npm.

Importante: Antes de empezar a desarrollar, correr el comando npm install sobre el path del child-theme para descargar todos los paquetes necesarios.

En este enlace está el boilerplate de la implementación y la explicación de varios comandos: 
https://github.com/cferdinandi/build-tool-boilerplate


Y acá más información acerca de NPM como task runner y ejemplos de diferentes casos de uso:
https://www.keithcirkel.co.uk/how-to-use-npm-as-a-build-tool/


 Web Vitals JS library
Para añadir la librería Web Vitals se creó un modulo en el parent-theme llamado web-vitals, que consta de dos archivos:

	module.php, donde se realizan los enqueues y donde se añade en el hook wp_head la llamada al segundo archivo (polyfill.php)

	polyfill.php, desde este archivo cargamos de forma inline en el head el javascript correspondiente al polyfill necesario para que la librería sea compatible en mayor numero de browsers. Por cualquier duda acerca de la implementación, chequear https://github.com/GoogleChrome/web-vitals.

Importante:
Utilizamos la versión iife de la librería de modo que no sea necesario utilizar módulos javascript.
Si bien el módulo como tal se encuentra en el parent-theme, para centralizar la gestión de paquetes, la librería web-vitals js está añadida en el package.json del child-theme y por esa razón desde module.php y polyfill.php hacemos los enqueues utilizando la url del child-theme.

Por último, la implementación en sí misma (desde donde se reportan los valores) está localizada en child-theme/config/modules/web-vitals/setup.js, embebida previamente desde el module.php del módulo en el parent-theme. 	

Para activar o desactivar el módulo en cuestión, así como con todos los módulos, se añade la línea correspondiente a cada uno en child-theme/modules/setup.php, utilizando la función ed_load_modules:

ed_load_modules ( array (
	'wp-customization',
	'robots',
	'schema',
	'web-vitals'
) );


# Seguridad
Aquellas medidas de seguridad que funcionan a través de código PHP (exceptuando aquellas que provienen de plugins) se añadieron al mu-plugin llamado security-basics.php. Si bien se puede revisar directamente desde el theme, dejo una copia más abajo:

//Disable XMLRPC
add_filter('xmlrpc_enabled', '__return_false');

//Restrict access to WP REST API to not admin users
add_filter( 'rest_authentication_errors', function( $result ) {
  if ( ! empty( $result ) ) {
    return $result;
  }
  if ( ! is_user_logged_in() ) {
    return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
  }
  if ( ! current_user_can( 'administrator' ) ) {
    return new WP_Error( 'rest_not_admin', 'You are not an administrator.', array( 'status' => 401 ) );
  }
  return $result;
});

// Remove version number from scripts and styles
function ed_remove_version_from_assets_enqueues( $src ) {
if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
  $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'ed_remove_version_from_assets_enqueues');
add_filter( 'script_loader_src', 'ed_remove_version_from_assets_enqueues');

// Remove version from head
remove_action('wp_head', 'wp_generator');

// Remove version from rss
add_filter('the_generator', '__return_empty_string');

// Disallow file edit from wp admin
define( 'DISALLOW_FILE_EDIT', true );


