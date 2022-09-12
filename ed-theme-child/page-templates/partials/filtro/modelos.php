<?php 

if ( !empty( $searchGet ) || !empty( $versionGet ) || !empty( $transmisionGet ) || !empty( $combuGet ) || !empty( $segmentosGet ) || !empty( $kmsGet ) || !empty( $precioGet ) || !empty( $anoGet ) ) {
     $getExits = true; $modelos = array();
	 
	 $modelosAttr = $attrFiltro->termsByIdsFinal;
	 //var_dump($modelosAttr);
	 $idsFinalesT = $attrFiltro->getIdsSearch;
	 
	 //echo " asdadasd ";
	 //var_dump($idsFinalesT);
	 
	 //var_dump($modelosAttr);	 

	$cantModelos = 0;
	foreach( $modelosAttr as $key => $value ){
		
		if( $value[3] == 0 && $value[4] == "autos" ){
			continue;
		}else if( ( $value[3] == 143 || $value[3] == 152 || $value[3] == 0 ) && $value[4] == "product_cat" ){
			continue;					
		}
		
		if( $taxonomy == "product_cat" && ( $parentSlug == "usados" || $term_slug == "usados" ) ){
			
			if( substr( $key, 0, 2 ) === "m-" ){
				$modelos[$key] = $value;
			}
			
		}else if( $taxonomy == "product_cat" && ( $parentSlug == "0km" || $term_slug == "0km" ) ){
			
			if( substr( $key, 0, 2 ) !== "m-" ){
				$modelos[$key] = $value;
			}
			
		}else{
			$modelos[$key] = $value;
		}
		

		$cantModelos++;
		
	}	
	
	if( $taxonomy == "autos" ){
		
		$finalMode = array();
		foreach( $modelos as $key => $value ){

			if( substr( $key, 0, 2 ) === "m-" ){
				$sad = substr( $key, 2 );			
	
				if ( array_key_exists($sad, $finalMode) )
					continue;
			}
				
			$canti = 0;	
			foreach( $modelos as $key2 => $value2 ){
				
				if( $value[2] == $value2[2] )
					$canti += $value2[0];

			}
			
			if( substr( $key, 0, 2 ) === "m-" ){
				$nkey = substr( $key, 2 );
				$npar = substr( $value[5], 2 );
				$finalMode[$nkey] = array( $canti, $value[1], $value[2], $value[3], $value[4], $npar );
			}else{
				
				if ( !array_key_exists($key, $finalMode) ) {
					$finalMode[$key] = array( $canti, $value[1], $value[2], $value[3], $value[4], $value[5] );
				}
				
			}				
			
			
		}
		
		$modelos = $finalMode;
		
	}

}else{
	$modelosInicio = $filtro->modelos;
	$getExits = false;

	$cantModelos =  count( $modelosInicio );
	
	foreach( $modelosInicio as $key => $value ){
		
		$parentSlug = "";
		if( $value->parent != 0 )
			$parentSlug = get_term( $value->parent, $value->taxonomy )->slug;			
		
		$modelos[$value->slug] = array( $value->count,$value->term_id,$value->name,$value->parent,$value->taxonomy, $parentSlug );
	}
	
}



if( !empty( $modelos ) && $cantModelos > 1 && ( 
	is_shop() || 
	( $taxonomy == "product_cat" && $term_id == 152 ) ||
	( $taxonomy == "product_cat" && $term_id == 143 ) || 
	( $taxonomy == "product_cat" && $parentId == 143 ) || 
	( $taxonomy == "product_cat" && $parentId == 152 ) ||
	( $taxonomy == "autos" && $parentId == 0 )
) ){

	//tomo los primeros 10
	//$modelos = array_slice( $modelos, 0, $cantToshow );

?>
<div class="grupo" id="modelos">

	<div class="titgrupo">
		Modelos
	</div>

	<form>
		
		<?php
		
			$totalShow = 0;
			//var_dump($modelos);
			foreach( $modelos as $key => $value ){

				$totalShow++;
				if( $totalShow > $cantToshow )
					break;
				
		?>
		
		<div class="item" onclick="changeFilter(this)">
			<input type="radio" name="modelosRadio" id="<?= $value[1] ?>" data-slug="<?= $key ?>" data-parentItemSlug="<?= $value[5] ?>" >
			<label for="<?= $value[1] ?>"><?= $value[2] ?> <?= ( $value[0] != 0 ? "<span>(".$value[0].")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>
		
		
		<?php if( $cantModelos > $cantToshow ){ ?>
		<div class="vertodo">
			<a href="#" data-attr="modelos">Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>					

<?php 

	if( $cantModelos > $cantToshow ){
		require_once( AUTOCITY_THEME_PATH . "/page-templates/partials/filtro/sidesheetModels.php" );
	}

}