<?php

$checkMarcas = true;
$checkModels = true;
$checkVersio = true;
$checkTransm = true;
$checkCombus = true;
$checkKilome = true;
$checkPrecio = true;
$checkSegmen = true;
$checkAno	 = true;

?>

<div id="filter-dialog" class="modal fade" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" data-show0km="<?= ( $show0kmPrice ? "show" : "hide" ) ?>" >
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		
			<div class="topModal">
			
				<div class="go-back" data-bs-dismiss="modal" aria-label="Close">
					<div class="go-back-icon">
						<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
					</div>
					<span>Volver</span>
				</div>
				
				<div class="modal-heading">
					<h2>Filtrar por</h2>
					<div class="clear-filters" >
						<span>Limpiar filtros</span>
						<div class="trash-icon">
							<img src="<?php echo ASSETS_URL . 'images/layouts/icons/trash.svg'; ?>" alt="Limpiar filtros">
						</div>
					</div>
				</div>
				
			</div>	

			<div class="filters-accordeon">
			
				<?php if( !empty( $marcas ) && $cantMarcas > 1 && ( is_shop() || $term_id == 152 || $term_id == 143 ) ){ ?>
			
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Marcas</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="marcas">
						<ul>
						
							<?php foreach( $marcas as $key => $value ){ ?>
						
							<li data-select="" class="brandMobile" id="<?= $value[1] ?>" data-slug="<?= $key ?>" data-parentItemSlug="<?= $value[5] ?>" onclick="changeFilter(this,null,null,true)" >
								<span><?= $value[2] ?> <?= ( $value[0] != 0 ? "<span>(".$value[0].")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>
							
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<?php }else{
					$checkMarcas = false;
				} ?>
				
				<?php 

					if( !empty( $modelos ) && $cantModelos > 1 && ( 
						is_shop() || 
						( $taxonomy == "product_cat" && $term_id == 152 ) ||
						( $taxonomy == "product_cat" && $term_id == 143 ) || 
						( $taxonomy == "product_cat" && $parentId == 143 ) || 
						( $taxonomy == "product_cat" && $parentId == 152 ) ||
						( $taxonomy == "autos" && $parentId == 0 )
					) ){

				?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Modelos</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="modelos">
						<ul>
						
							<?php foreach( $modelos as $key => $value ){ ?>
						
							<li data-select="" class="modelosMobile" id="<?= $value[1] ?>" data-slug="<?= $key ?>" data-parentItemSlug="<?= $value[5] ?>" onclick="changeFilter(this,null,null,true)" >
								<span><?= $value[2] ?> <?= ( $value[0] != 0 ? "<span>(".$value[0].")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>

							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<?php }else{
					$checkModels = false;
				} ?>
				
				<?php 
				
					if( $name == "product" || $taxonomy == "autos" || ( $taxonomy == "product_cat" && ( $term_id == 152 || $parentId == 152 || $ancestors[0] == 152 ) ) ){ 
					
						if( !empty( $versionFinal ) && $cantVersiones > 1 ){ 
				?>
						

				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Versiones</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="versiones" >
						<ul>

							<?php 
							
								foreach( $versionFinal as $key => $version ){ 
							

									$slug = sanitize_title_with_dashes( $key );
									$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );								
							?>
						
							<li class="versionesMobile" id="<?= $slug ?>" data-id="<?= $version[1] ?>" onclick="changeFilter(this,null,null,true)" >
								<span><?= $title ?> <?= ( $version[0] != "" ? "<span>(".$version[0].")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>

							<?php } ?>

						</ul>
					</div>
				</div>
				
				<?php 
						}else{
							$checkVersio = false;
						}	
				
					}else{
						$checkVersio = false;
					} 
				
				?>
				
				<?php if( !empty( $transmisionFinal ) && $cantTransmision > 1 ){  ?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Transmisión</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="transmision">
						<ul>
						
							<?php 
							
								foreach( $transmisionFinal as $key => $transmi ){ 
							
									$slug = sanitize_title_with_dashes( $key );
									
									if( $key == "AUTOMATICO" )
										$key = "AUTOMÁTICO";									
									
									$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
							
							?>
							
							<li class="transmiMobile" id="<?= $slug ?>" onclick="changeFilter(this,null,null,true)" >
								<span><?= $title ?> <?= ( $transmi != "" ? "<span>(".$transmi.")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>
							
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<?php }else{
					$checkTransm = false;
				} ?>
				
				
				<?php if( !empty( $combustibleFinal ) && $cantCombustible > 1 ){   ?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Combustible</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="combustible">
						<ul>
						
							<?php 
							
								foreach( $combustibleFinal as $key => $combu ){
							
									$slug = sanitize_title_with_dashes( $key );
									$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
							
							?>
							
							<li class="combuMobile" id="<?= $slug ?>" onclick="changeFilter(this,null,null,true)" >
								<span><?= $title ?> <?= ( $combu != "" ? "<span>(".$combu.")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>
							
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<?php }else{
					$checkCombus = false;
				} ?>


				<?php 
				
					if( $name == "product" || $taxonomy == "autos" || ( $taxonomy == "product_cat" && ( $term_id == 152 || $parentId == 152 || $ancestors[0] == 152 ) ) ){  
					
						if( !empty( $kilometrosFinal ) && $cantKilometraje > 1 ){	

							$minVal = array_key_last( $kilometrosFinal );
							$min = number_format( $minVal, 0, ',', '.');
							
							$maxVal = array_key_first( $kilometrosFinal );
							$max = number_format( $maxVal, 0, ',', '.');
							
							
							$kmsGet = trim( $kmsGet,"");
							$porciones = explode("-", $kmsGet);				

				?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Kilometraje</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="kilometraje">
						<form id="kilometrajeFormMobile" >
							
							<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
							<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
							
							<input type="submit" value="" />
							
						</form>
					</div>
				</div>
				
				<?php 
						}else{
							$checkKilome = false;
						}	
				
					}else{
						$checkKilome = false;
					} 
				
				?>


				<?php
				
				if( $name == "product" || $taxonomy == "autos" || ( $taxonomy == "product_cat" && ( $term_id == 152 || $parentId == 152 || $ancestors[0] == 152 ) ) ){
				
					if( !empty( $precioFinal ) && $cantPrecio > 1 ){ 
					
						$minVal = array_key_last( $precioFinal );
						$min = number_format( $minVal, 0, ',', '.');
						
						$maxVal = array_key_first( $precioFinal );
						$max = number_format( $maxVal, 0, ',', '.');
						
						
						$precioGet = trim( $precioGet,"");
						$porciones = explode("-", $precioGet);					
				
				?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Precio</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="precio">
						<form id="precioFormMobile">
							
							<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
							<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
							
							<input type="submit" value="" />
							
						</form>
					</div>
				</div>

				<?php 
					
					}else{
						$checkPrecio = false;
					}
				
				}else{ 
				
					if( $show0kmPrice ){
				
						if( !empty( $precioFinal ) && $cantPrecio > 1 ){ 
						
							$minVal = array_key_last( $precioFinal );
							$min = number_format( $minVal, 0, ',', '.');
							
							$maxVal = array_key_first( $precioFinal );
							$max = number_format( $maxVal, 0, ',', '.');
							
							
							$precioGet = trim( $precioGet,"");
							$porciones = explode("-", $precioGet);					
				
				?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Precio</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="precio">
						<form id="precioFormMobile">
							
							<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
							<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
							
							<input type="submit" value="" />
							
						</form>
					</div>
				</div>

				<?php 
						}else{
							$checkPrecio = false;
						}					
					}else{
						$checkPrecio = false;
					}
				}					
				
				?>
				
				
				
				<?php if( !empty( $segmentosFinal ) && $cantSegmentos > 1 ){   ?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Segmentos</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="segmentos" >
						<ul>
						
							<?php 
							
								foreach( $segmentosFinal as $key => $segmento ){
							
									$slug = sanitize_title_with_dashes( $key );
									$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
							
							?>
							
							<li data-select="" class="segmentosMobile" id="<?= $slug ?>" onclick="changeFilter(this,null,null,true)">
								<span><?= $title ?> <?= ( $segmento != "" ? "<span>(".$segmento.")</span>" : "" );  ?></span>
								<div class="ratio-button">
									<div class="ratio-button-out"></div>
									<div class="ratio-button-in"></div>
								</div>
							</li>
							
							<?php } ?>
							
						</ul>
					</div>
				</div>
				
				<?php }else{
					$checkSegmen = false;
				} ?>

				<?php
				
					if( $name == "product" || $taxonomy == "autos" || ( $taxonomy == "product_cat" && ( $term_id == 152 || $parentId == 152 || $ancestors[0] == 152 ) ) ){
						
						if( !empty( $anosFinal ) && $cantAno > 1 ){	

							$minVal = array_key_last( $anosFinal );
							$min = number_format( $minVal, 0, ',', '.');
							
							$maxVal = array_key_first( $anosFinal );
							$max = number_format( $maxVal, 0, ',', '.');
							
							
							$anoGet = trim( $anoGet,"");
							$porciones = explode("-", $anoGet);

				?>
				
				<div class="filters-accordeon-item" data-open="closed">
					<div class="filters-accordeon-item-heading">
						<span>Año</span>
						<div class="tab-arrow"></div>
					</div>
					<div class="filters-accordeon-item-content" style="display:none" id="ano">
						<form id="anoFormMobile">
							
							<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
							<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
							
							<input type="submit" value="" />
							
						</form>
					</div>
				</div>

				<?php 
					}else{
						$checkAno = false;
					}					
				}else{
					$checkAno = false;
				}
									
				
				?>
				
				<?php
				
					if( $checkMarcas == false &&  
						$checkModels == false && 
						$checkVersio == false && 
						$checkTransm == false && 
						$checkCombus == false && 
						$checkKilome == false && 
						$checkPrecio == false && 
						$checkSegmen == false && 
						$checkAno	 == false ){
				?>
				<div class="noFound">
					<div class="firstCol"></div>
					<div class="secondCol">
						<h1>No hay más opciones para los filtros seleccionados.</h1>
						<ul>
							<li>Limpiar filtros para hacer una nueva búsqueda.</li>
						</ul>
					</div>
				</div>
				<?php				
					}
				
				?>
				
			</div>      
			
			<!--div class="dialog-button text-center" id="filter-button">
			  <button id="apply-filters-button" class="btn-primary-light" data-bs-dismiss="modal" disabled>Aplicar filtros</button>
			</div-->
			
		</div>
	</div>
</div>