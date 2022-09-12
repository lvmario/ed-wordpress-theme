<?php

$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
?>

<!-- Column Title -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
<?php esc_attr_e( 'Título de la columna', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
value="<?php echo esc_attr( $title ); ?>">
</p>

<!-- Column Title -->

<?php
for ($i=1; $i <= 3; $i++) { 

    $link_name = ! empty( $instance['link_name_' . $i ] ) ? $instance['link_name_' . $i ] : '';
    $link_url  = ! empty( $instance['link_url_' . $i ] ) ? $instance['link_url_' . $i ] : '';
 
?>

<h3><?php echo esc_html( 'Link ' . $i ); ?></h3>

<!-- Link Name -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'link_name_' . $i ) ); ?>">
<?php esc_attr_e( 'Nombre del link', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_name_' . $i ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'link_name_' . $i ) ); ?>" type="text"
value="<?php echo esc_attr( $link_name ); ?>">
</p>
<!-- Link URL -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'link_url_' . $i ) ); ?>">
<?php esc_attr_e( 'URL del link', 'text_domain' ); ?>
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url_' . $i ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'link_url_' . $i ) ); ?>" type="text"
value="<?php echo esc_attr( $link_url ); ?>">
</p>

<?php   
}


