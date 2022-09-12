<?php
get_header();
?>
	<main class="default-page" id="content">

		<?php if ( have_posts() ) : ?>

			<?php
			
			while ( have_posts() ) :
				the_post();
					the_content();
			endwhile;

		endif;
		?>
	</main>

<?php
get_footer();
