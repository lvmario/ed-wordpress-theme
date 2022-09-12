<?php
	get_header();
?>

<main class="page-404 page row">

	<section class="content-404 sectionWidth">
		<div class="info-404">
			<h1>Siempre te llevamos a donde querés llegar pero no pudimos encontrar lo que estás buscando.</h1>
			<p>Te compartimos algunos enlaces útiles:</p>
			<div class="menu-404">
				<?php echo wp_nav_menu( array(	'depth' => 1,) ); ?>
			</div>
		</div>
		<div class="image-404">
			<img src="<?php echo ASSETS_URL . 'images/layouts/404/404-image.png' ?>" alt="404">
		</div>
	</section>

</main>

<?php
	get_footer();