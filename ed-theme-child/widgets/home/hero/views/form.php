<?php

for ($i=1; $i <= 4; $i++) { 

    $title = ! empty( $instance['title_slide_' . $i ] ) ? $instance['title_slide_' . $i ] : '';
    $description = ! empty( $instance['description_slide_' . $i ] ) ? $instance['description_slide_' . $i ] : '';
    $cta_name = ! empty( $instance['cta_name_slide_' . $i ] ) ? $instance['cta_name_slide_' . $i ] : '';
    $cta_url = ! empty( $instance['cta_url_slide_' . $i ] ) ? $instance['cta_url_slide_' . $i ] : '';
    $menu_item_name = ! empty( $instance['menu_item_name_slide_' . $i ] ) ? $instance['menu_item_name_slide_' . $i ] : '';
    $background_image_url = ! empty( $instance['background_image_url_slide_' . $i ] ) ? $instance['background_image_url_slide_' . $i ] : '';
 
?>

    <h3><?php echo esc_html( 'Slide ' . $i ); ?></h3>

    <!-- Title -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'Título Slide', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'title_slide_' . $i ) ); ?>" type="text"
    value="<?php echo esc_attr( $title ); ?>">
    </p>
    <!-- Text -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'description_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'Descripción Slide:', 'text_domain' ); ?>
    </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'description_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'description_slide_' . $i ) ); ?>"><?php echo esc_attr( $description ); ?>
    </textarea>
    </p>
    <!-- CTA Name -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'cta_name_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'Nombre CTA:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_name_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'cta_name_slide_' . $i ) ); ?>" type="text"
    value="<?php echo esc_attr( $cta_name ); ?>">
    </p>
    <!-- CTA URL -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'cta_url_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'URL Link CTA:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_url_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'cta_url_slide_' . $i ) ); ?>" type="text"
    value="<?php echo esc_attr( $cta_url ); ?>">
    </p>
    <!-- Menu Item Name -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'menu_item_name_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'Nombre del ítem en el menú:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'menu_item_name_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'menu_item_name_slide_' . $i ) ); ?>" type="text"
    value="<?php echo esc_attr( $menu_item_name ); ?>">
    </p>
    <!-- Background Image URL -->
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'background_image_url_slide_' . $i ) ); ?>">
    <?php esc_attr_e( 'Imagen de fondo del slide:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'background_image_url_slide_' . $i ) ); ?>"
    name="<?php echo esc_attr( $this->get_field_name( 'background_image_url_slide_' . $i ) ); ?>" type="text"
    value="<?php echo esc_attr( $background_image_url ); ?>">
    </p>

<?php   
}


