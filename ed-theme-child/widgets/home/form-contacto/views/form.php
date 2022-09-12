<?php

$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
$mail_to = ! empty( $instance['mail_to'] ) ? $instance['mail_to'] : '';
 
?>

<!-- Title -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' . $i ) ); ?>">
<?php esc_attr_e( 'Título', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' . $i ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'title' . $i ) ); ?>" type="text"
value="<?php echo esc_attr( $title ); ?>">
</p>
<!-- Description -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
<?php esc_attr_e( 'Descripción:', 'text_domain' ); ?>
</label>
<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?>
</textarea>
</p>
<!-- Mail to -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'mail_to') ); ?>">
<?php esc_attr_e( 'Mail de destino:', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mail_to' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'mail_to' ) ); ?>" type="text"
value="<?php echo esc_attr( $mail_to ); ?>">
</p>


