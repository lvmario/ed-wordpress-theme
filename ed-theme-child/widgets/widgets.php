<?php
/**
 * Register widget areas.
 *
 */
function autocity_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home widget area',
		'id'            => 'home_desktop',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	//Add social media footer column before footer widget area
	ob_start();
	include AUTOCITY_THEME_PATH . "widgets/footer/partials/social-media-footer.php";
	$social_media_footer = ob_get_clean();

	//Add copyright footer after footer widget area
	// ob_start();
	// include AUTOCITY_THEME_PATH . "widgets/footer/partials/copyright-footer.php";
	// $copyright_footer = ob_get_clean();


	register_sidebar( array(
		'name'           => 'Footer widget area',
		'id'             => 'footer',
		'before_sidebar' => $social_media_footer,
		'before_title'   => '<h2>',
		'after_title'    => '</h2>',
	) );


}
add_action( 'widgets_init', 'autocity_widgets_init' );

require_once( AUTOCITY_THEME_PATH . "widgets/home/buscador/class-buscador-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/carousel-ac/class-carousel-ac-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/carousel-ac-usados/class-carousel-ac-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/hero/class-hero-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/posts-destacados/class-posts-destacados-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/comparador/class-comparador-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/cta-doble/class-cta-doble-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/form-contacto/class-form-contacto-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/empresas/class-empresas-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/home/mapa/class-mapa-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/footer/footer-column/class-footer-column-widget.php" );
require_once( AUTOCITY_THEME_PATH . "widgets/footer/footer-contact-data/class-footer-contact-data-widget.php" );