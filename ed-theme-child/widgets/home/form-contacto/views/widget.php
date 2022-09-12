<?php
	//Initialize the form instance by merging it with the defaults in case some field are missing
	$defaults = array ( 
		'title' => '', 
		'description' => '', 
		'mail_to' => ''
	);

	$form = wp_parse_args( $instance, $defaults );

	$contato_form_nonce = wp_create_nonce( "contato-form-nonce" );
?>

<button class="form-button" aria-label="Abrir formulario de contacto" data-bs-toggle="modal" data-bs-target="#contacto">
			<svg role="img">
				<use xlink:href="<?php echo esc_url ( ASSETS_URL . "sprites/icons.svg#form-button" ); ?>">
				<image src="<?php echo esc_url ( ASSETS_URL . "images/layouts/icons/form-button.svg" ); ?>" xlink:href=""/>
			</svg>
</button>

<!-- Modal -->
<div class="modal fade" id="contacto" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content form">
      <div class="modal-header">
        <h3 class="title" id="modal-title"><?php echo esc_html ( $instance['title'] ); ?></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      	  <p class="description"><?php echo esc_html ( $instance['description'] ); ?></p>

					<!-- Form -->
		      <form method="POST" id="form-contacto">

			      <div class="row g-0 box-input">
							<div class="col-12 col-md-6">
								<label for="first_name">Nombre</label>
								<input id="first_name" name="firstName" class="login-field" type="text" value="" autocomplete="firstName" required />
							</div>
							<div class="col-12 col-md-6">
								<label for="last_name">Apellido</label>
								<input id="last_name" name="lastName" class="login-field" type="text" value="" autocomplete="lastName" required />
							</div>
						</div>

						<div class="row g-0 box-input">
							<div class="col-12 col-md-6">
								<label for="phone">Teléfono</label>
								<input id="phone" name="phone" class="login-field" type="text" pattern="([-]|[0-9]*)*" value="" autocomplete="phone" required />
							</div>
							<div class="col-12 col-md-6">
								<label for="email">Email</label>
								<input id="email" name="email" class="login-field" type="email" autocomplete="email" placeholder="ejemplo@gmail.com" required />
							</div>
						</div>

						<div class="row g-0 box-input">
							<label for="message" >Consulta</label>
								<textarea id="message" name="message" name="" required></textarea>
						</div>
						
						<div class="modal-footer">
							<button class="btn btn-save">Enviar</button>
						</div>

				</form>	
    </div>
  </div>

	<div class="modal-content form-success d-none">
		<?php include_once( __DIR__ . "/contacto-success.php"); ?>
	</div>

</div>

<script>

//Contacto Form Behavior

	// document.addEventListener( "DOMContentLoaded", function(){

	// 	var contactoModal = new bootstrap.Modal(document.getElementById('contacto'), {
	//  	 keyboard: false
	// 	})

	// 	contactoModal.show();

	// });

	jQuery(".sent-another-message").click(function (event) {
		document.getElementById("form-contacto").reset();
		jQuery(".form").removeClass('d-none');
		jQuery(".form-success").addClass('d-none');
	});


	document.addEventListener('bouncerFormValid', function (event) {
		
		var security = <?php echo wp_json_encode( $contato_form_nonce ); ?>;
		var email_to = <?php echo wp_json_encode( $instance['mail_to'] ); ?>;

		var data = {
				'action'		: 'autocity_process_form_contacto',
				'firstName'	: jQuery('#first_name').val(),
				'lastName'	: jQuery('#last_name').val(),
				'phone'			: jQuery('#phone').val(),
				'email'			: jQuery('#email').val(),
				'message'		: jQuery('#message').val(),
				'email_to'  : email_to,
				'security'	: security
			};

			console.log (data);

			jQuery.post("<?=site_url('/wp-admin/admin-ajax.php'); ?>", data, function(response) {
					jQuery(".form-success").removeClass('d-none');
					jQuery(".form").addClass('d-none');
			});


	}, false);

</script>


<?php
