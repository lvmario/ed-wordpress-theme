<?php

/**
 * Template Name: Inicio
 */

get_header(); 

$page_assets_url = get_stylesheet_directory_uri() . "/assets/images/layouts/home/";
?>

<main class="front-page page" id="content">

<?php 	
		dynamic_sidebar( 'home_desktop' ); 
?>

</main>

<?php

get_footer();