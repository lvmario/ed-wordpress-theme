<?php
/**
* Adds Form_Contacto widget.
*/
class Form_Contacto extends WP_Widget {
	
	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'form_contacto', // Base ID
            'Formulario de Contacto', // Name
            array( 'description' => __( 'Formulario de Contacto', 'text_domain' ), ) // Args
        );
 
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_assets' );
		add_action( 'wp_ajax_autocity_process_form_contacto', __CLASS__ . '::process_form_contacto' );
		add_action( 'wp_ajax_nopriv_autocity_process_form_contacto', __CLASS__ . '::process_form_contacto' );

    }

	//Enqueue assets
	public function enqueue_assets(){
		$handle = 'form-contacto';
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
	    include AUTOCITY_THEME_PATH . "widgets/home/form-contacto/views/widget.php";
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
	 	include AUTOCITY_THEME_PATH . "widgets/home/form-contacto/views/form.php";
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

			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? sanitize_text_field( $new_instance['description'] ) : '';
			$instance['mail_to'] = ( ! empty( $new_instance['mail_to'] ) ) ? sanitize_email( $new_instance['mail_to'] ) : '';

		}	

		return $instance;

    }
    
    /**
     * Process form data for two purposes: sending a mail and creating a message post entry.
     *
     */

    public function process_form_contacto() {

		//Send Mail
		$ok = check_ajax_referer( 'contato-form-nonce', 'security', false );

		if ( false === $ok ) {
			wp_die( 'error: security' );
		}

		//Get input values
	 	$email_input = sanitize_email( wp_unslash( $_POST['email'] ) );// Input var okay.
	 	if ( is_email ( $email_input ) ){
	 		$email = $email_input;
	 	}else{
	 		$email = "";
	 	}

	 	$email_to = sanitize_email( wp_unslash( $_POST['email_to'] ) );// Input var okay.
	 	if ( is_email ( $email_to ) ){
	 		$email_to = $email_to;
	 	}else{
	 		$email_to = "";
	 	}

	 	$text_field_inputs = array (
	 		"firstName",
	 		"lastName",
	 		"phone",
	 		"message"
	 	);

	 	foreach ($text_field_inputs as $key ) {

	 		if (  isset( $_POST[$key] ) ) {// Input var okay.
	 			$$key = sanitize_text_field($_POST[$key]);// Input var okay.
	 		}else{
	 			$$key = "";
	 		}

	 	}

	 	//Create message
		$mail_content .= "\n-- Nombre : " . $firstName . "\n";
		$mail_content .= "\n-- Apellido : " . $lastName . "\n";
		$mail_content .= "\n-- Email : " . $email . "\n";
	  	$mail_content .= "\n-- Teléfono : " . $phone . "\n";
	  	$mail_content .= "\n-- Email : " . $message . "\n";
	    
		wp_mail( $email_to, "Contacto Autocity", $mail_content); 

		//Create Message Post
		$post_title = "Contacto " . $firstName . " " . $lastName . " " . date('H:i d-M-Y');

		$message_post = array( 
		  'post_title' => $post_title,
		  'post_name' => sanitize_title( $post_title ),
		  'post_excerpt' => "",
		  'post_content' => $mail_content,
		  'post_status' => 'publish',
		  'comment_status' => 'closed',
		  'post_type' => 'mensaje'
		);

		$message_id = wp_insert_post( $message_post, $wp_error = true );

		if ( ! is_wp_error( $message_id ) ) {

			add_post_meta( $message_id, 'first-name', $firstName );
			add_post_meta( $message_id, 'last-name', $lastName );
			add_post_meta( $message_id, 'email', $email );
			add_post_meta( $message_id, 'phone', $phone );

		}else{
			wp_die( 'wp-error' );
		}

		wp_die();
	}

}


// Register Form_Contacto widget
function register_form_contacto_widget() {
	register_widget( 'Form_Contacto' );
}

add_action( 'widgets_init', 'register_form_contacto_widget' );

