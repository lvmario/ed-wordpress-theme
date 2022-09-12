<?php 

$segmentosFinal = $attrFiltro->segmentosFinal;
$cantSegmentos =  count( $segmentosFinal );

if( !empty( $segmentosFinal ) && $cantSegmentos > 1 ){ 

	//tomo los primeros 10
	//$segmentosFinal = array_slice($segmentosFinal, 0, $cantToshow );	

?>
<div class="grupo" id="segmentos" >

	<div class="titgrupo">
		Segmentos
	</div>

	<form>
		
		<?php
			$totalShow = 0;
			foreach( $segmentosFinal as $key => $segmento ){
				
				$totalShow++;
				if( $totalShow > $cantToshow )
					break;					
			
				$slug = sanitize_title_with_dashes( $key );
				$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
		?>
		
		<div class="item" onclick="changeFilter(this)" >
			<input type="radio" name="segmentosRadio" id="<?= $slug ?>" >
			<label for="<?= $slug ?>"><?= $title ?> <?= ( $segmento != "" ? "<span>(".$segmento.")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>
		
		<?php if( $cantSegmentos > $cantToshow ){ ?>
		<div class="vertodo">
			<a href="#" data-attr="segmentos">Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>
<?php 

	if( $cantSegmentos > $cantToshow ){
		require_once( AUTOCITY_THEME_PATH . "/page-templates/partials/filtro/sidesheetSegmentos.php" );
	}


}