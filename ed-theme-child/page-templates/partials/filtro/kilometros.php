<?php 

$kilometrosFinal = $attrFiltro->kilometrosFinal;
$cantKilometraje =  count( $kilometrosFinal );

if( !empty( $kilometrosFinal ) && $cantKilometraje > 1 ){	

	$minVal = array_key_last( $kilometrosFinal );
	$min = number_format( $minVal, 0, ',', '.');
	
	$maxVal = array_key_first( $kilometrosFinal );
	$max = number_format( $maxVal, 0, ',', '.');
	
	
	$kmsGet = trim( $kmsGet,"");
	$porciones = explode("-", $kmsGet);

?>
<div class="grupo numbers" id="kilometraje" >

	<div class="titgrupo">
		Kilometraje
	</div>

	<form id="kilometrajeForm">
		
		<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
		<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
		
		<input type="submit" value="" />
		
	</form>

</div>
<?php 

}