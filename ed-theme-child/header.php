<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ed-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge" />

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php $favicon_root_folder = get_stylesheet_directory_uri() . "/assets/images/favicon"; ?>

	<!--8C -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-57x57.png'); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-60x60.png'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-76x76.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-114x114.png'); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-120x120.png'); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-144x144.png'); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-152x152.png'); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url ($favicon_root_folder . '/apple-touch-icon-180x180.png'); ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo esc_url ($favicon_root_folder . '/icon-192x192.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url ($favicon_root_folder . '/icon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url ($favicon_root_folder . '/icon-96x96.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url ($favicon_root_folder . '/icon-16x16.png'); ?>">
	
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo esc_url ($favicon_root_folder . '/favicon.ico'); ?>">
	<!-- <link rel="manifest" href="/manifest.json"> -->
	<meta name="theme-color" content="#ff6a00;">
	<meta name="msapplication-TileImage" content="<?php echo esc_url ($favicon_root_folder . '/mstile-144x144.png'); ?>">
	<meta name="msapplication-TileColor" content="#ff6a00">
	
	<meta name="google-site-verification" content="oz9J9bubQxR7Qrn0m86mJwX8mMzgqIlf4P6eFYbnKcw" />

	<?php wp_head(); ?>
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-K2JZZ78');</script>
	<!-- End Google Tag Manager -->	

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K2JZZ78"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>
<div id="page" class="site container-fluid g-0">

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="navbar navbar-expand-lg main-navigation row g-0">
			<a class="navbar-brand logo" href="<?php echo get_home_url() ?>/">
				<img class="img-fluid" src="<?php echo esc_url ( get_stylesheet_directory_uri() . "/assets/images/logo/logo.svg" ); ?>" alt="Logo Autocity">
			</a>
		
			 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
			 	<span class="navbar-toggler-icon"></span>
		 	</button>

			 <div class="collapse navbar-collapse" id="navbar-content">
			 	<?php

			 // 	class Autocity_Walker_Nav_Menu extends Walker_Nav_Menu {
				//   function start_lvl(&$output, $depth) {
				//     $indent = str_repeat("\t", $depth);
				//     $output .= "\n$indent<ul class=\"dropdown\">\n";
				//   }
				// }


				wp_nav_menu(
					array(
						'menu' 			 => 'primary-menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'navbar-nav menu-elements',	
						// 'walker' 		 =>  new Autocity_Walker_Nav_Menu()	
					)
				);

				

				?>


			</div>	
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->