<?php
//Define constants
define( 'AUTOCITY_DEVELOPMENT_MODE', true );
define( 'AUTOCITY_VERSION' , '0.0.1' );
define( 'AUTOCITY_HOME', get_home_url() );
define( 'AUTOCITY_DOMAIN', $_SERVER['SERVER_NAME'] );
define( 'AUTOCITY_HOME_PATH', $_SERVER["DOCUMENT_ROOT"] );
define( 'AUTOCITY_THEME_PATH', wp_normalize_path( trailingslashit( get_stylesheet_directory() ) ) );
define( 'AUTOCITY_CONFIG_PATH', trailingslashit( __DIR__ ) . 'config/' ); 
define( 'ASSETS_URL', trailingslashit( get_stylesheet_directory_uri () ) . 'assets/' );
define( 'VENDOR_ASSETS_URL', ASSETS_URL . 'vendor/' );
define( 'JS_ASSETS_URL', ASSETS_URL . 'js/' );
define( 'JS_TEMPLATES_ASSETS_URL', JS_ASSETS_URL . 'templates/');
define( 'CSS_ASSETS_URL', ASSETS_URL . 'css/' );
define( 'PDF_PRESUPUESTOS_PATH', AUTOCITY_HOME_PATH . '/wp-content/uploads/pdfsPresupuestos/');
define( 'PDF_PRESUPUESTOS_URL', AUTOCITY_HOME . '/wp-content/uploads/pdfsPresupuestos/');

if ( AUTOCITY_DEVELOPMENT_MODE ){
	define( 'AUTOCITY_ASSETS_VERSION', date('Y-m-d-h-s') );
}else{
	define( 'AUTOCITY_ASSETS_VERSION', AUTOCITY_VERSION );
}

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//Images Sizes
add_image_size( 'blog-list', 400, 267, true );
add_image_size( 'blog-related-sidebar', 110, 70, true );
add_image_size( 'hero', 1440, 521, true );
add_image_size( 'catalogoList', 290, 215, true );
add_image_size( 'catalogoFichaGal', 470, 300, true );
add_image_size( 'catalogoFichaGalFull', 1002, 533, true );
add_image_size( 'thumbGeneral', 480, 277, true );


// Require Widgets System
require_once ( AUTOCITY_THEME_PATH . '/widgets/widgets.php' );

// Require Modules Config
require_once ( get_template_directory() . '/modules/bootstrap.php' );

//Select and set up modules
require_once( AUTOCITY_CONFIG_PATH .  'modules/setup.php' );

//Instantiate and create schema objects
require_once( AUTOCITY_CONFIG_PATH .  'modules/schema/setup.php' );

//Customize WP sitemap entries
// require_once( AUTOCITY_THEME_PATH . "wp-sitemap-functions.php");


require_once ( AUTOCITY_THEME_PATH . '/connections/controlador.php' );	
require_once ( AUTOCITY_THEME_PATH . '/connections/planesAjax.php' );

require_once ( AUTOCITY_THEME_PATH . '/connections/comparadorAjax.php' );

// arreglar problema de category base con shop base
require_once ( AUTOCITY_THEME_PATH . '/core/fixcategorywoo/fixcategorywoo.php' );	

//require_once ( AUTOCITY_THEME_PATH . '/connections/asofix/cron.php' );
//require_once ( AUTOCITY_THEME_PATH . '/connections/asofix/controladorDM.php' );

//filtros catalogo
require_once ( AUTOCITY_THEME_PATH . '/core/woo/filtroControlador.php' );
require_once ( AUTOCITY_THEME_PATH . "/core/woo/filtroAttr.php" );
require_once ( AUTOCITY_THEME_PATH . '/core/woo/filtroAjax.php' );

// cotizador ajax
require_once ( AUTOCITY_THEME_PATH . '/core/woo/cotizadorAjax.php' );

// presupuestador ajax

require_once ( AUTOCITY_HOME_PATH. '/wp-content/vendor/autoload.php' );
require_once ( AUTOCITY_THEME_PATH . '/core/woo/presupuestadorAjax.php' );

//Create Custom Post Types Contact metabox
//add_filter( 'add_custom_post_type_runtime_config', 'autocity_register_custom_post_types' );

function autocity_register_custom_post_types(){

		$cpt_config = (array) require( AUTOCITY_CONFIG_PATH . 'modules/cpt-generator/config.php' );
		return $cpt_config;

}

/* Set robots directive for Autocity using Robots modules*/
// add_filter ('ed_add_robots_directives_config', 'autocity_set_robots_directives', 0, 10);

function autocity_set_robots_directives(){

		$robots_config = (array) require( AUTOCITY_CONFIG_PATH . 'modules/robots/config.php' );
		return $robots_config;
}

function autocity_complete_default_robots_txt() {

	echo	"User-agent: *" . PHP_EOL;
	echo	"Disallow: /cgi-bin/*" . PHP_EOL;
	echo	"Disallow: /blackhole/*" . PHP_EOL;
	echo	"Disallow: /trackback/*" . PHP_EOL;
	echo	"Disallow: /feed/*" . PHP_EOL;
	echo	"Disallow: /xmlrpc.php" . PHP_EOL;
	echo 	PHP_EOL;

}
add_action( 'do_robotstxt', 'autocity_complete_default_robots_txt' );


/**
 * Enqueue scripts and styles.
 */

add_filter( 'ed_add_css_organizer_enqueue_config',  'autocity_register_css_assets_enqueue_config' );

function autocity_register_css_assets_enqueue_config() {

		$css_assets_config = (array) require( AUTOCITY_CONFIG_PATH . 'modules/css-organizer/config.php' );

		return $css_assets_config;

}

add_action( 'wp_enqueue_scripts', 'autocity_add_javascript_assets' );

function autocity_add_javascript_assets() {

	// jQuery
	wp_register_script( 'jquery-cdn', "https://code.jquery.com/jquery-3.6.0.min.js", array(), '3.6.0', false );
	wp_enqueue_script( 'jquery-cdn' );

	//Fallback for jQuery CDN
	wp_add_inline_script(
		'jquery-cdn', 
		 "if (!window.jQuery) document.write('<script src=". VENDOR_ASSETS_URL. "/jquery/jquery-3.6.0.min.js"  ."><\/script>'); ",
		 'after'
	);

	//jQuery Migrate
	wp_register_script( 'jquery-migrate-cdn', "https://code.jquery.com/jquery-migrate-3.3.2.min.js", array('jquery-cdn'), '3.3.2', false );
	wp_enqueue_script( 'jquery-migrate-cdn' );

	//Fallback for jQuery CDN
	wp_add_inline_script(
		'jquery-migrate-cdn', 
		 "if (typeof jQuery.migrateWarnings == 'undefined') document.write('<script src=". VENDOR_ASSETS_URL . "/jquery/jquery-migrate-3.3.2.min.js"  ."><\/script>'); ",
		 'after'
	);


	wp_register_script( 'bootstrap-defer', VENDOR_ASSETS_URL . 'bootstrap/bootstrap.min.js', '5.0.2', true );
	wp_enqueue_script( 'bootstrap-defer' );

	if( is_single()  ){
		wp_register_script( 'gallery-script', JS_ASSETS_URL . '/functions/gallery.js', array(), '1.0.0', true );
		wp_enqueue_script( 'gallery-script' );
	}

			
	wp_register_script( 'default-defer', JS_TEMPLATES_ASSETS_URL . '/default.cjs.min.js', array('jquery-cdn'), AUTOCITY_ASSETS_VERSION, true );
	wp_enqueue_script( 'default-defer' );

	wp_register_script( 'share-script', JS_TEMPLATES_ASSETS_URL . 'share.js', array(), '1.0.0', true );
	wp_enqueue_script( 'share-script' );

	wp_register_script( 'subscribe-script', JS_TEMPLATES_ASSETS_URL . 'subscribe.js', array(), '1.0.0', true );
	wp_enqueue_script( 'subscribe-script' );
	
	
	//script api inconcert
	wp_register_script( 'inconcert', JS_TEMPLATES_ASSETS_URL . 'inconcert.js', array('jquery-cdn'), '1.0.0', true );
	wp_enqueue_script( 'inconcert' );	
	
	
	if ( is_front_page() ){

		wp_register_script( 'home-defer', JS_TEMPLATES_ASSETS_URL . 'home.cjs.js', AUTOCITY_ASSETS_VERSION, true );
		wp_enqueue_script( 'home-defer' );
		
		wp_register_script( 'owl-defer', VENDOR_ASSETS_URL . 'owl/owl.carousel.min.js', '2.3.4', true );
		wp_enqueue_script( 'owl-defer' );	

		wp_register_script( 'touchSwipe', VENDOR_ASSETS_URL . 'swipe/jquery.touchSwipe.min.js', '1.6.18', true );
		wp_enqueue_script( 'touchSwipe' );			

	} else if ( is_archive() || is_page_template("blog.php") || is_search() || is_category() || is_tag() || is_single()  ){
		// blog
			wp_enqueue_style( 'blog-css', CSS_ASSETS_URL.'pages/blog-css.css');
	} else if ( is_page_template('planesAhorro.php') ) {
		// Planes de ahorro styles
		wp_enqueue_style( 'planes-de-ahorro-css', CSS_ASSETS_URL.'pages/planes-de-ahorro.css');
	}
	
	
    if ( is_product_category() || is_tax('autos') || is_shop() ){
		
		wp_enqueue_style( 'buscador-autocity-widget', CSS_ASSETS_URL . 'widgets/buscador-autocity.css', array(), AUTOCITY_ASSETS_VERSION, 'all' );
		wp_enqueue_style( 'woo-css', CSS_ASSETS_URL.'pages/woo.css', array('buscador-autocity-widget'), AUTOCITY_ASSETS_VERSION, 'all'  );
		
		wp_register_script( 'catalogo', JS_TEMPLATES_ASSETS_URL . 'catalogo.js', array('jquery') );
		wp_enqueue_script( 'catalogo' );

		wp_localize_script( 'catalogo', 'catalogoFilter', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'catalogoFilter',
			'base' => AUTOCITY_HOME
		) );	
		
    }
	
	if ( is_product() ) {
		// Ficha de producto styles
		wp_enqueue_style( 'ac-ficha-producto-css', CSS_ASSETS_URL . 'pages/ficha-producto.css' );
		wp_enqueue_style( 'e-gallery-css', ASSETS_URL . 'galeriaFicha/e-gallery.min.css' );
		wp_register_script( 'ac-ficha-producto-js', JS_ASSETS_URL . 'templates/ficha-producto.js', array(), false, true );
		wp_register_script( 'e-gallery-js', ASSETS_URL . 'galeriaFicha/e-gallery.min.js', array('jquery','ac-ficha-producto-js'), false, true );
		
		//carrusel destacados
		wp_enqueue_style( 'carousel-autocity-widget', CSS_ASSETS_URL . 'widgets/carousel-autocity.css', array(), AUTOCITY_ASSETS_VERSION, 'all' );
		wp_enqueue_script('carousel-autocity-widget-defer', JS_ASSETS_URL . 'widgets/carousel-autocity.js', AUTOCITY_ASSETS_VERSION, true );		
		
		wp_enqueue_script( 'carousel-autocity-widget-defer' );
		wp_enqueue_script( 'ac-ficha-producto-js' );
		wp_enqueue_script( 'e-gallery-js' );
	}
	
	
	wp_enqueue_style( 'global-css', CSS_ASSETS_URL.'pages/global-css.css');	
	
	if( is_page_template("postventa.php") ){
		
		//wp_enqueue_script("google-maps-api-postventa","https://maps.googleapis.com/maps/api/js?v=weekly&key=AIzaSyA9ON4s_OPXhOit_QmgTJTLU42qMps6pZI", array(), AUTOCITY_ASSETS_VERSION, true );		

		wp_register_script( 'jquery-ui-defer', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', '2.3.4', true );
		wp_enqueue_script( 'jquery-ui-defer' );
		
		
		wp_register_script( 'postventa', JS_TEMPLATES_ASSETS_URL . 'postventa.js', '2.3.4', true );
		wp_enqueue_script( 'postventa' );		
		
		wp_localize_script( 'postventa', 'ajaxPostventa', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'psotventaStep1'
		) );	
		
		wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style( 'postventa', CSS_ASSETS_URL.'pages/postventa.css');

	}
	
	if ( is_page_template('cotizador.php') ) {
		
		wp_register_script( 'cotizador', JS_TEMPLATES_ASSETS_URL . 'cotizador.js', AUTOCITY_ASSETS_VERSION, true );
		wp_enqueue_script( 'cotizador' );
		
		wp_localize_script( 'cotizador', 'ajaxCotizador', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'ajaxCotizador'
		));
		
		wp_enqueue_style( 'cotizador', CSS_ASSETS_URL.'pages/cotizador.css');
		
	}


	if ( is_page_template('presupuestador.php') || is_product() ) {
		
		wp_register_script( 'presupuestador', JS_TEMPLATES_ASSETS_URL . 'presupuestador.js', AUTOCITY_ASSETS_VERSION, true );
		wp_enqueue_script( 'presupuestador' );

		wp_register_script( 'cotizador', JS_TEMPLATES_ASSETS_URL . 'cotizador.js', AUTOCITY_ASSETS_VERSION, true );
		wp_enqueue_script( 'cotizador' );
		
		wp_localize_script( 'presupuestador', 'ajaxPresupuestador', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'ajaxPresupuestador',
			'pathPresupuestos' => PDF_PRESUPUESTOS_PATH,
			'urlPresupuestos' => PDF_PRESUPUESTOS_URL
		));

		wp_localize_script( 'cotizador', 'ajaxCotizador', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'ajaxCotizador'
		));	

		wp_enqueue_style( 'modal-presupuestador', CSS_ASSETS_URL.'pages/modal-presupuestador.css');
		
	}
	
	if ( is_page_template('presupuestador.php') ) {
		
		wp_enqueue_style( 'modal-presupuestador', CSS_ASSETS_URL.'pages/modal-presupuestador.css');
		wp_enqueue_style( 'presupuestador', CSS_ASSETS_URL.'pages/presupuestador.css');
		
	}	
	

	if ( is_page_template('planesAhorro.php') ) {
	
		wp_register_script( 'hero-planes', JS_TEMPLATES_ASSETS_URL . 'hero-planes.js', '1.0.0', true );
		wp_enqueue_script( 'hero-planes' );
		
		wp_register_script( 'faq-accordeon-script', JS_ASSETS_URL . 'functions/faqAccordeon.js', array(), '1.0.0', true );
		wp_enqueue_script( 'faq-accordeon-script' );

		wp_register_script( 'planesForms', JS_ASSETS_URL . 'functions/planesForms.js', array(), '1.0.0', true );
		wp_enqueue_script( 'planesForms' );

		wp_localize_script( 'planesForms', 'ajaxPlanes', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'planesAjax'
		) );
	}

	if ( is_page_template( 'comparador.php' ) ) {

		wp_register_script( 'comparador-script', JS_TEMPLATES_ASSETS_URL . 'comparador.js', array(), '1.0.0', true );
		wp_enqueue_script( 'comparador-script' );

		wp_enqueue_style( 'comparador-style', CSS_ASSETS_URL . 'pages/comparador.css' );

		wp_localize_script( 'comparador-script', 'ajaxComparador', array(
			'url'    => admin_url( 'admin-ajax.php' ),
			'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
			'action' => 'select_car'
		));		

	}
	
	if ( is_404() ) {
		wp_enqueue_style( '404-style', CSS_ASSETS_URL . 'pages/404.css' );
	}

}




/*Font preloading*/

function autocity_add_font_preloading(){ ?>

	<link rel="preload" href="<?php echo esc_url ( ASSETS_URL . 'fonts/kanit-300normal-latin.woff2' ); ?>" as="font" crossorigin>
	<link rel="preload" href="<?php echo esc_url ( ASSETS_URL . 'fonts/kanit-400normal-latin.woff2' ); ?>" as="font" crossorigin>
	<link rel="preload" href="<?php echo esc_url ( ASSETS_URL . 'fonts/kanit-500normal-latin.woff2' ); ?>" as="font" crossorigin>
		
<?php
}


add_action ('wp_head', 'autocity_add_font_preloading', 0, 10);


add_filter( 'document_title_parts', function( $title ){
    if ( is_search() ) 
        $title['title'] = sprintf( 
            esc_html__( 'Resultados de: ' ), 
            get_search_query() 
        );

    return $title;
	
} );


add_filter('elementor/utils/get_the_archive_title', 'titulo_pagina_de_busqueda');

function titulo_pagina_de_busqueda($title){
    	if ( is_search() ) {
			
			$title = "Resultado de: ".get_search_query();
			if ( get_query_var( 'paged' ) ) {
				$title .= sprintf( __( '&nbsp;&ndash; Página %s', 'elementor-pro' ), get_query_var( 'paged' ) );
			}
			
		}else if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
		
		return $title;
}

// Popular post
function my_custom_popular_posts_html_list($popular_posts, $instance) {
	
	$output = '<h4>Notas populares</h4>';
    $output .= '<ul class="wpp-list">';
	
    foreach( $popular_posts as $popular_post ) {
		
		if ( !has_post_thumbnail( $popular_post->id ) )
			continue;
		
		$stats = "";
        if ( $instance['stats_tag']['date'] ) {
            $date = date_i18n($instance['stats_tag']['date']['format'], strtotime($popular_post->date));
            $stats = '<div class="wpp-date">' . $date . '</div>';
        }
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $popular_post->id ), 'blog-related-sidebar' );

        $output .= "<li>";
			$output .= "<a href=\"" . get_permalink($popular_post->id) . "\" title=\"" . esc_attr($popular_post->title) . "\"><img src=\"" . esc_url( $image[0] ) . "\" class=\"wpp-thumbnail wpp_featured wpp_cached_thumb \" loading=\"lazy\"  /></a>";
			
			$output .= "<div>".$stats."<a href=\"" . get_permalink($popular_post->id) . "\" class=\"wpp-post-title\" target=\"_self\" >". $popular_post->title . "</a></div>";
        
        $output .= "</li>" . "\n";
    }

    $output .= '</ul>';

    return $output;
}
add_filter('wpp_custom_html', 'my_custom_popular_posts_html_list', 10, 2);

function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count">', $variable);
   $variable = str_replace(')', '</span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','categories_postcount_filter');


function blogGridloop() {

$paginacion = (get_query_var('paged')) ? get_query_var ('paged') : 1;
$ppp 		= get_option( 'posts_per_page' );

$args = array(
		'post_type' 		  => 'post',
		'posts_per_page'      => $ppp,
		'post_status'         => 'publish',
		'paged'				  => $paginacion,
	);
	
if( is_category() ){
	$args['cat'] = get_query_var('cat');
}else if( is_tag() ){
	$args['tag_id'] = get_query_var('tag_id');
}else if( is_search() ){
	$args['s'] = get_search_query(true);
}
	

query_posts( $args );

?>
	<div class='elementor-element elementor-grid-2 elementor-grid-tablet-1 elementor-grid-mobile-1 elementor-posts--thumbnail-top elementor-widget elementor-widget-posts customLoop'>
		<div class='elementor-widget-container'>

			<?php if ( have_posts() ) : ?>
			
			<div class='elementor-posts-container elementor-posts elementor-posts--skin-classic elementor-grid'>
			
			<?php
			
			
			
			while ( have_posts() ) : the_post();

					
				$perma 				 = esc_url( get_the_permalink() );	
				$title 				 = esc_attr( get_the_title() );	
				$excerpt			 = get_the_excerpt();
					
				$hora   = get_the_date();
				$format = get_option( 'date_format' );		
				$date 	= date_i18n( $format, strtotime( $hora ));
				
				
				$categories = get_the_category();

			?>
				<article class='elementor-post elementor-grid-item post type-post status-publish format-standard has-post-thumbnail hentry'>
				<?php 
					if ( has_post_thumbnail() ):
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-list' );
				?>				
					<a class='elementor-post__thumbnail__link' href='<?= $perma ?>' title='<?= $title ?>' >
						<div class='elementor-post__thumbnail'>
							<img src='<?= esc_url( $image[0] ) ?>' class='attachment-blog-list size-blog-list' alt='' loading='lazy'>
						</div>
					</a>
					
					<?php endif; ?>
			
					<div class='elementor-post__text'>
					
					
						<div class='elementor-post__meta-data'>
					
							<?php if( !empty( $categories ) ){	?>
						
							<div class='categories'>
							<?php foreach( $categories as $category ) {	?>
								<div class='cat-item'>
									<h6><a href='<?= get_category_link($category->term_id) ?>'><?= $category->name ?></a></h6>
								</div>
							<?php	} ?>
							
							</div>
						
							<?php } ?>
					
							<div class='elementor-post-date'>
								<?= $date ?>
							</div>
							
						</div>		
					
						<h3 class='elementor-post__title'>
							<a href='<?= $perma ?>'>
								<?= $title ?>
							</a>
						</h3>
												
						<div class='elementor-post__excerpt'>
							<?= $excerpt ?>
						</div>
						
						<div class='elementor-post__read-more'>
							<a href='<?= $perma ?>' >
								Leer nota completa
							</a>
						</div>
						
					</div>
					
				</article>
				<?php endwhile; ?>
				
			</div>
			
			<?php wpbeginner_numeric_posts_nav(); ?>	

			<?php else : ?>
			
			<div class='elementor-posts-container elementor-posts elementor-posts--skin-classic elementor-grid'>
			
				<article class='elementor-post elementor-grid-item post type-post status-publish format-standard has-post-thumbnail hentry'>
					No hay entradas
				</article>
				
			</div>
			
			<?php endif; ?>
			
		</div>
	</div>
	
	<?php
	
}

add_shortcode('blog-loop', 'blogGridloop');


function wpbeginner_numeric_posts_nav() {
 
    global $wp_query;

    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 3 ) <= $max ) {
		$links[] = $paged + 3;
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="customNavigation"><ul>' . "\n";
 
	if ( $paged == 1 ){
		
        printf( '<li><a class="backtoInitial disabled" href="%s"></a></li>' . "\n", "#" );
		
		printf( '<li><a class="backtoPrev disabled" href="%s"></a></li>' . "\n", "#" );
 				
		
	}else{
        printf( '<li><a class="backtoInitial" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( 1 ) ) );
		
		printf( '<li><a class="backtoPrev" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged - 1 ) ) );
 		
	}
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="pointsLi">…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
	if ( $paged == $max ){
		
		$class = ' class="backtoNext disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );			
		
		$class = ' class="backtoLast disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );	
		
	}else{
		
		printf( '<li><a class="backtoNext" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged + 1 ) ) );
 				
        printf( '<li><a class="backtoLast" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $max  ) ) );
	}
 
    echo '</ul></div>' . "\n";
 
}


function catalogoPaginador($productos) {
	
	global $wp_query;
	//var_dump($wp_query);
	
	$cantPages = $productos->query_vars['posts_per_page'];
	$paged 	   = $productos->query_vars['paged'];
	$maxNPages = $productos->max_num_pages;

	//echo "cantPages: ".$cantPages." - paged: ".$paged." - maxNPages: ".$maxNPages;

    if( $maxNPages <= 1 )
        return;
	
    $max = intval( $maxNPages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
	
	
	
	paginadorDeskCatalogo( $links, $paged, $max );
	paginadorMobileCatalogo( $links, $paged, $max );
 

 
}

function paginadorMobileCatalogo( $links, $paged, $max ){
	

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
       // $links[] = $paged - 2;
    }
 
    if ( ( $paged + 3 ) <= $max ) {
		//$links[] = $paged + 3;
        //$links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="customNavigation navigatorMobile"><ul>' . "\n";
 
	if ( $paged == 1 ){
		
        printf( '<li><a class="backtoInitial disabled" href="%s"></a></li>' . "\n", "#" );
		
		printf( '<li><a class="backtoPrev disabled" href="%s"></a></li>' . "\n", "#" );
 				
		
	}else{
        printf( '<li><a class="backtoInitial" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( 1 ) ) );
		
		printf( '<li><a class="backtoPrev" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged - 1 ) ) );
 		
	}
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
		
		if( $paged == 2 )
			printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="pointsLi">…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
	if ( $paged == $max ){
		
		$class = ' class="backtoNext disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );			
		
		$class = ' class="backtoLast disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );	
		
	}else{
		
		printf( '<li><a class="backtoNext" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged + 1 ) ) );
 				
        printf( '<li><a class="backtoLast" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $max  ) ) );
	}
 
    echo '</ul></div>' . "\n";	
	
	
}


function paginadorDeskCatalogo( $links, $paged, $max ){
	

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 3 ) <= $max ) {
		$links[] = $paged + 3;
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="customNavigation navigatorDesk"><ul>' . "\n";
 
	if ( $paged == 1 ){
		
        printf( '<li><a class="backtoInitial disabled" href="%s"></a></li>' . "\n", "#" );
		
		printf( '<li><a class="backtoPrev disabled" href="%s"></a></li>' . "\n", "#" );
 				
		
	}else{
        printf( '<li><a class="backtoInitial" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( 1 ) ) );
		
		printf( '<li><a class="backtoPrev" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged - 1 ) ) );
 		
	}
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="pointsLi">…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
	if ( $paged == $max ){
		
		$class = ' class="backtoNext disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );			
		
		$class = ' class="backtoLast disabled"';
		printf( '<li><a %s href="#"></a></li>' . "\n", $class );	
		
	}else{
		
		printf( '<li><a class="backtoNext" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $paged + 1 ) ) );
 				
        printf( '<li><a class="backtoLast" href="%s"></a></li>' . "\n", esc_url( get_pagenum_link( $max  ) ) );
	}
 
    echo '</ul></div>' . "\n";	
	
	
}




/*
function mg_news_pagination_rewrite() {
  add_rewrite_rule(get_option('category_base').'/page/?([0-9]{1,})/?$', 'index.php?pagename='.get_option('category_base').'&paged=$matches[1]', 'top');
}
add_action('init', 'mg_news_pagination_rewrite');
*/

// con este pre get post solucionamos error de paginacion en catalogo
function projects_custom_number_of_posts( $query ) {
	
    if ( is_product_category() || is_tax('autos') || is_shop() ) {
        $query->set('posts_per_page', 12 );
        return;
    }
}
add_action( 'pre_get_posts', 'projects_custom_number_of_posts', 1 );



// include Modale before /footer
function footerModals() {
	
	wp_reset_query();
	
	include AUTOCITY_THEME_PATH . "page-templates/modals/contacto/formularios.php";
	
}
add_action( 'wp_footer', 'footerModals',100  );


function modify_wc_hooks() {
    
    remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
    remove_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_lost_password_form', 'woocommerce_output_all_notices', 10 );
    remove_action( 'before_woocommerce_pay', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_reset_password_form', 'woocommerce_output_all_notices', 10 );
	
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
	
}
add_action( 'init', 'modify_wc_hooks', 99 );

//disable cart and chekout
add_filter( 'woocommerce_is_purchasable','__return_false',10,2);

function my_woocommerce_taxonomy_args_product_tag( $array ) {
    $array['hierarchical'] = true;
	$array['rewrite']['hierarchical'] = true;
    return $array;
};
add_filter( 'woocommerce_taxonomy_args_product_tag', 'my_woocommerce_taxonomy_args_product_tag', 10, 1 );


add_action( 'init', 'custom_taxonomy_Item' );
function custom_taxonomy_Item()  {
$labels = array(
    'name'                       => 'Autos',
    'singular_name'              => 'Auto',
    'menu_name'                  => 'Autos',
    'all_items'                  => 'Todas las Autos',
    'parent_item'                => 'Padre Auto',
    'parent_item_colon'          => 'Padre Auto:',
    'new_item_name'              => 'Nueva Auto',
    'add_new_item'               => 'Agregar Nueva Auto',
    'edit_item'                  => 'Editar Auto',
    'update_item'                => 'Actualizar Auto',
    'separate_items_with_commas' => 'Separar con comas',
    'search_items'               => 'Buscar Auto',
    'add_or_remove_items'        => 'Agregar o eliminar Auto',
    'choose_from_most_used'      => 'Elegir entre las más usadas Autos',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
	'rewrite' => array(
		'slug' => "autos",
		'hierarchical' => true,
		'with_front'   => false,
	),
);
register_taxonomy( 'autos', 'product', $args );
register_taxonomy_for_object_type( 'auto', 'product' );
}


/*
add_filter( 'loop_shop_per_page', 'lw_loop_shop_per_page', 30 );

function lw_loop_shop_per_page( $products ) {
 $products = 12;
 return $products;
}

*/


//redirect pagina autos a catalogo
add_action( 'get_header', 'so16738311_redirect', 0 );
function so16738311_redirect()
{
    if( is_page(1036) ) {
        wp_redirect( home_url( '/catalogo/' ), 301 );
        exit;
    }
}


// ordenar productos por post metas
add_filter('woocommerce_get_catalog_ordering_args', 'wh_catalog_ordering_args');

function wh_catalog_ordering_args($args) {
    global $wp_query;
    if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) {
            
            case 'kilometraje-asc' :
                $args['order'] = 'ASC';
                $args['meta_key'] = 'kilometros';
                $args['orderby'] = 'meta_value_num';
                break;
            case 'kilometraje-desc' :
                $args['order'] = 'DESC';
                $args['meta_key'] = 'kilometros';
                $args['orderby'] = 'meta_value_num';
                break;
            case 'ano-asc' :
                $args['order'] = 'ASC';
                $args['meta_key'] = 'ano';
                $args['orderby'] = 'meta_value_num';
                break;
            case 'ano-desc' :
                $args['order'] = 'DESC';
                $args['meta_key'] = 'ano';
                $args['orderby'] = 'meta_value_num';
                break;
				
        }
    }
    return $args;
	
	//$myvalues = get_post_meta($post->ID,'kilometros',true);
}


add_filter( 'woocommerce_default_catalog_orderby_options', 'wh_catalog_orderby' );
add_filter('woocommerce_catalog_orderby', 'wh_catalog_orderby');

function wh_catalog_orderby($sortby) {
	
	$show0kmPrice = get_field('precio_en_0km', 'option');
	$term = get_queried_object(); 
	$ancestors = get_ancestors( $term->parent, $term->taxonomy );
	
	// para usados tanto modelos, marca como categoria padre se usan orders adicionales
	
	if( ( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ) ||
		( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( $show0kmPrice ) ) || 
		( ( is_shop() || is_tax('autos') ) && ( $show0kmPrice ) ) ){
		$sortby['price'] 			= 'Menor Precio';
		$sortby['price-desc'] 		= 'Mayor Precio';			
	}
	
	if( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ){
		
		//$sortby['menu_order'] 		= "Alfabeticamente";		
		$sortby['kilometraje-asc']  = 'Menor kilometraje';
		$sortby['kilometraje-desc'] = 'Mayor kilometraje';
		$sortby['ano-asc']  		= 'Menor antigüedad ';
		$sortby['ano-desc'] 		= 'Mayor antigüedad ';	
		
	}else if( is_shop() || is_tax('autos') ){		
		
		$sortby['kilometraje-asc']  = 'Por 0km';
		$sortby['kilometraje-desc'] = 'Por Usados';		
	}
	

		
	
	unset($sortby["menu_order"]);
	unset($sortby["popularity"]);
	unset($sortby["rating"]);
	unset($sortby["date"]);
	
    return $sortby;
}


//inicio cambio de como se ordenan los filtros de 0km usados y cuando conviven ambos

add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

function custom_default_catalog_orderby() {
	
	$show0kmPrice = get_field('precio_en_0km', 'option');
	$term = get_queried_object(); 
	$ancestors = get_ancestors( $term->parent, $term->taxonomy );
	
	// para usados tanto modelos, marca como categoria padre se usan orders adicionales
	
	if( ( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ) ||
		( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( $show0kmPrice ) ) || 
		( ( is_shop() || is_tax('autos') ) && ( $show0kmPrice ) ) ){
			return 'price';		
	}
	
	if( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( !$show0kmPrice ) ){
		return 'price';		
	}
	
	if( ( is_shop() || is_tax('autos') ) && ( !$show0kmPrice ) ){
			return 'kilometraje-asc';	
	}		
	
	
     
}


function orderDefaultMeta(){
	
	$show0kmPrice = get_field('precio_en_0km', 'option');
	$term = get_queried_object(); 
	$ancestors = get_ancestors( $term->parent, $term->taxonomy );	

	if( ( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ) ||
		( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( $show0kmPrice ) ) || 
		( ( is_shop() || is_tax('autos') ) && ( $show0kmPrice ) ) ){
			return '_regular_price';		
	}
	
	if( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( !$show0kmPrice ) ){
		return '_regular_price';		
	}
	
	if( ( is_shop() || is_tax('autos') ) && ( !$show0kmPrice ) ){
			return 'kilometros';	
	}	

}
//fin cambio de como se ordenan los filtros de 0km usados y cuando conviven ambos

// fin ordenar productos por post metas

add_action('wp_head', 'wh_alter_pro_cat_desc', 2);

function wh_alter_pro_cat_desc(){
	
	$des = ""; $keys = "";
	
    if ( is_product_category() || is_tax('autos') ){
		
        $term = get_queried_object();
        $productCatMetaDesc = $term->description;
		
		$keywords = get_term_meta($term->term_id, 'meta_keywords', true);
		
        if ( !empty($productCatMetaDesc) ){
        ?>
        <meta name="description" content="<?= $productCatMetaDesc; ?>">
		<?php } ?>
        <?php
		
		if( !empty( $keywords ) ){
		?>	
		<meta name="keywords" content="<?= $keywords; ?>" >
		<?php
		}
		
    }else if ( is_shop() ){
		
		$des = get_field('meta_description',16);
		$keys = get_field('meta_keywords',16); 
		
		if( $des != "" ){
        ?>
        <meta name="description" content="<?= $des; ?>">
		<?php } ?>
		<?php if( $keys != "" ){ ?>
		<meta name="keywords" content="<?= $keys; ?>" >
		<?php } ?>
        <?php		
	}else if (  is_page_template('planesAhorro.php') || 
				is_page_template('cotizador.php') || 
				is_page_template('comparador.php') || 
				is_page_template('heroInteriorPage.php') || 
				is_page_template('nosotros.php') || 
				is_page_template('blog.php') || 
				is_page_template('postventa.php') || 
				is_page_template('presupuestador.php') || 
				is_page_template('cotizador.php') || 
				is_page_template('front-page.php') ) {
					
				$des  = get_field('meta_description');
				$keys = get_field('meta_keywords'); 
        
				if( $des != "" ){
				?>
				<meta name="description" content="<?= $des; ?>">
				<?php } ?>
				<?php if( $keys != "" ){ ?>
				<meta name="keywords" content="<?= $keys; ?>" >
				<?php } 
	}else if ( is_product() ){

		$des = get_field('meta_description');
		$keys = get_field('meta_keywords'); 
		
		if( $des != "" ){
        ?>
        <meta name="description" content="<?= $des; ?>">
		<?php } ?>
		<?php if( $keys != "" ){ ?>
		<meta name="keywords" content="<?= $keys; ?>" >
		<?php } 
		
	}else if ( is_category() ){
		
        $term = get_queried_object();		

		$keys = get_term_meta($term->term_id, 'meta_keywords', true);
		$des  = get_term_meta($term->term_id, 'meta_description', true);
		
		if( $des != "" ){
        ?>
        <meta name="description" content="<?= $des; ?>">
		<?php } ?>
		<?php if( $keys != "" ){ ?>
		<meta name="keywords" content="<?= $keys; ?>" >
		<?php } 
		
	}else if ( is_single() ){
		$des = get_field('meta_description');
		$keys = get_field('meta_keywords'); 
		
		if( $des != "" ){
        ?>
        <meta name="description" content="<?= $des; ?>">
		<?php } ?>
		<?php if( $keys != "" ){ ?>
		<meta name="keywords" content="<?= $keys; ?>" >
		<?php } 		
	}
	
}




function change_title () {
    global $paged;
	
    if ( is_product_category() || is_tax('autos') ){
		
        $page = get_query_var('page');
        if ($paged > $page){
            $page = $paged;
        }

        $term = get_queried_object();
        $title = get_term_meta($term->term_id, 'titulo_seo', true);
		
        $page_part = (!empty($page) && ($page > 1)) ? ' | ' . 'Página ' . $page : '';
        $title = $title . $page_part;
    }else if ( is_product() ){
		/*
		global $post;
		
		$id = $post->ID;		
		
		$ar = getTermById( $id );
		$tit = get_the_title( $id );
		
		$final = ( $ar[0][0] == "Usados" ? "Usados" : "0 KM" );
		//var_dump($ar);
		$title = $tit." - ". $ar[0][2] . " - ". $ar[0][1] ." -  Catálogo de Autos ". $final. " | Autocity";
		*/
		
		$title = get_field('meta_title');
	}else if ( is_shop() ){

        $page = get_query_var('page');
        if ($paged > $page){
            $page = $paged;
        }

        //$term = get_queried_object();
		//var_dump( $term );
		
        $title = get_field('meta_title',16);
		
        $page_part = (!empty($page) && ($page > 1)) ? ' | ' . 'Página ' . $page : '';
        $title = $title . $page_part;
		
	}else if (  is_page_template('planesAhorro.php') || 
				is_page_template('cotizador.php') || 
				is_page_template('comparador.php') || 
				is_page_template('heroInteriorPage.php') || 
				is_page_template('nosotros.php') || 
				is_page_template('blog.php') || 
				is_page_template('postventa.php') || 
				is_page_template('presupuestador.php') || 
				is_page_template('cotizador.php') ||
				is_page_template('front-page.php') ) {
				
				$title = get_field('meta_title' );
				
	}else if ( is_tax('category') ){
		
        $page = get_query_var('page');
        if ($paged > $page){
            $page = $paged;
        }
		
        $title = get_field('meta_title');
		
        $page_part = (!empty($page) && ($page > 1)) ? ' | ' . 'Página ' . $page : '';
        $title = $title . $page_part;
		
	}else if ( is_single() ){
		
		$title = get_field('meta_title');		
	}
	
	
    return $title;
}

add_filter('pre_get_document_title', 'change_title');


// borro las imagenes adjuntas cuando se borra un post ( si se boora tambien de trash )
/*
add_action( 'before_delete_post', function( $id ) {
  $attachments = get_attached_media( '', $id );
  foreach ($attachments as $attachment) {
    wp_delete_attachment( $attachment->ID, 'true' );
  }
} );
*/

// create a autocity page menu for global settings
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Autocity General',
		'menu_title'	=> 'Autocity General',
		'menu_slug' 	=> 'autocity-general',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}


add_action('acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts');
function my_acf_admin_enqueue_scripts() {
   // wp_enqueue_style( 'my-acf-input-css', get_stylesheet_directory_uri() . '/css/my-acf-input.css', false, '1.0.0' );
    wp_enqueue_script( 'my-acf-input-js', get_stylesheet_directory_uri() . '/assets/js/templates/my-acf-input.js', false, '1.0.0' );
}


add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
	
	$term = get_queried_object(); 
	
	$term_id = $term->term_id;
	$taxonomy = $term->taxonomy;
	$parentId = $term->parent;
	$name = $term->name;
	
	$ancestors = get_ancestors( $parentId, $taxonomy );	

	if( $name == "product" || $taxonomy == "autos" || ( $taxonomy == "product_cat" && ( $term_id == 152 || $parentId == 152 || $ancestors[0] == 152 ) ) ){

		$classes[] = 'customClassUsados';
		
	}	
    
    return $classes;
    
}



function getCategoriesRelatedModelBrad( $pid, $cantToshow ){

	
	$cats = get_the_terms( $pid, "product_cat" );
	
	//var_dump( $cats );
	
	foreach( $cats as $cat ){
		if( $cat->parent == 0 ){
			$parent = $cat->term_id;
		}
	}
	
	
	foreach( $cats as $cat ){
		if( $cat->parent == $parent ){
			$marca = $cat->term_id;
		}
	}

	foreach( $cats as $cat ){
		if( $cat->parent == $marca ){
			$modelo = $cat->term_id;
		}
	}
	
	//echo $modelo." - ".$marca;
	
	$model = get_posts(
		array(
			'posts_per_page' => -1,
			'post__not_in' => array( $pid ),
			'post_type' => 'product',
			'orderby' => 'meta_value_num',
			'meta_type' => 'NUMERIC',
			'order' => 'ASC',			
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $modelo,
				)
			),
			'meta_query' => array(
				array(
				   'key'=>'_regular_price',
				   'type'      => 'NUMERIC',        
				)
			)
		)
	);	
	
	
	if( count($model) <= $cantToshow  ){

		$brand = get_posts(
			array(
				'posts_per_page' => -1,
				'post__not_in' => array( $pid ),
				'post_type' => 'product',
				'orderby' => 'meta_value_num',
				'meta_type' => 'NUMERIC',
				'order' => 'ASC',				
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'term_id',
						'terms' => $marca,
					)
				),
				'meta_query' => array(
					array(
					   'key'=>'_regular_price',
					   'type'      => 'NUMERIC',        
					)
				)
			)
		);	
		
		//echo count($model) + count($brand);
		
		if( ( count($model) + count($brand) ) >= $cantToshow ){

			$ids = array();
			
			foreach( $model as $key => $mod ){
				array_push($ids, $mod->ID);
			}			
			
			
			foreach( $brand as $key => $bra ){
				array_push($ids, $bra->ID);
			}
			
			$ids = array_unique($ids);
			
			//var_dump($ids);
			
			$stringIds = "";
			foreach( $ids as $i ){
				
				//if( $i !=  $pid )
					$stringIds .= $i.",";
			}
			
			$stringIds = trim($stringIds,",");


			$par = get_posts(
				array(
					'include' => "'".$stringIds."'",
					'post__not_in' => array( $pid ),
					'post_type' => 'product',
					'orderby' => 'meta_value_num',
					'meta_type' => 'NUMERIC',
					'order' => 'ASC',				
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => $parent,
						)
					),
					'meta_query' => array(
						array(
						   'key'=>'_regular_price',
						   'type'      => 'NUMERIC',        
						)
					)
				)
			);

			$final = $par;			

			
		}else{
			
			$ids = array();
			
			foreach( $model as $key => $mod ){
				array_push($ids, $mod->ID);
			}			
			
			
			foreach( $brand as $key => $bra ){
				array_push($ids, $bra->ID);
			}
			
			$parentCats = get_posts(
				array(
					'post__not_in' => array( $pid ),
					'posts_per_page' => -1,
					'post_type' => 'product',
					'orderby' => 'meta_value_num',
					'meta_type' => 'NUMERIC',
					'order' => 'ASC',				
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => $parent,
						)
					),
					'meta_query' => array(
						array(
						   'key'=>'_regular_price',
						   'type'      => 'NUMERIC',        
						)
					)
				)
			);			
			
			//var_dump($parentCats);
			
			foreach( $parentCats as $key => $par ){
				array_push($ids, $par->ID);
			}			
			
			$ids = array_unique($ids);
			
			//var_dump($ids);
			
			$stringIds = "";
			foreach( $ids as $i ){
				
				//if( $i !=  $pid )
					$stringIds .= $i.",";
			}
			
			$stringIds = trim($stringIds,",");

			//echo $stringIds;

			$brandIds = get_posts(
				array(
					'include' => "'".$stringIds."'",
					'post__not_in' => array( $pid ),
					'post_type' => 'product',
					'orderby' => 'meta_value_num',
					'meta_type' => 'NUMERIC',
					'order' => 'ASC',				
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => $parent,
						)
					),
					'meta_query' => array(
						array(
						   'key'=>'_regular_price',
						   'type'      => 'NUMERIC',        
						)
					)
				)
			);
			
			//if()
			
			//echo " ----- ".count($brand);
			
			$final = $brandIds;
		
		}
		
		
		
	}else{
		$final = $model;
	}
	
	return $final;
	
}

function getCategoriesUsadosNuevos( $pid, $cantToshow ){

	$final = get_posts(
		array(
			'post_status' => "publish",
			'posts_per_page' => $cantToshow,
			'post_type' => 'product',
			'orderby' => 'meta_value_num',
			'meta_type' => 'NUMERIC',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $pid,
				)
			),
			'meta_query' => array(
				array(
				   'key'=>'_regular_price',
				   'type'      => 'NUMERIC',        
				)
			)
		)
	);			
	
	return $final;
	
}


function getTermById( $pid ){

	$rarray = array();
	$cats = get_the_terms( $pid, "product_cat" );
	
	foreach( $cats as $cat ){
		if( $cat->parent == 0 ){
			$parentId = $cat->term_id;
			$parent = $cat->name;
		}
	}
	
	foreach( $cats as $cat ){
		if( $cat->parent == $parentId ){
			$marcaId = $cat->term_id;
			$marca = $cat->name;
		}
	}

	foreach( $cats as $cat ){
		if( $cat->parent == $marcaId ){
			$modeloId = $cat->term_id;
			$modelo = $cat->name;
		}
	}
	
	array_push( $rarray, array( $parent, $marca, $modelo ) );
	
	return $rarray;
}


/*
add_filter( 'terms_clauses', function ( $pieces, $taxonomies, $args )
{
    // Bail if we are not currently handling our specified taxonomy
    if ( !in_array( 'speight_plans', $taxonomies ) )
        return $pieces;

    // Check if our custom argument, 'wpse_parents' is set, if not, bail
    if (    !isset ( $args['wpse_parents'] )
         || !is_array( $args['wpse_parents'] )
    ) 
        return $pieces;

    // If  'wpse_parents' is set, make sure that 'parent' and 'child_of' is not set
    if (    $args['parent']
         || $args['child_of']
    )
        return $pieces;

    // Validate the array as an array of integers
    $parents = array_map( 'intval', $args['wpse_parents'] );

    // Loop through $parents and set the WHERE clause accordingly
    $where = [];
    foreach ( $parents as $parent ) {
        // Make sure $parent is not 0, if so, skip and continue
        if ( 0 === $parent )
            continue;

        $where[] = " tt.parent = '$parent'";
    }

    if ( !$where )
        return $pieces;

    $where_string = implode( ' OR ', $where );
    $pieces['where'] .= " AND ( $where_string ) ";

    return $pieces;
}, 10, 3 );

*/


function mobileOrDeskFiltro(){

	$useragent = $_SERVER['HTTP_USER_AGENT'];

	$dk = get_field('cards_desk_filtro', 'option');
	$mb = get_field('cards_mobile_filtro', 'option');

	$toShow = $dk;

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		$toShow = $mb;
	}
	
	return $toShow;
}


function orderItems2( $list, $id = false, $brandModel = false ){
	$result = array();
	foreach ( $list as $key => $item) {
		
		if( $brandModel ){
			//var_dump($list);
			$firstLetter = substr( $item[2], 0, 1);
		}else{
			$firstLetter = substr( $key, 0, 1);
		}	
		
		if( $id ){
			$result[$firstLetter][] = array( $key, $item[0], $item[1] );
		}else if( $brandModel ){
			$result[$firstLetter][] = array( $item[2], $item[0], $item[1], $key, $item[3], $item[4],$item[5] );
		}else{
			$result[$firstLetter][] = array( $key, $item );
		}
	}	
	
	return $result;
}


function htmlRender2( $listF, $id = false, $grupo ){
	
	$ret = "";

	foreach( $listF as $key => $value ){
		
		$ret .= '<div class="itemWrapper">';
		
			$ret .= '<h4 class="letter">';
				$ret .= $key;
			$ret .= '</h4>';
			
			$ret .= '<div class="items">';
			
			foreach( $value as $key1 => $value1 ){
				
				$valueLower = sanitize_title_with_dashes( $value1[0] );
				$valueLower = mb_convert_case( $valueLower, MB_CASE_LOWER, "UTF-8" );				
				
				if( $id ){
					if( $grupo == "segmentos" ){
						

						
						$ret .= '<h3 class="item" data-id="'.$valueLower.'" data-grupo="'.$grupo.'" >';
						
					}else if( $grupo == "marcas" || $grupo == "modelos" ){	
						
						$slug  = $value1[3];
						if( $value1[3] == "autos" ){
							$slug = $valueLower;
						}
						
						$ret .= '<h3 class="item" data-id="'.$valueLower.'" data-slug="'.$slug.'" data-parentitemslug="'.$value1[6].'" data-grupo="'.$grupo.'" >';					
					
					}else{
						$ret .= '<h3 class="item" data-id="'.$value1[2].'" data-grupo="'.$grupo.'" >';
					}
				}else{
					$ret .= '<h3 class="item" data-id="" data-grupo="'.$grupo.'" >';
				}
					$ret .= "<span onclick='changeFilter(this, true )' >".ucfirst( mb_convert_case( $value1[0], MB_CASE_LOWER, "UTF-8" ) )."</span><span onclick='changeFilter(this, true )' >(".$value1[1].")</span>";
				$ret .= '</h3>';
			}
			$ret .= '</div>';
			
		$ret .= '</div>';
	}
	
	return $ret;
	
}


function formatingValues($data,$attr){
	
	$ret = "";
	
	$formating 	 = trim( $data,"");
	$explodeData = explode("-", $formating);

	$min = ucwords( mb_convert_case( $explodeData[0], MB_CASE_LOWER, "UTF-8" ) ); 
	$min = number_format( $min, 0, ',', '.');
	
	$max = ucwords( mb_convert_case( $explodeData[1], MB_CASE_LOWER, "UTF-8" ) ); 
	$max = number_format( $max, 0, ',', '.');
	
	if( $attr == "kms" ){
		$ret = $min." Kms - ".$max." Kms";
	}else if( $attr == "precio" ){
		$ret = "$".$min." - $".$max;
	}else if( $attr == "a" ){
		$ret = $min." - ".$max;
	}
	
	return $ret;
	
}



add_filter( 'http_request_timeout', 'wp9838c_timeout_extend' );

function wp9838c_timeout_extend( $time )
{
    // Default timeout is 5
    return 300000000000000000;
}

function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');


// remove wp version number from scripts and styles
function remove_css_js_version( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );


/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

function getImageByDb( $imgDatos ){
	
	if( $imgDatos === false  ){
		$src = "/wp-content/themes/ed-theme-child/assets/images/default.jpg";
	}else{
		$imgDatos = json_decode($imgDatos);
		
		if( empty( $imgDatos ) ){
			$src = "/wp-content/themes/ed-theme-child/assets/images/default.jpg";
		}else{
			
			
			$images = getImageTypeIdCatalog( $imgDatos );
			
			if( empty( $images ) ){
				$src = "/wp-content/themes/ed-theme-child/assets/images/default.jpg";
			}else{
				$src = $images[0]['base'].$images[0]['mini_url'];
			}
			
		}
	}	
	
	return $src;
	
}


function getImageTypeIdCatalog( $files ){
		
	$imagesGet = array();
	
	if( !empty( $files ) ){
	
		foreach( $files as $key => $file ){
			
			$file = (array) $file;
			
			if( $file['type_id'] == 1 || $file['type_id'] == 3 ){
				
				//$file['base'] = "https://cdn-testing.asofix.com/";
				$file['base'] = "https://cdn.asofix.com/";
				$imagesGet[] = $file;
			}
			
		}
	
	}
	
	return $imagesGet;
	
}


function slugify($text){
    // Strip html tags
    $text=strip_tags($text);
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    setlocale(LC_ALL, 'en_US.utf8');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);
    // Check if it is empty
    if (empty($text)) { return 'n-a'; }
    // Return result
    return $text;
}



function getCompania( $brand ){
	
	$compania = "";
	if( empty( $brand ) )
		return $compania;
	
	
	$brand = mb_convert_case( $brand, MB_CASE_LOWER, "UTF-8" );
	
	if( $brand == "chrysler" ){
		$compania = "RUBIC";
	}else if( $brand == "renault" ){
		$compania = "TAGLE";
	}else if( $brand == "fiat" ){
		$compania = "MOTCOR";
	}else if( $brand == "volkswagen" ){
		$compania = "ROLEN";
	}else if( $brand == "peugeot" ){
		$compania = "AVANT";
	}else if( $brand == "nissan" ){
		$compania = "NIX";
	}else{
		$compania = "AUTOCITY";
	}
	
	return $compania;
	
}


add_filter( 'wpcf7_form_elements', function($form) { 

	$val = esc_url( AUTOCITY_HOME . $_SERVER['REQUEST_URI'] ); 
	$form = str_replace( 'pageurl', $val, $form ); 
	
	return $form; 
	
} );