<?php

	require_once( AUTOCITY_THEME_PATH . "/connections/asofix/dataMasterIntegration/connBase.php" );
	$connBase = new connBase;

	$marcas   	= $connBase->getAllBrands();
	$modelos  	= $connBase->getAllModels();
	$versions	= $connBase->getAllVersions();

?>

<script type='text/javascript' id='datos'>
	var modelos = <?= json_encode( $modelos ) ?>;
	var versions = <?= json_encode( $versions ) ?>;
</script>

<div class="modal fade" id="presuModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

			<div class="modal-content-firstStep active" data-step="firstStep" data-id="">
				
				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>
				
				<div class="modal-header">
					<h2>Resumen del presupuesto</h2>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
				<div class="firstStep"></div>
				
				<div class="info-box">
					<div class="info-box-icon">
						<img src="<?php echo ASSETS_URL . 'images/layouts/icons/info.svg' ?>" alt="Información importante">
					</div>
					<div class="info-box-text">
					Los valores de gastos de entrega son aproximados, sujeto a variaciones de leyes impositivas provinciales, aranceles y tablas del Registro del Automotor. En este valor no se contemplan los sellos de la prenda y la radicación del automotor. Sugerimos corroborar gastos con nuestro equipo comercial antes de cerrar la operación.
					</div>
				</div>
				
			</div>

			<div class="modal-content-cotizador cotizador-settings" data-step="cotizadorSettings">

				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>

				<div class="content-wrapper wrapper-cotizador">
				
					<div class="go-back">
						<button type="button" class="btn-go-back" aria-label="go-back-button" data-function="go-one-step-back" data-prev-step="firstStep">
							<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
							Volver
						</button>
					</div>				

					<div class="modal-header">
						<h2>Cotizador de autos</h2>
						<p class="modal-header-desc">Completá la información en línea y cotizá tu auto al instante</p>
					</div>

					<div class="cotizador-modal-settings-wrapper">

						<div class="content cotizador-settings-content">
							<div class="left-content">						
								<div class="car-select-marca select-group">
									<label for="marca-select">Marca *</label>
	
									<div class="select-container">					
									
										<?php if( !empty( $marcas ) ) { ?>
										
										<select name="marca-select" id="marca-select" class="marca-select" >
											<option value="1" selected>Seleccionar</option>
											
											<?php foreach( $marcas as $key => $marca ):
	
												$brandId = $marca["idBrand"];
												$name = $marca["nombre"];
												
												$modelsByBrand = $connBase->getModelByBrands( $brandId );
														
												//remover marcas que no tienen modelo
												if( $modelsByBrand === false )
													continue;
	
												$existeModel = false;
	
												foreach( $modelsByBrand as $key => $value ) {
													//echo $value->brand_id." ? ";
													if( $value["idBrand"] == $brandId ) {
														$existeModel = true;
													}
												}
														
												if( !$existeModel )
													continue;	
											?>
											<option value="<?= $brandId; ?>">
												<?= $name; ?>
											</option>
													
											<?php endforeach; ?>
										</select>
										<?php } ?>
										
									</div>
								</div>
								
								<div class="input-group">
								
									<div class="car-select-modelo select-group">
										<label for="modelo-select">Modelo *</label>
										<div class="select-container">						
										
											<select name="modelo-select" id="modelo-select" class="modelo-select" disabled>
												<option value="1" selected>Seleccionar</option>
											</select>
											
										</div>
									</div>
									
									<div class="car-select-ano select-group item item-ano">
										<label for="ano-select">Año *</label>
										<div class="select-container">								
										
											<select name="ano-select" id="ano-select" class="ano-select" disabled>
												<option value="1" selected>Seleccionar</option>
											</select>
										</div>
									</div>							  
									
								</div>	  
								
								<div class="car-select-version select-group">
	
									<label for="version-select">Versión *</label>
									<div class="select-container">							
									
										<select name="version-select" id="version-select" class="version-select" disabled>
											<option value="1" selected>Seleccionar</option>
										</select>
										
									</div>
								</div>
								
								<div class="input-group">
								
									<div class="item item-kilometraje">
										<label for="kilometraje" >Kilometraje *</label>
										<input type="number" name="kilometraje" id="kilometraje" placeholder="Ej.: 100000" disabled />
									</div>
								
								</div>
							
							</div>
							
							<div class="right-content">
							
								<h4>Estado del auto *</h4>
								
								<div class="grupo radioFamily">
									
									<div class="item" >
										<input type="radio" name="estadoRadio" id="excelente" data-id="10" disabled />
										<label for="excelente">
											<p>Excelente</p>
											<div>Excepcionales condiciones mecánicas, exteriores e interiores. No requiere reacondicionamiento.</div>
										</label>
									</div>
									
									<div class="item" >
										<input type="radio" name="estadoRadio" id="bueno" data-id="5" disabled />
										<label for="bueno">
											<p>Bueno</p>
											<div>Algún desgaste normal, pero sin problemas mecánicos o estéticos importantes: puede requerir un reacondicionamiento limitado.</div>									
										</label>
									</div>	
	
									<div class="item" >
										<input type="radio" name="estadoRadio" id="regular" data-id="1" disabled />
										<label for="regular">									
											<p>Regular</p>										
											<div>Varios problemas mecánicos y/o estéticos que requieren reparaciones significativas.</div>									
										</label>
									</div>								
											
								</div>
							
							</div>
						
						</div>
						
						<div class="modal-btn-wrapper">
							<button class="btn-primary-light btn-cotizar" id="add-car-button" disabled>Cotizar auto</button>
						</div>

					</div>

				</div>

			</div>

			<div class="modal-content-cotizador cotizador-result" data-step="cotizadorResult">
			
				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>

				<div class="content-wrapper">
				
					<div class="go-back">
						<button type="button" class="btn-go-back" aria-label="go-back-button" data-function="go-one-step-back" data-prev-step="cotizadorSettings">
							<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
							Volver
						</button>
					</div>				

					<div class="modal-header">
						<h2>Cotizador de autos</h2>
						<p class="modal-header-desc">Completá la información en línea y cotizá tu auto al instante</p>
					</div>

					<div class="cotizador-modal-result-wrapper">
					
						<div class="content cotizador-result-content step2">
							<div class="content-header">
								<div class="car-info">
									<h4 class="car-heading"><span class="marcaData" >Fiat</span> <span class="modeloData">Cronos</span> <span class="anoData">2019</span></h4>
									<p class="car-subheading versionData">Precision 1.8 AT</p>
								</div>
								<a href="#" class="edit-link" arial-label="edit-button" data-function="go-one-step-back" data-prev-step="cotizadorSettings">
									<span>Editar</span>
									<img src="<?php echo ASSETS_URL . 'images/layouts/icons/editar.svg' ?>" alt="Editar">
								</a>
							</div>
							<div class="car-details">
								<p>Kilometraje: <span class="kmData">25.000</span> | Estado: <span class="estadoData">Excelente</span></p>
							</div>
							<div class="car-price-box">
								<div class="titValor">Precio del mercado</div>
								<div class='priceValor' data-valor=''></div>
							</div>
						</div>

						<div class="modal-btn-wrapper">
							<button class="btn-primary-light btn-agregar-usado" onclick="changeVlues()" >Agregar al presupuesto</button>
						</div>
						
						<div class="info-box">
						
							<div class="info-box-icon">
								<img src="<?php echo ASSETS_URL . 'images/layouts/icons/info.svg' ?>" alt="Información importante">
							</div>
							<div class="info-box-text">
								Los valores de tasación son meramente informativos y estimativos, por lo que no constituyen una oferta y/o promesa de pago alguna.
							</div>
							
						</div>
					
					</div>

				</div>

			</div>
			
			
			<div class="modal-content-financiador financiador-first" data-step="financiadorFirst">
			
				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>

				<div class="content-wrapper">
				
					<div class="go-back">
						<button type="button" class="btn-go-back" aria-label="go-back-button" data-function="go-one-step-back" data-prev-step="firstStep">
							<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
							Volver
						</button>
					</div>				

					<div class="modal-header">
						<h2>Elegí tu linea financiera</h2>
						<!--button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button-->
					</div>

					<div class="financiador-modal-result-wrapper"></div>

				</div>

			</div>	



			<div class="modal-content-financiador financiador-second" data-step="financiadorSecond">
			
				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>

				<div class="content-wrapper">
				
					<div class="go-back">
						<button type="button" class="btn-go-back" aria-label="go-back-button" data-function="go-one-step-back" data-prev-step="financiadorFirst">
							<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
							Volver
						</button>
					</div>				

					<div class="modal-header">
						<h2>Linea de financiación</h2>
					</div>

					<div class="financiador-modal-result-wrapper">
					
						<div class="content financiador-result-content">
						
							<div class="content-header">
							
								<div class="car-info">
									<h4 class="car-heading">Río Uva. De 4 a 5 años</h4>
								</div>
								
								<a href="#" class="edit-link" arial-label="edit-button" data-function="go-one-step-back" data-prev-step="financiadorFirst">
									<span>Editar</span>
									<img src="<?php echo ASSETS_URL . 'images/layouts/icons/editar.svg' ?>" alt="Editar">
								</a>
								
							</div>
							
							<div class="car-price-box">
								<div class="titValor">Monto a financiar</div>
								<div class='priceValor' data-valor='100000'>$100.000</div>
							</div>
							
							<div class="tablaItem promMens">

								<div class="presuFirst">
									Cuota mensual promedio
								</div>

								<div class="presuSecond" data-valor="15492">
									$15.492					
								</div>

							</div>

							<div class="tablaItem cantCuotas">

								<div class="presuFirst">
									Cuotas del prestamo
								</div>

								<div class="presuSecond items" >
									12 meses				
								</div>

							</div>	

							<div class="tablaItem tnaCft">

								<div class="presuFirst">
									TNA / CFT
								</div>

								<div class="presuSecond items">
									%12.5 / %16.35				
								</div>

							</div>	

							<div class="tablaItem enti">

								<div class="presuFirst">
									Entidad
								</div>

								<div class="presuSecond items">
									Santander Río				
								</div>

							</div>								
							
						</div>

						<div class="modal-btn-wrapper">
							<button class="btn-primary-light btn-agregar-financiador" onclick="changeVluesFinanAdd(this)" >Agregar al presupuesto</button>
						</div>
					
					</div>

				</div>

			</div>
			
			
			
			<div class="modal-content-contactForm" data-step="contactForm">
				
				<div class="loader">
					<div class="loaderWrapper">
						<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
					</div>	
				</div>
				
				<div class="modal-content-form">
					<?php echo do_shortcode( '[contact-form-7 id="20084" title="Presupuestador"]' ); ?>
				</div>
				
				<div class="modal-content form-success formpresu" style="display:none">

					<div class="modal-header">
						   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">

						<svg role="img" class="form-success-icon">
							<use xlink:href="<?php echo esc_url ( ASSETS_URL . "/sprites/icons.svg#form-success" ); ?>">
							<image src="<?php echo esc_url ( ASSETS_URL . "/images/layouts/icons/form-success.svg" ); ?>" xlink:href=""/>
						</svg>

						<p class="title">Tu presupuesto se descargó correctamente</p>
						<p class="description">También lo enviamos a tu casilla de correo y pondremos a disposición un asesor comercial que se contactará con vos en el transcurso de las 24 hs. para ampliar la información.</p>

						<div class="backToFicha">
							<a href="/" class="btn-primary-light" >Volver a la ficha técnica</a>
						</div>		

					</div>
						
				</div>
				
			</div>			

		</div>
		
  </div>
</div>