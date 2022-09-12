<?php 

$precioFinal = $attrFiltro->precioFinal;
$cantPrecio =  count( $precioFinal );

if( !empty( $precioFinal ) && $cantPrecio > 1 ){	

	$minVal = array_key_last( $precioFinal );
	$min = number_format( $minVal, 0, ',', '.');
	
	$maxVal = array_key_first( $precioFinal );
	$max = number_format( $maxVal, 0, ',', '.');
	
	
	$precioGet = trim( $precioGet,"");
	$porciones = explode("-", $precioGet);
	

?>
<div class="grupo numbers" id="precio" >

	<div class="titgrupo">
		Precio
	</div>

	<form id="precioForm">
		
		<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
		<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
		
		<input type="submit" value="" />
		
	</form>

</div>
<?php 

}