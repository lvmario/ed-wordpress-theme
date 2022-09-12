<?php
/**
* Adds Footer_Column_Widget widget.
*/
class Footer_Column_Widget extends WP_Widget {
	
	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'footer_column_widget', // Base ID
            'Columna Footer Widget', // Name
            array( 'description' => __( 'Columna para footer', 'text_domain' ), ) // Args
        );
 
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_assets' );
    }

	//Enqueue assets
	public function enqueue_assets(){
		$handle = 'footer-column';
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
	    include AUTOCITY_THEME_PATH . "widgets/footer/footer-column/views/widget.php";
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
	 	include AUTOCITY_THEME_PATH . "widgets/footer/footer-column/views/form.php";
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

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		for ($i=1; $i <= 3; $i++) {	

			$instance['link_name_' . $i ] = ! empty( $new_instance['link_name_' . $i ] ) ? sanitize_text_field( $new_instance['link_name_' . $i ] ) : '';

		    $instance['link_url_' . $i ] = ! empty( $new_instance['link_url_' . $i ] ) ? sanitize_url( $new_instance['link_url_' . $i ] ) : '';

		}	

		return $instance;

    }

}


// Register Footer_Column_Widget widget
function register_footer_column_widget() {
	register_widget( 'Footer_Column_Widget' );
}

add_action( 'widgets_init', 'register_footer_column_widget' );

