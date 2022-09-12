<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <main> tag
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

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-57x57.png'); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-60x60.png'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-76x76.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-114x114.png'); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-120x120.png'); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-144x144.png'); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-152x152.png'); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url ($favicon_root_folder . '/apple-icon-180x180.png'); ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo esc_url ($favicon_root_folder . '/android-icon-192x192.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url ($favicon_root_folder . '/favicon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url ($favicon_root_folder . '/favicon-96x96.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url ($favicon_root_folder . '/favicon-16x16.png'); ?>">
	
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo esc_url ($favicon_root_folder . '/favicon.ico'); ?>">
	<!-- <link rel="manifest" href="/manifest.json"> -->
	<meta name="theme-color" content="#ff6a00;">
	<meta name="msapplication-TileImage" content="<?php echo esc_url ($favicon_root_folder . '/ms-icon-144x144.png'); ?>">
	<meta name="msapplication-TileColor" content="#ff6a00">


	<!-- Google Tag Manager -->
	<!-- End Google Tag Manager -->


	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>
<div id="page" class="site container-fluid">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'valegarrafa' ); ?></a>

	<header id="masthead" class="site-header row">
		<nav id="site-navigation" class="navbar navbar-expand-lg main-navigation offset-1 offset-r-1 col-10">
			<a class="navbar-brand logo" href="<?php echo get_home_url() ?>/" class="logo">
				<img class="img-fluid" src="<?php echo esc_url ( get_stylesheet_directory_uri() . "/assets/images/logo/logo.svg" ); ?>" alt="Logo Vale Garrafa">
			</a>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$theme_description = get_bloginfo( 'description', 'display' );
			if ( $theme_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>

		<!-- 9C -->
		
			 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
			 	<span class="navbar-toggler-icon"></span>
		 	</button>

			 <div class="collapse navbar-collapse" id="navbar-content">
				<ul class="navbar-nav menu-elements">
					<li class="nav-item">
						<a href="<?php echo get_home_url(); ?>/como-funciona/" class="nav-link mr-4 normal">Como funciona</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo get_home_url(); ?>/estabelecimentos-participantes/" class="nav-link mr-4 normal">Estabelecimentos participantes</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo get_home_url(); ?>/entrar/" class="nav-link login-box mr-3" aria-label="entrar"><i class="icon-login mr-3"></i>Entrar</a>
					</li>
				</ul>
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->