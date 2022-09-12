<div class="footer-contact-data">
	<h5 class="phone"><i class="phone"></i><?php echo esc_html( $instance['phone'] ); ?></h5>
		<?php

		unset($instance['phone']);

		$i=1;
		foreach ($instance as $line => $text) :
			$text = apply_filters( 'widget_custom_html_content', $text, $instance, $this );

			if ( ! empty($text) ) {
?>
				<p class="contact-info"><?php echo ($text); ?></p>
<?php
			}

			$i++;	
		endforeach;
		?>
	</ul>
</div>





