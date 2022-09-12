<?php
/**
* Adds Hero_Widget widget.
*/
class Hero_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
				'hero', // Base ID
				'Hero', // Name
				array( 'description' => __( 'Hero con 4 slides configurables', 'text_domain' ), ) // Args
		);

		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_assets' );
	}

	//Enqueue assets
	public function enqueue_assets(){
		$handle = 'hero';
		wp_enqueue_style( $handle . '-widget', CSS_ASSETS_URL . 'widgets/' . $handle . '.css', array(), AUTOCITY_ASSETS_VERSION, "all" );
		wp_enqueue_script( $handle . '-widget-defer', JS_ASSETS_URL . 'widgets/' . $handle . '.cjs.js', AUTOCITY_ASSETS_VERSION, true );
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
	  include AUTOCITY_THEME_PATH . "widgets/home/hero/views/widget.php";
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
	 	include AUTOCITY_THEME_PATH . "widgets/home/hero/views/form.php";
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

		for ($i=1; $i <= 4; $i++) {

			$instance['title_slide_' . $i ] = ( ! empty( $new_instance['title_slide_' . $i ] ) ) ? sanitize_text_field( $new_instance['title_slide_' . $i ] ) : '';

			$instance['description_slide_' . $i ] = ! empty( $new_instance['description_slide_' . $i ] ) ? sanitize_text_field( $new_instance['description_slide_' . $i ] ) : '';

			$instance['cta_name_slide_' . $i ] = ! empty( $new_instance['cta_name_slide_' . $i ] ) ? sanitize_text_field( $new_instance['cta_name_slide_' . $i ] ) : '';

			$instance['cta_url_slide_' . $i ] = ! empty( $new_instance['cta_url_slide_' . $i ] ) ? sanitize_url( $new_instance['cta_url_slide_' . $i ] ) : '';

			$instance['menu_item_name_slide_' . $i ] = ! empty( $new_instance['menu_item_name_slide_' . $i ] ) ? sanitize_text_field( $new_instance['menu_item_name_slide_' . $i ] ) : '';

			$instance['background_image_url_slide_' . $i ]  = ! empty( $new_instance['background_image_url_slide_' . $i ] ) ? sanitize_url( $new_instance['background_image_url_slide_' . $i ] ) : '';

		}	

		return $instance;

    }

}


// Register Hero_Widget widget
function register_hero_widget() {
	register_widget( 'Hero_Widget' );
}

add_action( 'widgets_init', 'register_hero_widget' );

