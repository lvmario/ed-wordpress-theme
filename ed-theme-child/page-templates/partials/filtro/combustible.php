<?php 

$combustibleFinal = $attrFiltro->combustibleFinal;
$cantCombustible =  count( $combustibleFinal );

if( !empty( $combustibleFinal ) && $cantCombustible > 1 ){ 

	//tomo los primeros 10
	//$combustibleFinal = array_slice($combustibleFinal, 0, $cantToshow );	

?>
<div class="grupo" id="combustible" >

	<div class="titgrupo">
		Combustible
	</div>

	<form>
		
		<?php
			$totalShow = 0;
			foreach( $combustibleFinal as $key => $combu ){
				
				$totalShow++;
				if( $totalShow > $cantToshow )
					break;					
							
			
				$slug = sanitize_title_with_dashes( $key );
				$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
		?>
		
		<div class="item" onclick="changeFilter(this)">
			<input type="radio" name="combuRadio" id="<?= $slug ?>" >
			<label for="<?= $slug ?>"><?= $title ?> <?= ( $combu != "" ? "<span>(".$combu.")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>
		
		<?php if( $cantCombustible > $cantToshow ){ ?>
		<div class="vertodo">
			<a href="#" data-attr="combustible">Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>
<?php

	if( $cantCombustible > $cantToshow ){
		require_once( AUTOCITY_THEME_PATH . "/page-templates/partials/filtro/sidesheetCombu.php" );
	} 
}