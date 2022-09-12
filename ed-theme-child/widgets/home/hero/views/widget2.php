<section id="hero" class="hero">
	<div class="carousel-window">
		<ul class="carousel">
			<?php

			$slides = array_chunk($instance, 6, true); //Each slide have 6 fields

			$i = 0;
			$menu_items = array();

			//Reorder slides to 3,0,1,2 instead of 0,1,2,3
			array_unshift($slides, end($slides));
			array_pop($slides);
			$slide_order = array (4,1,2,3);
			// d($slides);

			foreach ($slides as $key => $slide) :
				
				//Initialize the slide's instance by merging it with the defaults in case some field are missing
				$defaults = array ( 
					'title_slide_' . $slide_order[$i] => '', 
					'description_slide_' . $slide_order[$i] => '', 
					'cta_name_slide_' . $slide_order[$i]=> '', 
					'cta_url_slide_' . $slide_order[$i] => '', 
					'menu_item_name_slide_' . $slide_order[$i] => '', 
					'background_image_url_slide_' . $slide_order[$i] => ''
				);

				$slide = wp_parse_args( $slide, $defaults );

				//Collecting menu items to show it later
				$menu_items['slide_' . $slide_order[$i]] = $slide['menu_item_name_slide_' . $slide_order[$i] ];

				// $slide_class = ( 1 === $slide_order[$i] ) ? "slide active" : "slide";
				$slide_class = 'slide';
				// d($slide_order[$i]);

			?>
				<li>	
					<div id="<?php echo esc_attr ( 'slide-' . $slide_order[$i] ) ?>" class="<?php echo esc_attr ($slide_class); ?>" data-bg-image-associated="<?php echo esc_url ( $slide['background_image_url_slide_' . $slide_order[$i]] ); ?>" style="background: linear-gradient(86.66deg, #000000 -7.48%, rgba(0, 0, 0, 0.2) 59.32%), url( <?php echo esc_url ( $slide['background_image_url_slide_' . $slide_order[$i]] ); ?> ); background-size: cover;">
						<div class="content">
							<h2 class="title"><?php echo esc_html ( $slide['title_slide_' . $slide_order[$i]] ); ?></h2>
							<p class="description"><?php echo esc_html ( $slide['description_slide_' . $slide_order[$i]] ); ?></p>
							<a class="cta-link" href="<?php echo esc_url ( $slide['cta_url_slide_' . $slide_order[$i]] ); ?>"><?php echo esc_html ( $slide['cta_name_slide_' . $slide_order[$i]] ); ?></a>
						</div>
					</div>
				</li>
			<?php
				$i++;
				// if (3 === $i){
				// 	break;
				// }	
			endforeach;
			?>
			</ul>
			<ul class="hero-navigator">

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
		</ul>
	</div>
</section>





