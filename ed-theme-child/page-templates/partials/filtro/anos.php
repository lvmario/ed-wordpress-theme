<?php 

$anosFinal = $attrFiltro->anosFinal;
$cantAno=  count( $anosFinal );

if( !empty( $anosFinal ) && $cantAno > 1 ){	

	$minVal = array_key_last( $anosFinal );
	$min = number_format( $minVal, 0, ',', '.');
	
	$maxVal = array_key_first( $anosFinal );
	$max = number_format( $maxVal, 0, ',', '.');
	
	
	$anoGet = trim( $anoGet,"");
	$porciones = explode("-", $anoGet);
	

?>
<div class="grupo numbers" id="ano" >

	<div class="titgrupo">
		Año
	</div>

	<form id="anoForm">
		
		<input type="number" value="<?= $porciones[0] ?>" name="cantidadMin" id="cantidadMin" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Mínimo <?= $min ?>" required />
		<input type="number" value="<?= $porciones[1] ?>" name="cantidadMaz" id="cantidadMaz" min="<?= $minVal ?>" max="<?= $maxVal ?>" placeholder="Máximo <?= $max ?>" required />
		
		<input type="submit" value="" />
		
	</form>

</div>
<?php 

}