<div id="order-dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		
			<div class="go-back" data-bs-dismiss="modal" aria-label="Close">
				<div class="go-back-icon">
					<img src="<?php echo ASSETS_URL . 'images/layouts/icons/arrow-back.svg'; ?>" alt="Volver">
				</div>
				<span>Volver</span>
			</div>
			
			<div class="modal-heading">
				<h2>Ordenar por</h2>
			</div>
			
			<div class="orderCat order-options" >
			
			
				<?php
				
					if( ( ( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ) )||
						( ( $term->parent == 143  ||  $term->term_id == 143 || $ancestors[0] == 143 ) && ( $show0kmPrice ) ) || 
						( ( is_shop() || is_tax('autos') ) && ( $show0kmPrice ) ) ){				
				
				?>
			
				<div class="item order-option-item" >
				
					<label for="menorPrecio">Menor Precio</label>
					<input <?= ( $orderGet == "price" || $orderGet == "" || $show0kmPrice ? "checked" : "" ) ?> value="price" type="radio" id="menorPrecio" name="orderByRadio" class="ratio-button" />
					
				</div>

				<div class="item order-option-item" >
				
					<label for="mayorPrecio">Mayor Precio</label>
					<input <?= ( $orderGet == "price-desc" ? "checked" : "" ) ?> value="price-desc" type="radio" id="mayorPrecio" name="orderByRadio" class="ratio-button" />
					
				</div>

				<?php } ?>

				<?php if( $term->parent == 152  ||  $term->term_id == 152 || $ancestors[0] == 152 ){ ?>

				<div class="item order-option-item" >
				
					<label for="kilomAsc">Menor kilometraje</label>
					<input <?= ( $orderGet == "kilometraje-asc" ? "checked" : "" ) ?> value="kilometraje-asc" type="radio" id="kilomAsc" name="orderByRadio" class="ratio-button" />
					
				</div>	

				<div class="item order-option-item" >
				
					<label for="kilomDesc">Mayor kilometraje</label>
					<input <?= ( $orderGet == "kilometraje-desc" ? "checked" : "" ) ?> value="kilometraje-desc" type="radio" id="kilomDesc" name="orderByRadio" class="ratio-button" />
					
				</div>

				<div class="item order-option-item" >
				
					<label for="antiMenor">Menor antigüedad</label>
					<input <?= ( $orderGet == "ano-asc" ? "checked" : "" ) ?> value="ano-asc" type="radio" id="antiMenor" name="orderByRadio" class="ratio-button" />
					
				</div>	

				<div class="item order-option-item" >
				
					<label for="antiMayor">Mayor antigüedad</label>
					<input <?= ( $orderGet == "ano-desc" ? "checked" : "" ) ?> value="ano-desc" type="radio" id="antiMayor" name="orderByRadio" class="ratio-button" />
					
				</div>

				<?php }else if( is_shop() || is_tax('autos') ){ ?>	

				<div class="item order-option-item" >
				
					<label for="kilomAsc">Por 0km</label>
					<input <?= ( $orderGet == "kilometraje-asc" || ( !$show0kmPrice && $orderGet == "" ) ? "checked" : "" ) ?> value="kilometraje-asc" type="radio" id="kilomAsc" name="orderByRadio" class="ratio-button" />
					
				</div>	

				<div class="item order-option-item" >
				
					<label for="kilomDesc">Por Usados</label>
					<input <?= ( $orderGet == "kilometraje-desc" ? "checked" : "" ) ?> value="kilometraje-desc" type="radio" id="kilomDesc" name="orderByRadio" class="ratio-button" />
					
				</div>

				<?php } ?>
				
			</div>			
			
		</div>
	</div>
</div>