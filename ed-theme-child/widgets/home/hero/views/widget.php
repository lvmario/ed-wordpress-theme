<section id="hero" class="hero">			
	<div class="carousel-window">
		<ul class="carousel">
			<?php

			$slides = array_chunk($instance, 6, true); //Each slide have 6 fields
	
			$menu_items = array();

			$i=1;
		
			foreach ($slides as $key => $slide) :
				
				//Initialize the slide's instance by merging it with the defaults in case some field are missing
				$defaults = array ( 
					'title_slide_' . $i => '', 
					'description_slide_' . $i => '', 
					'cta_name_slide_' . $i=> '', 
					'cta_url_slide_' . $i => '', 
					'menu_item_name_slide_' . $i => '', 
					'background_image_url_slide_' . $i => ''
				);

				$slide = wp_parse_args( $slide, $defaults );

				//Collecting menu items to show it later
				$menu_items['slide_' . $i] = $slide['menu_item_name_slide_' . $i ];

				$slide_class = 'slide';

				?>

					<li>	
						<div id="<?php echo esc_attr ( 'slide-' . $i ) ?>" class="<?php echo esc_attr ($slide_class); ?>" data-bg-image-associated="<?php echo esc_url ( $slide['background_image_url_slide_' . $i] ); ?>" style="background: linear-gradient(86.66deg, #000000 -7.48%, rgba(0, 0, 0, 0.2) 59.32%), url( <?php echo esc_url ( $slide['background_image_url_slide_' . $i] ); ?> ); background-size: cover;">
							<div class="content">
								<h1 class="title"><?php echo esc_html ( $slide['title_slide_' . $i] ); ?></h1>
								<p class="description"><?php echo esc_html ( $slide['description_slide_' . $i] ); ?></p>
								<a class="cta-link" href="<?php echo esc_url ( $slide['cta_url_slide_' . $i] ); ?>"><?php echo esc_html ( $slide['cta_name_slide_' . $i] ); ?></a>
							</div>
						</div>
					</li>

				<?php
				$i++;	

			endforeach;

			?>

		</ul>

		<ul class="hero-navigator hero-text-buttons-nav">

				<?php
				$menu_items = array ( 
								'slide-1' => "Autocity",
								'slide-2' => "Planes de ahorro",
								'slide-3' => "Posventa",
								'slide-4' => "Empresas"
							);

				$i = 1;
				foreach	( $menu_items as $key => $menu_item ) :
					$menu_item_class = ( 'slide-1' === $key ) ? "item active" : "item";
				?>
					<li class="<?php echo esc_attr ($menu_item_class); ?>" ><button data-target="<?php echo esc_attr ( $i ) ?>"><?php echo esc_html ( $menu_item ); ?></a></li>

				<?php
				$i++;
				
			endforeach;
			?>

		</ul>

	</div>
</section>





