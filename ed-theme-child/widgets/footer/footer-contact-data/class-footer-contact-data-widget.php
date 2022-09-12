<?php
/**
* Adds Footer_Contact_Data_Widget widget.
*/
class Footer_Contact_Data_Widget extends WP_Widget {
	
	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'footer_contact_data_widget', // Base ID
            'Información de contacto en footer', // Name
            array( 'description' => __( 'Permite añadir información de contacto en el footer', 'text_domain' ), ) // Args
        );
 
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_assets' );
    }

	//Enqueue assets
	public function enqueue_assets(){
		$handle = 'footer-contact-data';
		if ( ! wp_style_is(  $handle . '-widget', $list = 'enqueued' ) ) {//Avoid multiple footer column stylesheets
			wp_enqueue_style( $handle . '-widget', CSS_ASSETS_URL . 'widgets/' . $handle . '.css', array(), AUTOCITY_ASSETS_VERSION, "all" );
		}
	}

	/**
	* Front-end display of the widget.
	*
	* @param array $args Widget arguments.
	* @param array $instance Saved values from the database.
	*
	* @see WP_Widget::widget()
	*
	*/
	public function widget( $args, $instance ) {


		ob_start();
	    include AUTOCITY_THEME_PATH . "widgets/footer/footer-contact-data/views/widget.php";
	    echo ob_get_clean();

	}    

	/**
	* Back-end widget form.
	*
	* @param array $instance Previously saved values from the database.
	*
	* @see WP_Widget::form()
	*
	*/
	public function form( $instance ) {

		ob_start();
	 	include AUTOCITY_THEME_PATH . "widgets/footer/footer-contact-data/views/form.php";
	 	echo ob_get_clean();

	}

	/**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

  		$instance = array();

		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';

		for ($i=1; $i <= 3; $i++) {	

			$instance['line_' . $i ] = ! empty( $new_instance['line_' . $i ] ) ? wp_kses_post( $new_instance['line_' . $i ] ) : '';

		}	

		return $instance;

    }

}


// Register Footer_Contact_Data_Widget widget
function register_footer_contact_data_widget() {
	register_widget( 'Footer_Contact_Data_Widget' );
}

add_action( 'widgets_init', 'register_footer_contact_data_widget' );

