<?php


global $post;

$modal = false; $modalMapas = false;

if ( !is_front_page() && get_page_template_slug ($post->ID) == "blog.php") {
	//echo "1";
	//pagina de blog y no a la home
	$modal = true;
	$short = '[contact-form-7 id="169" title="Blog"]';
}if( is_archive() || is_search() || is_category() || is_tag() || is_single() ){
	//echo "2asdasd";
	$modal = true;
	$short = '[contact-form-7 id="169" title="Blog"]';
}else if ( is_front_page() ){
	//echo "3";
	$modal 		= true;
	$modalMapas = true;
	$short = '[contact-form-7 id="554" title="Home"]';
}else if ( is_page(392) ){
	//echo "4";
	$modal = true;
	$short = '[contact-form-7 id="552" title="Corporate"]';
}else if ( is_page(15) ){
	//echo "5";
	$modal = true;
	$short = '[contact-form-7 id="553" title="Posventa"]';
}else if ( is_page(17) ){
	//nosotros
	$modal = true;
	$short = '[contact-form-7 id="554" title="Home"]';
}

if( $modal ){
	
	if ( !is_page(392) ){
?>


<button class="form-button" aria-label="Abrir formulario de contacto" data-bs-toggle="modal" data-bs-target="#contacto">
	<svg role="img">
		<use xlink:href="<?php echo esc_url ( ASSETS_URL . "sprites/icons.svg#form-button" ); ?>">
		<image src="<?php echo esc_url ( ASSETS_URL . "images/layouts/icons/form-button.svg" ); ?>" xlink:href=""/>
	</svg>
</button>

	<?php } ?>

<!-- Modal -->
<div class="modal fade" id="contacto" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( $short ); ?>
		
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


				<?php if ( is_page(14) ){ ?>
				<button class="sent-another-message cerrarModal" aria-label="Enviar otro mensaje">
					Cerrar
				</button>
				<?php }else{ ?>
				<button class="sent-another-message" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>				
				<?php } ?>

			</div>
			
	</div>

  </div>
</div>

<?php if( $modalMapas ){ ?>


<!-- Modal contacto-cbaCapital -->
<div class="modal fade sucModals" id="contacto-cbaCapital" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( '[contact-form-7 id="580" title="Suc. Córdoba Capital"]' ); ?>
		
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

				<button class="sent-another-message sucModalsSucces" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>

			</div>
			
	</div>

  </div>
</div>

<!-- Modal contacto-villaAllende -->
<div class="modal fade sucModals" id="contacto-villaAllende" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( '[contact-form-7 id="581" title="Suc. Villa Allende"]' ); ?>
		
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

				<button class="sent-another-message sucModalsSucces" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>

			</div>
			
	</div>

  </div>
</div>


<!-- Modal contacto-rioCuarto -->
<div class="modal fade sucModals" id="contacto-rioCuarto" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( '[contact-form-7 id="582" title="Suc. Río Cuarto"]' ); ?>
		
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

				<button class="sent-another-message sucModalsSucces" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>

			</div>
			
	</div>

  </div>
</div>


<!-- Modal contacto-villaMaria -->
<div class="modal fade sucModals" id="contacto-villaMaria" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( '[contact-form-7 id="583" title="Suc. Villa María"]' ); ?>
		
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

				<button class="sent-another-message sucModalsSucces" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>

			</div>
			
	</div>

  </div>
</div>


<!-- Modal contacto-sanLuis -->
<div class="modal fade sucModals" id="contacto-sanLuis" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
  
    <div class="modal-content form">
	
		<?php echo do_shortcode( '[contact-form-7 id="584" title="Suc. San Luis"]' ); ?>
		
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

				<button class="sent-another-message sucModalsSucces" aria-label="Enviar otro mensaje">
					Enviar otro mensaje
				</button>

			</div>
			
	</div>

  </div>
</div>

<?php } ?>



<?php } ?> 
