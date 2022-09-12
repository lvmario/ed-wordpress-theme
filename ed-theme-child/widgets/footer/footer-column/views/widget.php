<div class="footer-column">
	<h5 class="title"><?php echo esc_html( $instance['title'] ); ?></h5>
	<ul class="links-list">
			<?php

			unset($instance['title']);
			$links = array_chunk($instance, 2, true); //Each link have 2 fields
	
			$i=1;
			foreach ($links as $key => $link) :
				
				//Initialize the link instance by merging it with the defaults in case some field are missing
				$defaults = array ( 
					'link_name_' . $i  => '', 
					'link_url_' . $i  => ''
				);

				$link = wp_parse_args( $link, $defaults );
				if ( ! empty($link[ 'link_url_' . $i ] ) && ! empty( $link[ 'link_name_' . $i ]) ) {
?>
				<li>	
					<a href="<?php echo esc_url( $link[ 'link_url_' . $i ] ); ?>"><?php echo esc_html( $link[ 'link_name_' . $i ] ) ?></a>
				</li>
<?php
				}

				$i++;	
			endforeach;
			?>
	</ul>
</div>





