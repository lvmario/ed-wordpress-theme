<section id="hero" class="hero">
		
		<?php
			$backgroundImage				= get_field( "hero_responsive_background_image_desktop" );
			$backgroundImageMobile 	= get_field( "hero_responsive_background_image_mobile" );
			$titulo 								= get_field( "titulo_presu" );
			$descripcion 						= get_field( "descripcion_presu", false, false );
			$anchor_button_text 		= get_field( "anchor_button_text" );
			$anchor_button_link 		= esc_url( get_field( "anchor_button_link" ));
			
			$image 									= wp_get_attachment_image_src( $backgroundImage, 'hero' );
			$imageMobile 						= wp_get_attachment_image_src( $backgroundImageMobile, 'thumbGeneral' );
		?>
	
		<div 
			class="responsive-hero responsive-hero-desktop <?= "heroInterior-".$post->ID ?>" 
			data-bg-image-associated="<?php echo esc_url ( $image[0] ); ?>" 
			style="background: linear-gradient(86.66deg, #000000 -7.48%, rgba(0, 0, 0, 0.2) 59.32%), url( <?php echo esc_url ( $image[0] ); ?> ) no-repeat center; background-size: cover;">
			<div class="responsive-hero-content">
				<?php if ( $titulo ) : ?>
					<h1 class="hero-title"><?php echo $titulo; ?></h1>
				<?php endif; ?>
				<?php if ( $descripcion ) : ?>
					<p class="hero-description"><?php echo $descripcion; ?></p>
				<?php endif; ?>
				<?php if ( !empty( $anchor_button_text ) && !empty( $anchor_button_link ) ) { ?>						
					<?php if ( !is_page(392) ) { ?>
						<a class="cta-link btn-secondary-light-inverted" href="<?= $anchor_button_link; ?>"><?= $anchor_button_text; ?></a>
					<?php } else { ?>	
						<a class="cta-link btn-secondary-light-inverted" aria-label="Abrir formulario de contacto" data-bs-toggle="modal" data-bs-target="<?= $anchor_button_link; ?>" href="javascript:void(0)" ><?= $anchor_button_text; ?></a>
					<?php } ?>	
				<?php } ?>
			</div>
		</div>
		
		<div 
			class="responsive-hero responsive-hero-mobile <?= "heroInterior-".$post->ID ?>" 
			data-bg-image-associated="<?php echo esc_url ( $imageMobile[0] ); ?>" 
			style="background: linear-gradient(86.66deg, #000000 -7.48%, rgba(0, 0, 0, 0.2) 59.32%), url( <?php echo esc_url ( $imageMobile[0] ); ?> ) no-repeat center; background-size: cover;">
			<div class="responsive-hero-content">
				<?php if ( $titulo ) : ?>
					<h1 class="hero-title"><?php echo $titulo; ?></h1>
				<?php endif; ?>
				<?php if ( $descripcion ) : ?>
					<p class="hero-description"><?php echo $descripcion; ?></p>
				<?php endif; ?>
				<?php if ( !empty( $anchor_button_text ) && !empty( $anchor_button_link ) ) { ?>						
					<?php if ( !is_page(392) ) { ?>
						<a class="cta-link btn-secondary-light-inverted" href="<?= $anchor_button_link; ?>"><?= $anchor_button_text; ?></a>
					<?php } else { ?>	
						<a class="cta-link btn-secondary-light-inverted" aria-label="Abrir formulario de contacto" data-bs-toggle="modal" data-bs-target="<?= $anchor_button_link; ?>" href="javascript:void(0)" ><?= $anchor_button_text; ?></a>
					<?php } ?>	
				<?php } ?>
			</div>
		</div>
		
	</section>