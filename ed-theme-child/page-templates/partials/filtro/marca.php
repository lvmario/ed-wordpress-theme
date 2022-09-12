<?php 

if ( !empty( $searchGet ) || !empty( $versionGet ) || !empty( $transmisionGet ) || !empty( $combuGet ) || !empty( $segmentosGet ) || !empty( $kmsGet ) || !empty( $precioGet ) || !empty( $anoGet ) ) {
     $getExits = true; $marcas = array();
	 
	 $marcasAttr = $attrFiltro->termsByIdsFinal;
	 
	 //$idsFinalesT = $attrFiltro->getIdsSearch;
	 //echo " asdadasd ";
	 //var_dump($idsFinalesT);
	 
	 //var_dump($marcasAttr);
	 
	$cantMarcas = 0;
	foreach( $marcasAttr as $key => $value ){
		
		if( $value[3] != 0 && $value[4] == "autos" ){
			continue;
		}else if( ( $value[3] != 143 && $value[3] != 152 ) && $value[4] == "product_cat" ){
			continue;					
		}
		
		if( $taxonomy == "product_cat" && ( $parentSlug == "usados" || $term_slug == "usados" ) ){
			
			if( substr( $key, 0, 2 ) === "m-" ){
				$marcas[$key] = $value;
			}
			
		}else{
			
			if( substr( $key, 0, 2 ) !== "m-" ){
				$marcas[$key] = $value;
			}
			
		}
		
		$cantMarcas++;

	}
	 
}else{

	$marcasInicio = $filtro->marcas;
	$getExits = false;

	$cantMarcas =  count( $marcasInicio );
	
	foreach( $marcasInicio as $key => $value ){
		
		$parentSlug = "";
		if( $value->parent != 0 )
			$parentSlug = get_term( $value->parent, $value->taxonomy )->slug;	
		
		$marcas[$value->slug] = array( $value->count,$value->term_id,$value->name,$value->parent,$value->taxonomy, $parentSlug );
	}
	
}

//var_dump($marcas);


if( !empty( $marcas ) && $cantMarcas > 1 && ( is_shop() || $term_id == 152 || $term_id == 143 ) ){ 

	//tomo los primeros 10
	//$marcas = array_slice($marcas, 0, $cantToshow );
	
	
?>
<div class="grupo" id="marcas">

	<div class="titgrupo">
		Marcas
	</div>

	<form>
	
		<?php
			$totalShow = 0;
			//var_dump($marcas);
			foreach( $marcas as $key => $value ){
				
				$totalShow++;
				if( $totalShow > $cantToshow )
					break;		

				
				
		?>
		
		<div class="item" onclick="changeFilter(this)">
			<input type="radio" name="brandRadio" id="<?= $value[1] ?>" data-slug="<?= $key ?>" data-parentItemSlug="<?= $value[5] ?>" >
			<label for="<?= $value[1] ?>"><?= $value[2] ?> <?= ( $value[0] != 0 ? "<span>(".$value[0].")</span>" : "" );  ?></label>
		</div>
		
		<?php } ?>

	
		
		
		<?php if( $cantMarcas > $cantToshow ){ ?>
		<div class="vertodo">
			<a href="#" data-attr="marcas">Ver todo</a>
		</div>
		<?php } ?>
		
	</form>

</div>
<?php 

	if( $cantMarcas > $cantToshow ){
		require_once( AUTOCITY_THEME_PATH . "/page-templates/partials/filtro/sidesheetBrands.php" );
	}

}