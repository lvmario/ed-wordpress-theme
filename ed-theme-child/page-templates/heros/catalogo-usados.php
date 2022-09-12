<?php

//catalogo page
$rows = get_field('hero_catalogo_usados',16);

$noHero = true;
if( $rows ) {
	$noHero = false;
	
	//var_dump($rows);
	$cRows = count( $rows );
?>

<section id="hero" class="hero">

	<div class="carousel-window" id="carousel-catalogo">
	
		<?php if( $cRows > 1 ){ ?>
		<ul class="carousel">
		<?php }else{ ?>
		<ul class="carouselJustOne">
		<?php } ?>
		<?php 
			$i = 1;
			//echo count( $rows );
			
			foreach( $rows as $row ) {
		
				$imageDK = wp_get_attachment_image_src( $row['imagen_desktop'], 'full' );
				$imageMB = wp_get_attachment_image_src( $row['imagen_mobile'], 'full' );
				$link    = $row['link_imagen'];

				if( empty( $link ) )
					$link = "javascript: void(0)";
				
				if( $cRows > 1 ){
			
			?>		
			<li>
				<a href="<?php echo $link; ?>">
					<!-- Carousel image desktop view -->
					<div id="<?php echo esc_attr ( 'slide-' . $i ) ?>" 
						class="slide slide-image-desktop" 
						data-bg-image-associated="<?php echo esc_url ( $imageDK[0] ); ?>" 
						style="background: url( <?php echo esc_url ( $imageDK[0] ); ?> ); background-size: cover;">
					</div>

					<!-- Carousel image mobile view -->
					<div id="<?php echo esc_attr ( 'slide-' . $i ) ?>" 
						class="slide slide-image-mobile" 
						data-bg-image-associated="<?php echo esc_url ( $imageMB[0] ); ?>" 
						style="background: url( <?php echo esc_url ( $imageMB[0] ); ?> ); background-size: cover;">
					</div>
				</a>	
			</li>
			<?php 
				$i++;
				
				}else{
			?>
			<li>
				<a href="<?php echo $link; ?>">
					<!-- Carousel image desktop view -->
					<div id="<?php echo esc_attr ( 'slide-1' ) ?>" class="slide slide-image-desktop" >
						<img src="<?php echo esc_url ( $imageDK[0] ); ?>" />
					</div>

					<!-- Carousel image mobile view -->
					<div id="<?php echo esc_attr ( 'slide-1' ) ?>" class="slide slide-image-mobile" >
						<img src="<?php echo esc_url ( $imageMB[0] ); ?>" />
					</div>
				</a>	
			</li>
			<?php 			
				}
			
			}
			?>
		</ul>
		
		<?php if( $cRows > 1 ){ ?>
		<div class="ctrlsHeroblogWrapper">
			<div class="ctrlsHeroblog">
				<ul class="carousel-nav hero-navigator">
					<?php 
					
						$number = count( $rows );
						for ($i=1; $i<=$number ; $i+1) : 
							$button_class = ( 1 === $i ) ? "active" : "";
						?>
							<li class="<?php echo esc_attr($button_class) ?>">
								<button data-target="<?php echo esc_attr ($i) ?>"></button>
							</li>
					<?php 
						$i++;
					endfor; ?>
				</ul>

				<div class="arrowsHeroBlog">
					<button class="<?php echo esc_attr($button_class) ?> cta-link prev" ><</button>
					<button class="<?php echo esc_attr($button_class) ?> cta-link next" >></button>
				</div>
			</div>
		</div>
		<?php } ?>
		
	</div>
</section>

<?php }