<?php 

$versionFinal = $attrFiltro->versionFinal;

$cantVersiones =  count( $versionFinal );

if( !empty( $versionFinal ) && $cantVersiones > 1 ){ 

	//tomo los primeros 10
	//$versionFinal = array_slice($versionFinal, 0, $cantToshow );	

?>
<div class="grupo" id="versiones" >

	<div class="titgrupo">
		Versiones
	</div>

	<form>
		
		<?php
			$totalShow = 0;
			foreach( $versionFinal as $key => $version ){
				
				$totalShow++;
				if( $totalShow > $cantToshow )
					break;				
			
				$slug = sanitize_title_with_dashes( $key );
				$title = ucwords( mb_convert_case( $key, MB_CASE_LOWER, "UTF-8" ) );
		?>
		
		<div class="item" onclick="changeFilter(this)">
			<input type="radio" name="versionesRadio" id="<?= $slug ?>" data-id="<?= $version[1] ?>" >
			<label for="<?= $slug ?>"><?= $title ?> <?= ( $version[0] != "" ? "<span>(".$version[0].")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>
		
		<?php if( $cantVersiones > $cantToshow ){ ?>
		<div class="vertodo">
			<a	href="#" 
				data-attr="versiones"
			>Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>
<?php 

	if( $cantVersiones > $cantToshow ){
		require_once( AUTOCITY_THEME_PATH . "/page-templates/partials/filtro/sidesheetVersiones.php" );
	}

}