<?php
get_header();

?>

<main class="single-page" id="content">

<?php

if ( has_post_thumbnail() ):
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero' );

?>

	<!-- Modal Compartir -->
	<div id="share-section" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content share-popup">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<?php echo do_shortcode( '[elementor-template id="593"]' ); ?>
			</div>
		</div>
	</div>

	<section id="hero" class="hero">

		<div class="carousel-window">
			<div 
				class="slide slideSinglePost" 
				data-bg-image-associated="<?php echo esc_url ( $image[0] ); ?>" 
				style="background: linear-gradient(86.66deg, #000000 -7.48%, rgba(0, 0, 0, 0.2) 59.32%), url( <?php echo esc_url ( $image[0] ); ?> ); background-size: cover;">
				<div class="content">
					<h2 class="title"><?= get_the_title(); ?></h2>
					<p class="description"><?php echo esc_html ( get_the_excerpt() ); ?></p>
					<p class="single-post-meta"><?php the_category(", ") ?><span class="single-post-meta-separator"> - </span><?php the_time('F d, Y'); ?></p>
				</div>
			</div>
		</div>
		
	</section>
<?php endif; ?>

<?php echo do_shortcode('[elementor-template id="150"]'); ?>

</main>
	
<?php
get_footer();
