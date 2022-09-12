<?php
$phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
?>

<!-- Phone Number -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>">
<?php esc_attr_e( 'Teléfono de contacto', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text"
value="<?php echo esc_attr( $phone ); ?>">
</p>

<?php

for ($i=1; $i <= 3; $i++) { 

    $line = ! empty( $instance['line_' . $i ] ) ? $instance['line_' . $i ] : '';
 
?>

<h3><?php echo esc_html( 'Linea ' . $i ); ?></h3>

<!-- Line -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'line_' . $i ) ); ?>">
<?php esc_attr_e( 'Texto', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'line_' . $i ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'line_' . $i ) ); ?>" type="text"
value="<?php echo esc_attr( $line ); ?>">
</p>
<?php   
}

