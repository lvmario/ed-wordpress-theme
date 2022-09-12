<!-- Modal planes -->
<div class="modal fade" id="formsHero" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
	<div class="modal-content form">
	
		<?php echo do_shortcode( "[contact-form-7 id='21104' title='Planes de ahorro']" ); ?>
		
	</div>

	<div class="modal-content form-success" style="display:none">

			<div class="modal-header">
				   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">

				<svg role="img" class="form-success-icon">
					<use xlink:href="<?php echo esc_url ( ASSETS_URL . "/sprites/icons.svg#form-success" ); ?>">
					<image src="<?php echo esc_url ( ASSETS_URL . "/images/layouts/icons/form-success.svg" ); ?>" xlink:href=""/>
				</svg>

				<p class="title">¡Mensaje enviado correctamente!</p>
				<p class="description">Un asesor se estará contactando en el transcurso 
				de las 24hs.</p>

				<button class="sent-another-message planesModalsSucces" aria-label="Enviar otro mensaje">
					Cerrar
				</button>

			</div>
			
	</div>

  </div>
</div>	

<!-- Modal clientes -->
<div class="modal fade" id="formCliente" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
	<div class="modal-content form">
	
		<?php echo do_shortcode( "[contact-form-7 id='870' title='Planes de ahorro clientes']" ); ?>
		
	</div>

	<div class="modal-content form-success" style="display:none">

			<div class="modal-header">
				   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">

				<svg role="img" class="form-success-icon">
					<use xlink:href="<?php echo esc_url ( ASSETS_URL . "/sprites/icons.svg#form-success" ); ?>">
					<image src="<?php echo esc_url ( ASSETS_URL . "/images/layouts/icons/form-success.svg" ); ?>" xlink:href=""/>
				</svg>

				<p class="title">¡Mensaje enviado correctamente!</p>
				<p class="description">Un asesor se estará contactando en el transcurso 
				de las 24hs.</p>

				<button class="sent-another-message planesModalsSucces" aria-label="Enviar otro mensaje">
					Cerrar
				</button>

			</div>
			
	</div>

  </div>
</div>	


<button class="form-button" aria-label="Abrir formulario de contacto" data-bs-toggle="modal" data-bs-target="#contacto">
	<svg role="img">
		<use xlink:href="<?php echo esc_url ( ASSETS_URL . "sprites/icons.svg#form-button" ); ?>">
		<image src="<?php echo esc_url ( ASSETS_URL . "images/layouts/icons/form-button.svg" ); ?>" xlink:href=""/>
	</svg>
</button>


<!-- Modal flotante -->
<div class="modal fade planesAhorro" id="contacto" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( "[contact-form-7 id='862' title='Planes de ahorro']" ); ?>
		
	</div>

	<div class="modal-content form-success" style="display:none">

			<div class="modal-header">
				   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">

				<svg role="img" class="form-success-icon">
					<use xlink:href="<?php echo esc_url ( ASSETS_URL . "/sprites/icons.svg#form-success" ); ?>">
					<image src="<?php echo esc_url ( ASSETS_URL . "/images/layouts/icons/form-success.svg" ); ?>" xlink:href=""/>
				</svg>

				<p class="title">¡Mensaje enviado correctamente!</p>
				<p class="description">Un asesor se estará contactando en el transcurso 
				de las 24hs.</p>

				<button class="sent-another-message cerrarModal" aria-label="Enviar otro mensaje">
					Cerrar
				</button>

			</div>
			
	</div>

  </div>
</div>

