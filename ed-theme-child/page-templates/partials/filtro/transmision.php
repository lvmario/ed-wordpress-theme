<?php 

$transmisionFinal = $attrFiltro->transmisionFinal;

//var_dump($transmisionFinal);
$cantTransmision =  count( $transmisionFinal );

if( !empty( $transmisionFinal ) && $cantTransmision > 1 ){ 

	//tomo los primeros 10
	//$transmisionFinal = array_slice($transmisionFinal, 0, $cantToshow );	

?>
<div class="grupo" id="transmision" >

	<div class="titgrupo">
		Transmisión
	</div>

	<form>
		
		<?php
			
			$totalShow = 0;
			foreach( $transmisionFinal as $key => $transmi ){
				
				$totalShow++;
				if( $totalShow > $cantToshow )
					break;				
				
				if( $key == "AUTOMATICO" )
					$key = "AUTOMÁTICO";
			
				$slug = sanitize_title_with_dashes( $key );
				$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
		?>
		
		<div class="item" onclick="changeFilter(this)">
			<input type="radio" name="transmiRadio" id="<?= $slug ?>" >
			<label for="<?= $slug ?>"><?= $title ?> <?= ( $transmi != "" ? "<span>(".$transmi.")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>
		
		<?php if( $cantTransmision > $cantToshow ){ ?>
		<div class="vertodo">
			<a href="#" data-attr="transmision">Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>
<?php 

}